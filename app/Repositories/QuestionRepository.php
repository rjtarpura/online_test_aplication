<?php

namespace App\Repositories;

use App\Question;
use Exception;

class QuestionRepository
{
    /**
     * Get data for datatable
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTable()
    {
        $query = Question::select([
            'questions.id',
            'questions.question',
            'questions.option_a',
            'questions.option_b',
            'questions.option_c',
            'questions.option_d',
            'questions.created_at',
            'questions.updated_at',
        ]);

        return $query;
    }

    /**
     * Store Question
     * 
     * @param array $input     * 
     * @return boolean
     */
    public function store($input)
    {
        try {
            Question::create($input);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update Question
     * 
     * @param \App\Question  $queston
     * @param array $input
     * @return boolean
     */
    public function update(Question $question, $input)
    {
        try {
            $question->update($input);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Destroy Question
     * 
     * @param \App\Question  $queston
     * @return boolean
     * 
     */
    public function destroy(Question $question)
    {
        try {
            return $question->delete();
        } catch (Exception $e) {
            return false;
        }
    }
}
