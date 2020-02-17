<?php

namespace App\Console\Commands;

use App\Process\GitHubInterface;
use App\Task;
use App\Traits\taskable;
use Illuminate\Console\Command;

class LaravelUpdate extends Command
{
    use taskable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clone & update latest commits';

    private $repo = 'laravel/framework';

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
     * @param GitHubInterface $command
     */
    public function handle(GitHubInterface $command)
    {
        try {
            $output = $command->clone($this->repo);
            $this->logTask('clone', $output);
        } catch (\Exception $e) {
            logger($e->getMessage());
        }

        $output = $command->pull($this->repo);
        $this->logTask('pull', $output);
    }
}
