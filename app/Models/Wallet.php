<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wallet extends Model
{
    use HasFactory;

    public $timestamps = false;
      //not using the default id
    public $incrementing = false;

    public function users(){
        return $this->belongsToMany(User::class, "userwallets")->withPivot('amount');
    }

    public function userWallets()
    {
        return $this->hasMany(UserWallet::class);
    }
}
