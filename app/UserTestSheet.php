<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTestSheet extends Model
{
    // use SoftDeletes;

    protected $table = "user_tests_sheet";

    protected $fillable = [
        'user_test_id',
        'question_id',
        'answer_option',
        'is_correct',
    ];

    public function scopeCorrectAnswers($query) {
        return $query->where('is_correct', true);
    }

    public function scopeInCorrectAnswers($query) {
        return $query->where('is_correct', false);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
