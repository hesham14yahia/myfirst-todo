<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Invitation extends Model
{
    public function worker(){
        return $this->belongsTo('App\User', 'worker_id');
    }
    public function admin(){
        return $this->belongsTo('App\User', 'admin_id');
    }
}
