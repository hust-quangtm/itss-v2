<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    const ORDER = [
        'most' => 1,
        'least' => 2,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_name', 'description', 'image', 'price', 'requirement', 'teacher_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function learner()
    {
        return $this->belongsToMany(User::class, 'course_users');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id')->whereNull('lesson_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'course_tags');
    }

    public function courseTag()
    {
        return $this->hasMany(CourseTag::class);
    }

    public function getCountUserAttribute()
    {
        return $this->learner()->count();
    }

    public function getCountLessonAttribute()
    {
        return $this->lessons()->count();
    }

    public function getTimeAttribute()
    {
        $allTime = $this->lessons()->sum('time');
        $timeFormatHours = floor($allTime / 60);
        $timeFormatMinutes = ceil($allTime - floor($allTime / 60) * 60);
        $timeFormat = [
            'hours' => $timeFormatHours,
            'minutes' => $timeFormatMinutes
        ];

        // if ($timeFormat['hours'] == 0) {
        //     $time = $timeFormat['minutes'] . "(m)";
        // } else {
        //     $time = $timeFormat['hours'] . " (h) " . $timeFormat['minutes'] . "(m)";
        // }
        // return $time;
        return $timeFormat;
    }

    public function getTagsAttribute()
    {
        return $this->tag;
    }

    public function getTagCourseAttribute()
    {
        $tagArr = $this->tag;
        if (count($tagArr)) {
            $tagString = $tagArr->first()->tag_name;

            for ($i = 1; $i < count($tagArr); $i++) {
                $tagString .= ", " . $tagArr[$i]->tag_name;
            }
        } else {
            $tagString = "";
        }

        return $tagString;
    }

    public function getCourseReviewCountAttribute()
    {
        return $this->reviews->count();
    }

    public function getCourseAvgStarAttribute()
    {
        $avgStar = $this->reviews->avg('rating');
        return floor($avgStar);
    }

    public function getCourseRatingCount($star)
    {
        $query = $this->reviews->where('rating', $star)->count();
        return $query;
    }

    public function getCoursePrecentRating($star)
    {
        $query = $this->getCourseRatingCount($star);
        $allRatingCount = ($this->course_review_count) ?: 1;
        $percent = $query / $allRatingCount * 100;
        return $percent;
    }

    public function getCheckUserCourseAttribute()
    {
        if (Auth::user() == null) {
            return false;
        } else {
            $check = $this->learner()->wherePivot("user_id", Auth::user()->id)->exists();
            return $check;
        }
    }

    public function scopeSearchFilter($query, $request)
    {
        // dd($request->toArray());
        $querry = null;

        if ($request->tag != 0) {
            $querry = $query->whereHas('tag', function (Builder $q) use ($request) {
                $q->where('tag_id', $request->tag);
            });
        }

        if ($request->has('searched')) {
            if ($request->searched == Course::ORDER['most']) {
                $querry = $this->orderByDesc('id');
            }

            if ($request->searched == Course::ORDER['least']) {
                $querry = $this->orderBy('id');
            }
        }

        if ($request->has('student')) {
            if ($request->student == Course::ORDER['most']) {
                $querry = $query->withCount('learner')->orderByDesc('learner_count');
            }

            if ($request->student == Course::ORDER['least']) {
                $querry = $query->withCount('learner')->orderBy('learner_count');
            }
        }

        if ($request->has('lesson')) {
            if ($request->lesson == Course::ORDER['most']) {
                $querry = $query->withCount('lessons')->orderBy('lessons_count', 'desc');
            }

            if ($request->lesson == Course::ORDER['least']) {
                $querry = $query->withCount('lessons')->orderBy('lessons_count');
            }
        }

        if ($request->has('review')) {
            if ($request->review == Course::ORDER['most']) {
                $querry = $query->withCount('reviews')->orderByDesc('reviews_count');
            }

            if ($request->review == Course::ORDER['least']) {
                $querry = $query->withCount('reviews')->orderBy('reviews_count');
            }
        }

        if ($request->has('time')) {
            if ($request->time == Course::ORDER['most']) {
                $querry = $query->addSelect(['time' => Lesson::selectRaw('sum(time) as total')
                    ->whereColumn('course_id', 'courses.id')
                    ->groupBy('course_id')
                ])->orderByDesc('time');
            }

            if ($request->time == Course::ORDER['least']) {
                $querry = $query->addSelect(['time' => Lesson::selectRaw('sum(time) as total')
                    ->whereColumn('course_id', 'courses.id')
                    ->groupBy('course_id')
                ])->orderBy('time');
            }
        }

        if ($request->has('name')) {
            $querry = Course::where('course_name', 'like', '%' . $request->name . '%');
        }

        if ($request->teacher) {
            $query->where('teacher_id', $request->teacher);
        }

        return $querry;
    }

    public function scopeFindByTag($query, $tag)
    {
        if ($tag) {
            $query->whereHas('tag', function (Builder $q) use ($tag) {
                $q->where('tag_id', $tag);
            })->get();
        }
        return $query;
    }

    public function scopeOrderByStudents($query, $students)
    {
        if ($students == Course::ORDER['most']) {
            $query->withCount('learner')->orderByDesc('learner_count');
        }
        return $query;
    }

}
