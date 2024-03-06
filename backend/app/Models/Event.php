<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Event extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'image',
        'description',
    ];
}
