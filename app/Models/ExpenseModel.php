<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'purpose', 'amount'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
