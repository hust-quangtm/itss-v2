<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $table = 'options';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'points',
        'created_at',
        'updated_at',
        'deleted_at',
        'question_id',
        'option_text',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
