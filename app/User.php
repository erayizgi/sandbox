<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = ["balance"];

    public function getBalanceAttribute()
    {
        $balance_sum =  DB::table("balance")
            ->where("user_id",$this->attributes["id"])
            ->select("*")
            ->sum("amount");

        return (float) $balance_sum;
    }
}
