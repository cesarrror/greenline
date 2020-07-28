<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    /**
     *  The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'user_id', 'ticket', 'subtotal', 'taxes'
    ];

    protected $attributes = [
        'subtotal' => 0,
        'taxes' => 0
    ];
}
