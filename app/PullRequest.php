<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    public $guarded = [];

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

}
