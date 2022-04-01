<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'net_id',
        'type',
        'profile_img',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function admin()
    {
        return $this->hasOne(AdminModel::class);
    }

    public function ExpenseModel()
    {
        return $this->hasMany(ExpenseModel::class);
    }

    public function WithdrawModel()
    {
        return $this->hasMany(WithdrawModel::class);
    }

    public function customer()
    {
        return $this->hasOne(CustomerModel::class);
    }
}
