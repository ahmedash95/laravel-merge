<?php

namespace App\Jobs;

use App\PullRequestView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PullRequestViewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;

    public $pullRequestId;

    public function __construct(int $pullRequestId,?int $userId = null)
    {
        $this->pullRequestId = $pullRequestId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        PullRequestView::create([
            'user_id' => $this->userId,
            'pull_request_id' => $this->pullRequestId,
        ]);
    }
}
