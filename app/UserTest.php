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
        'start_at',
        'end_at',
        'total_correct_questions',
        'total_incorrect_questions',
        'is_passed',
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

    public function userTestSheets()
    {
        return $this->hasMany(UserTestSheet::class);
    }

    public function isPassd()
    {
        return ($this->is_passed) ? 1 : 0;
    }
}
