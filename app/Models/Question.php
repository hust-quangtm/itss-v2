<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $table = 'questions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'test_id',
        'question_text',
    ];

    public function questionOptions()
    {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }

    public function questionsResults()
    {
        return $this->belongsToMany(Result::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
