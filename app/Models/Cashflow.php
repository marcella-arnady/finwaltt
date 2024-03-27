<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    public $timestamps = false;
      //not using the default id
    public $incrementing = false;

    protected $fillable = ['id', 'name'];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
