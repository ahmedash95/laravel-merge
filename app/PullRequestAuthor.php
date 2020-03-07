<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PullRequestAuthor extends Model
{
    public $guarded = [];

    public function url(){
        return route('authors.show',['name' => $this->name]);
    }

    public function pullRequests(){
        return $this->hasMany(PullRequest::class,'author_id');
    }
}
