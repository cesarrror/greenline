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

    public function user(){
        return $this->belongsTo('App\User', 'user_id')->select('first_name', 'last_name', 'email', 'celphone', 'avatar', 'active', 'role_id');
    }

    public function ticket(){
        return $this->hasMany('App\Tickets', 'ticket_id', 'ticket');
    }
}
