<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public const STATUS = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected'
    ];

    protected $with = ['user'];

    protected $dates = ['datefrom', 'dateto'];

    protected $fillable = [
        'user_id',
        'datefrom',
        'dateto',
        'days',
        'reason',
    ];

    public function scopeCurrentYear($query)
    {
        return $query->whereYear('created_at', '=', date('Y'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
