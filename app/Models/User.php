<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
      //not using the default id
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function generateID()
    {
        $latestID = static::max('id');
        $firstID = static::min('id');

        if (!$latestID) {
            return 'US0001';
        }

        $lastNumber = (int)substr($latestID, 2);
        $firstNumber = (int)substr($firstID, 2);

        for ($i = $firstNumber; $i <= $lastNumber + 1; $i++) {
            $newID = 'US' . sprintf('%04d', $i);

            $existingID = static::where('id', $newID)->exists();

            if (!$existingID) {
                return $newID;
            }
        }
        return 'US' . sprintf('%04d', $lastNumber + 1);
    }


    public function wallets(){
        return $this->belongsToMany(Wallet::class, "userwallets")->withPivot('amount');
    }

    public function budgets(){
        return $this->hasMany(Budget::class);
    }

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function userWallets()
    {
        return $this->hasMany(UserWallet::class);
    }
}
