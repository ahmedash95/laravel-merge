<?php

namespace App\Http\Controllers;

use App\PullRequest;
use App\PullRequestAuthor;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function show($name) {
        $author = PullRequestAuthor::where('name',$name)->firstOrFail();
        $summary = $author->getSummary();

        $pullRequests = PullRequest::query()->where('author_id', $author->id)->LatestMerged()->simplePaginate(20);
        $pullRequests->each(function ($pr) use ($author) {
            $pr->setRelation('author', $author);
        });

        return view('authors.show',[
            'author' => $author,
            'pullRequests' => $pullRequests,
            'summary' => $summary,
        ]);
    }
}
