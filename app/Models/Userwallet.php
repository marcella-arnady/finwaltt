<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Userwallet extends Model
{
    public $timestamps = false;
      //not using the default id
    public $incrementing = false;
    //composite primary keys
    protected $primaryKey = ['user_id', 'wallet_id'];

    protected $fillable = ['user_id', 'wallet_id', 'amount'];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'wallet_id', 'wallet_id');
    }

    //overridng method to save query to ensure the correct record is targeted because it uses composite keys
    protected function setKeysForSaveQuery($query)
    {
        return $query->where('user_id', '=', $this->getAttribute('user_id'))->where('wallet_id', '=', $this->getAttribute('wallet_id'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
