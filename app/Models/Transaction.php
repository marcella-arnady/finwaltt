<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;
      //not using the default id
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'amount', 'date', 'note', 'category_id', 'cashflow_id', 'user_id', 'wallet_id'];

    public static function generateID()
    {
        $latestID = static::max('id');
        $firstID = static::min('id');

        if (!$latestID) {
            return 'TR0001';
        }

        $lastNumber = (int)substr($latestID, 2);
        $firstNumber = (int)substr($firstID, 2);

        for ($i = $firstNumber; $i <= $lastNumber + 1; $i++) {
            $newID = 'TR' . sprintf('%04d', $i);

            $existingID = static::where('id', $newID)->exists();

            if (!$existingID) {
                return $newID;
            }
        }
        return 'TR' . sprintf('%04d', $lastNumber + 1);
    }

    public function userwallet(){
        return $this->belongsTo(Userwallet::class, 'wallet_id', 'wallet_id');
    }

    public function cashflow(){
        return $this->belongsTo(Cashflow::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
