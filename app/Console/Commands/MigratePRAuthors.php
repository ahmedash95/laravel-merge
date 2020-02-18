<?php

namespace App\Console\Commands;

use App\PullRequest;
use App\PullRequestAuthor;
use Illuminate\Console\Command;

class MigratePRAuthors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pr:author-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate authors from pull_request to pull_request_authors_table';

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
     * @return mixed
     */
    public function handle()
    {
        PullRequest::whereNull('author_id')->get()->map(function(PullRequest $pullRequest){
            $author = PullRequestAuthor::firstOrCreate(
                [
                    'name' => $pullRequest->author_name
                ],
                [
                    'name' => $pullRequest->author_name,
                    'photo' => $pullRequest->author_photo
                ]
            );

            $pullRequest->update(['author_id' => $author->id]);
        });
    }
}
