<?php

namespace App\Http\Controllers;

use App\PullRequest;
use Illuminate\Http\Request;

class PullRequestsController extends Controller
{
    public function show($id)
    {
        $pr = PullRequest::findOrFail($id);

        return view('show', [
            'pr' => $pr,
        ]);
    }
}
