<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag_name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function getFormatCreatedAtAttribute()
    {
        $createdAt = Carbon::parse($this->created_at)->format('F j, Y \a\t g:i a');
        return $createdAt;
    }

    public function courseTag()
    {
        return $this->belongsToMany(Course::class, 'course_tag');
    }
}
