<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    use Notifiable;

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
        return $this->pr_merged_at 
            ? $this->pr_merged_at->format('Y-m-d') === Carbon::today()->format('Y-m-d')
            : false;
    }

    public function scopeWithValidAuthor($query)
    {
        return $query->whereNotNull('author_id');
    }

    public function scopeLatestMerged($query)
    {
        return $query->orderByDesc('pr_merged_at');
    }

    public function author() {
        return $this->belongsTo(PullRequestAuthor::class,'author_id');
    }

}
