<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class Review extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'rating', 'user_id', 'course_id', 'lesson_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatCreatedAtAttribute()
    {
        $createdAt = Carbon::parse($this->created_at)->format('F j, Y \a\t g:i a');
        return $createdAt;
    }
}
