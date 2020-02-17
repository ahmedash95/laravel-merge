<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    public $guarded = [];

    public $casts = [
        'pr_merged_at' => 'datetime',
    ];

    public const blackListTitles = [
        'Apply fixes from StyleCI',
    ];

    public static function byPrId($id)
    {
        return static::where('pr_id', $id);
    }

    public function getRepo(): string
    {
        return 'laravel/framework';
    }

    public function isToday()
    {
        return $this->pr_merged_at->diffInHours(Carbon::today()) < 24;
    }

    public function ScopeLatestMerged($query)
    {
        return $query->orderByDesc('pr_merged_at');
    }

}
