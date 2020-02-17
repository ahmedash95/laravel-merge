<?php

namespace App\Console\Commands;

use App\Jobs\FetchPullRequestInfo;
use App\Process\GitHubInterface;
use App\PullRequest;
use App\Traits\taskable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FetchPullRequests extends Command
{
    use taskable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pr:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch latest pull requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GitHubInterface $command
     * @return mixed
     * @throws \Exception
     */
    public function handle(GitHubInterface $command)
    {
        $output = $command->getMergedPr('laravel/framework');
        $this->logTask('getMergedPr', $output);

        $pullRequests = [];
        foreach (explode(PHP_EOL, $output) as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            preg_match('/\#(\d+)\s\s(.*)/', $line, $matches);

            if (count($matches) !== 3) {
                throw new \Exception('Line does not match a correct pull request');
            }

            if (in_array($matches[2], PullRequest::blackListTitles)) {
                continue;
            }

            $pullRequests[] = [
                'id' => $matches[1],
                'title' => $matches[2],
            ];
        }

        $pullRequests = array_reverse($this->filterExists($pullRequests));

        $this->insertNewPrs($pullRequests);
    }

    private function filterExists(array $pullRequests)
    {
        $newPrs = [];
        foreach ($pullRequests as $row) {
            $pr = PullRequest::byPrId($row['id'])->first();
            if ($pr) {
                break;
            }
            $newPrs[] = $row;
        }

        return $newPrs;
    }

    private function insertNewPrs(array $pullRequests)
    {
        collect($pullRequests)->each(function ($pr) {
            $pullRequest = PullRequest::create([
                'pr_id' => $pr['id'],
                'title' => $pr['title'],
            ]);

            FetchPullRequestInfo::dispatch($pullRequest);
        });
    }
}
