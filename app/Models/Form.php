<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'phone',
        'courses',
        'payment_method',
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'question6',
        'question7',
        'question8',
        'question9',
        'file_upload',
        'total',
        'user_id'
    ];
    protected $casts = [
        'courses' => 'array',
    ];
}
