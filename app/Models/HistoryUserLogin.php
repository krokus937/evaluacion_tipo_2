<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUserLogin extends Model
{
    use HasFactory;

    protected $table = 'history_user_login';

    protected $fillable = [
        'user_id',
        'hulIp',
        'state_ip_id',
        'hulComment'
    ];

    public function history_state_ip(){
        return $this->hasOne(StateIp::class,'id','state_ip_id');
    }

    public function history_user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
