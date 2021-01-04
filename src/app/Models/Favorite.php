<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed
     */
    private $favorite_tweet_id;

    protected $fillable = [
        'id',
        'user_id',
        'favorite_tweet_id',
    ];
}
