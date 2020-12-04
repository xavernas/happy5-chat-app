<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'message';
    protected $fillable = [
        'conversation_id',
        'sender_sent',
        'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
