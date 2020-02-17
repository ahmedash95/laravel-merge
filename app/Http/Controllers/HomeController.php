<?php

namespace App\Http\Controllers;

use App\PullRequest;
use App\Jobs\PullRequestViewJob;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {
    	$pullRequests = PullRequest::latest()->simplePaginate(20);

    	return view('home',[
    		'pullRequests' => $pullRequests,
    	]);
    }

    public function redirect($id)
    {
    	$pr = PullRequest::findOrFail($id);
    	$userId = optional(auth()->user())->id;
    	
    	PullRequestViewJob::dispatch($pr->id,$userId);

    	return redirect($pr->url);
    }
}
