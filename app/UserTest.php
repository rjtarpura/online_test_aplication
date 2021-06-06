<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTest extends Model
{
    use SoftDeletes;

    protected $table = "user_tests";

    protected $dates = [
        'start_at',
        'end_at',
    ];

    protected $fillable = [
        'user_id',
        'questions_attempted',
        'correct_answers',
        'incorrect_answers',
        'start_at',
        'end_at',
        'is_passed',
        'is_auto_stop',
    ];

    /**
     * Scope to filter only active tests
     */
    public function scopeActive($query)
    {
        return $query->whereNull('user_tests.end_at');
    }

    /**
     * Scope to filter only completed tests
     */
    public function scopeInActive($query)
    {
        return $query->whereNotNull('user_tests.end_at');
    }

    /**
     * Scope to filter canceled test
     */
    public function scopeCompleted($query)
    {
        return $query->where('user_tests.is_auto_stop', 0);
    }

    public function userTestSheets()
    {
        return $this->hasMany(UserTestSheet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPassed()
    {
        if (is_null($this->is_passed)) {
            return 0;
        }
        
        return ($this->is_passed) ? 1 : 0;
    }

    public function isFailed()
    {
        if (is_null($this->is_passed)) {
            return 0;
        }

        return !$this->isPassed();
    }
}
