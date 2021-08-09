<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $guarded = [];

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function officials()
    {
        return $this->hasMany(Official::class, 'team_id');
    }
}
