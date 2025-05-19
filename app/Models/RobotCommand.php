<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'command',
        'status',
        'sent_by',
        'patient_id',
        'response',
    ];
}
