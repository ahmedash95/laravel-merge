<?php

namespace App\Http\Controllers;

use Cache;
use App\PullRequest;
use Illuminate\Http\Request;
use App\Jobs\PullRequestViewJob;

class HomeController extends Controller
{

    public const CACHE_TTL = 10080;

    public function __invoke() {

    	$pullRequests = PullRequest::with('author')->latestMerged()->simplePaginate(20);

    	return view('home',[
    		'pullRequests' => $pullRequests,
    	]);
    }

    public function redirect($id)
    {
    	$pr = Cache::remember('pr.'.$id,self::CACHE_TTL,function() use ($id) {
            return PullRequest::findOrFail($id);
        });

    	$userId = optional(auth()->user())->id;

    	PullRequestViewJob::dispatch($pr->id,$userId);

    	return redirect($pr->url);
    }
}
