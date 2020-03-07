<?php

namespace App\Http\Controllers;

use App\PullRequest;
use App\PullRequestAuthor;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function show($name) {
        $author = PullRequestAuthor::where('name',$name)->firstOrFail();
        $pullRequests = PullRequest::where('author_id', $author->id)->LatestMerged()->simplePaginate(20);
        $summary = $author->getSummary();

        return view('authors.show',[
            'author' => $author,
            'pullRequests' => $pullRequests,
            'summary' => $summary,
        ]);
    }
}
