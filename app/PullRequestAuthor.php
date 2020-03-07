<?php

namespace App;

use Illuminate\Support\Facades\DB;
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

    public function getSummary(){
        return DB::table('pull_requests')
            ->selectRaw('DATE(pr_created_at) created_at, count(*) as total')
            ->where('author_id',$this->id)
            ->groupByRaw('DATE(pr_created_at)')
            ->limit(7)
            ->get()
            ->mapWithKeys(function($row){
                return [$row->created_at => $row->total];
            });
    }
}
