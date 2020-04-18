<?php

namespace App\Console\Commands;

use App\PullRequest;
use Illuminate\Console\Command;
use App\Jobs\FetchPullRequestInfo;

class FetchMissingAuthors extends Command
{
    protected $signature = 'pr:missing-authors';

     protected $description = 'Fetch missing authors of pull requests';

    public function handle()
    {
        PullRequest::whereNull('author_id')->chunk(100, function($pullRequests){
            foreach($pullRequests as $pr)
                FetchPullRequestInfo::dispatch($pr);
        });
    }
}
