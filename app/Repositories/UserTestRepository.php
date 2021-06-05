<?php

namespace App\Repositories;

use App\Question;
use App\UserTest;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserTestRepository
{

    /**
     * load initial data
     */
    public function loadData()
    {
        $html = "";
        $questionsCount = Question::count();
        $activeTest = Auth::user()->activeTest;

        if ($questionsCount == 0) {
            return "<div class='widget-box ui-sortable-handle'>
                    <div class='widget-header'>
                        <h5 class='widget-title'>Start Test !!</h5>
                    </div>
                    <div class='widget-body'>
                        <div class='widget-main'>
                            <div class='alert alert-block alert-info'>
                                <p>
                                    <strong>
                                        <i class='ace-icon fa fa-check'></i>
                                        Alas !!
                                    </strong>
                                    Currently there are no questions in databases for test. Please try later.
                                </p>

                                <p>
                                    <a href='" . route('home') . "' type='button' class='btn btn-sm btn-info'>Back To Home</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>";
        }

        if ($activeTest instanceof UserTest) {
            return $this->generateHtml($activeTest);
        }

        return "<div class='widget-box ui-sortable-handle'>
                    <div class='widget-header'>
                        <h5 class='widget-title'>Start Test !!</h5>
                    </div>
                    <div class='widget-body'>
                        <div class='widget-main'>
                            <div class='alert alert-block alert-info'>
                                <p>
                                    <strong>
                                        <i class='ace-icon fa fa-check'></i>
                                        Hey !!
                                    </strong>
                                    You can start a new test !!
                                </p>

                                <p>
                                    <button type='button' class='btn btn-sm btn-info start-test'>Start Test</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    /**
     * load user answer
     * 
     * @param \App\UserTest  $userTest
     * @param array $input
     */
    public function answer(UserTest $userTest, $input)
    {
        $html = "";
        $question = Question::findOrFail($input['question_id']);

        try {
            $userTest->userTestSheets()->create(array_merge($input, [
                'is_correct'    => ($question->correct_answer == $input['answer_option']) ? true : false,
            ]));

            $questionsCount = Question::count();
            $attemptedQuestionsCount = $userTest->userTestSheets->count();

            if ($questionsCount == $attemptedQuestionsCount) {

                $passingPercentage = env('PASSING_PERCENTAGE', 70) / 100;
                $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
                $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();
                $userPercentage = $correctQuestionsCount / $attemptedQuestionsCount;

                $userTest->update([
                    'end_at'                    => now(),
                    'total_correct_questions'   =>  $correctQuestionsCount,
                    'total_incorrect_questions' =>  $inCorrectQuestionsCount,
                    'is_passed'                 =>  $userPercentage >= $passingPercentage,
                ]);
            }

            return $this->generateHtml($userTest);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Generate HTML
     * 
     * @param \App\UserTest  $userTest
     */
    public function generateHtml(UserTest $userTest)
    {
        $questionsCount = Question::count();
        $attemptedQuestions = $userTest->userTestSheets;
        $attemptedQuestionsCount = $attemptedQuestions->count();
        $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
        $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();

        if ($questionsCount == $attemptedQuestionsCount) {
            // return result response

            $passingPercentage = env('PASSING_PERCENTAGE', 70) / 100;
            $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
            $userPercentage = $correctQuestionsCount / $attemptedQuestionsCount;

            $className = "alert-danger";
            $title = "Alsa!";
            $message = "You have failed in the test. !!";
            $btnClass = "btn-danger";

            if ($userPercentage >= $passingPercentage) {
                $className = "alert-success";
                $title = "Congratulations!";
                $message = "You have successfully completed the test !!";
                $btnClass = "btn-success";
            }

            return "<div class='widget-box ui-sortable-handle'>
                        <div class='widget-header'>
                            <h5 class='widget-title'>Test Completed !!</h5>
                        </div>
                        <div class='widget-body'>
                            <div class='widget-main'>
                                <div class='alert alert-block {$className}'>
                                    <p>
                                        <strong>
                                            <i class='ace-icon fa fa-check'></i>
                                            {$title}
                                        </strong>
                                        {$message}
                                    </p>

                                    <p>
                                        Your Socre is: {$correctQuestionsCount}/{$questionsCount}
                                    </p>

                                    <p>
                                        <a href='" . route('home') . "' class='btn btn-sm {$btnClass}'>Go to Home</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>";
        } else {

            // return question response

            $attemptedQuestionsIds = $attemptedQuestions->pluck('question_id')->toArray();
            $nextQuestion = Question::inRandomOrder()->whereNotIn('id', $attemptedQuestionsIds)->first();
            $buttonText = ($attemptedQuestionsCount == $questionsCount - 1) ? "Finish" : "Next <i class='ace-icon fa fa-arrow-right icon-on-right'></i>";
            $attemptedQuestionsCount++;

            return "<div class='widget-box ui-sortable-handle'>
                    <div class='widget-header'>
                        <h5 class='widget-title'>Question #{$attemptedQuestionsCount}/{$questionsCount}</h5>
                    </div>
                    <div class='widget-body'>
                        <form>
                            <div class='widget-main'>
                                <p class='alert alert-info'>{$nextQuestion->question}</p>
                
                                <div class='control-group'>
                                    <div class='radio'>
                                        <label>
                                            <input type='radio' class='ace' value='option_a'>
                                            <span class='lbl'> {$nextQuestion->option_a}</span>
                                        </label>
                                    </div>
                
                                    <div class='radio'>
                                        <label>
                                            <input type='radio' class='ace' value='option_b'>
                                            <span class='lbl'> {$nextQuestion->option_b}</span>
                                        </label>
                                    </div>

                                    <div class='radio'>
                                        <label>
                                            <input type='radio' class='ace' value='option_c'>
                                            <span class='lbl'> {$nextQuestion->option_c}</span>
                                        </label>
                                    </div>

                                    <div class='radio'>
                                        <label>
                                            <input type='radio' class='ace' value='option_d'>
                                            <span class='lbl'> {$nextQuestion->option_d}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class='widget-toolbox padding-8 clearfix'>
                                <div class='pull-right'>
                                    <button class='btn btn-xs btn-success save-and-next' type='button' data-userTestId='{$userTest->id}' data-questionId='{$nextQuestion->id}'>
                                        <span class='bigger-110'>{$buttonText}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>";
        }
    }

    /**
     * Start New Test
     */
    public function start()
    {
        $activeTest = Auth::user()->activeTest;

        if (!$activeTest instanceof UserTest) {
            try {

                $activeTest = Auth::user()->tests()->create([
                    'start_at' => now(),
                ]);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }
}
