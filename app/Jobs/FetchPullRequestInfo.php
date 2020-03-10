<?php

namespace App\Jobs;

use App\Api\GitHubAPI;
use App\Notifications\TweetNewPRMerged;
use App\PullRequest;
use App\PullRequestAuthor;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
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
    public function handle(GitHubAPI $api,Application $app)
    {
        $prInfo = $api->getPullRequestInfo($this->pullRequest->getRepo(),$this->pullRequest->pr_id);

        $author = PullRequestAuthor::firstOrCreate(
            [
                'name' => $prInfo['user']['login']
            ],
            [
                'name' => $prInfo['user']['login'],
                'photo' => $prInfo['user']['avatar_url'],
            ]
        );

        $this->pullRequest->update([
           'url' => $prInfo['html_url'],
           'content' => $prInfo['body'],
           'pr_created_at' => Carbon::parse($prInfo['created_at']),
           'pr_merged_at' => Carbon::parse($prInfo['merged_at']),
           'author_id' => $author->id,
           'is_published' => true,
        ]);

        if(!$app->environment('local') && config('services.twitter.publish_tweets')) {
            $this->pullRequest->fresh()->notify(new TweetNewPRMerged());
        }
    }
}
