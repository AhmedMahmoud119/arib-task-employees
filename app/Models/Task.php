<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in progress';
    public const STATUS_DONE = 'done';

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_IN_PROGRESS,
            self::STATUS_DONE,
        ];
    }

    public $fillable = [
        'name',
        'description',
        'status',
        'created_user_id',
        'asssigned_user_id',
    ];

    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'asssigned_user_id');
    }

    public function createdEmployee()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function scopeMyTasks(Builder $query)
    {
        return $query->where('asssigned_user_id', auth()->user()->id)->orWhere('created_user_id', auth()->user()->id);
    }
}
