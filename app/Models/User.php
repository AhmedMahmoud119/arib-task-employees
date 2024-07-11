<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'salary',
        'image',
        'manager_id',
        'department_id',

        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getFullNameAttribute($value)
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function scopeSearchByFullName(Builder $query, $fullName)
    {
        return $query->whereRaw("CONCAT(fname, ' ', lname) LIKE ?", ["%{$fullName}%"]);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function employees()
    {
        return $this->hasMany(User::class,'manager_id','id');
    }

    public function scopeMyEmployees(Builder $query)
    {
        return $query->where('manager_id', auth()->user()->id);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
