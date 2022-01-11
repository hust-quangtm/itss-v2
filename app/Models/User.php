<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    const ROLE = [
        'user' => 1,
        'teacher' => 2,
        'system' => 3,
    ];

    const ROLE_LABEL = [
        'user' => 'User',
        'teacher' => 'Teacher',
        'system' => 'System',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'birth_day', 'address', 'about', 'phone', 'avatar', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users');
    }

    public function getIsTeacherAttribute()
    {
        return $this->role_id == self::ROLE['teacher'];
    }

    public function getRoleLabelAttribute()
    {
        return self::ROLE_LABEL[array_flip(self::ROLE)[$this->role_id]];
    }

    public function lessonLearned()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_users')->withPivot('id');
    }

    public function getFormatBirthDayAttribute()
    {
        $createdAt = Carbon::parse($this->birth_day)->format('M d Y');
        return $createdAt;
    }

    public function userResults()
    {
        return $this->hasMany(Result::class, 'user_id', 'id');
    }
}
