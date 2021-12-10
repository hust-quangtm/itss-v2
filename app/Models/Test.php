<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $table = 'tests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'test_name',
        'description',
        'course_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id', 'id');
    }
}
