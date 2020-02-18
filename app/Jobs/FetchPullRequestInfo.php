<?php

namespace App\Jobs;

use App\Api\GitHubAPI;
use App\Notifications\TweetNewPRMerged;
use App\PullRequest;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchPullRequestInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var PullRequest
     */
    private $pullRequest;
    /**
     * @var GitHubAPI
     */
    private $api;

    /**
     * Create a new job instance.
     *
     * @param PullRequest $pullRequest
     * @param GitHubAPI $api
     */
    public function __construct(PullRequest $pullRequest)
    {
        $this->pullRequest = $pullRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GitHubAPI $api)
    {
        $prInfo = $api->getPullRequestInfo($this->pullRequest->getRepo(),$this->pullRequest->pr_id);
        $this->pullRequest->update([
           'url' => $prInfo['html_url'],
           'content' => $prInfo['body'],
           'pr_created_at' => Carbon::parse($prInfo['created_at']),
           'pr_merged_at' => Carbon::parse($prInfo['merged_at']),
           'author_name' => $prInfo['user']['login'],
           'author_photo' => $prInfo['user']['avatar_url'],
           'is_published' => true,
        ]);

        $this->pullRequest->fresh()->notify(new TweetNewPRMerged());
    }
}
