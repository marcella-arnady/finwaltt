<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    public $timestamps = false;
    //not using the default id
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'amount', 'month', 'note', 'category_id', 'user_id'];

    public static function generateID()
    {
        $latestID = static::max('id');
        $firstID = static::min('id');

        if (!$latestID) {
            return 'BU0001';
        }

        $lastNumber = (int)substr($latestID, 2);
        $firstNumber = (int)substr($firstID, 2);

        for ($i = $firstNumber; $i <= $lastNumber + 1; $i++) {
            $newID = 'BU' . sprintf('%04d', $i);

            $existingID = static::where('id', $newID)->exists();

            if (!$existingID) {
                return $newID;
            }
        }
        return 'BU' . sprintf('%04d', $lastNumber + 1);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
