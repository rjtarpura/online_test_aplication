<?php

namespace App\Repositories;

use App\Events\TestCompleted;
use App\Exceptions\GeneralException;
use App\Question;
use App\UserTest;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserTestRepository
{
    /**
     * Get data for datatable
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTable()
    {
        $query = UserTest::select([
            'user_tests.id',
            'user_tests.questions_attempted',
            'user_tests.correct_answers',
            'user_tests.incorrect_answers',
            'user_tests.is_passed',
            'user_tests.is_auto_stop',
            'users.name as candidate_name',
            'user_tests.start_at',
            'user_tests.end_at',
        ])
            ->leftJoin('users', 'users.id', '=', 'user_tests.user_id');

        return $query;
    }

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

        $questionsCount = Question::count();
        $duration = config('app.question_timer_seconds', 120);

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
                                    <strong>
                                        Please Note: 
                                    </strong>
                                    <p>There are total {$questionsCount} questions and duration of each question is {$duration} seconds. After that the question will be auto submitted.</p>
                                    <p>Please don't refresh or navigate to other page, as it will cancel you test.</p>
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
        $timeTaken = config('app.question_timer_seconds', 120);

        if (session()->has('question_start_time')) {
            $startTime = session()->pull('question_start_time');
            $timeTaken = now()->diffInSeconds($startTime);
        }

        try {
            $userTest->userTestSheets()->create(array_merge($input, [
                'is_correct'    => (isset($input['answer_option']) && $question->correct_answer == $input['answer_option']) ? true : false,
                'time_taken'    => $timeTaken,
            ]));

            $questionsCount = Question::count();
            $attemptedQuestionsCount = $userTest->userTestSheets->count();

            $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
            $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();
            $userPercentage = ($attemptedQuestionsCount == 0) ? 0 : $correctQuestionsCount / $attemptedQuestionsCount;

            if ($questionsCount == $attemptedQuestionsCount) {

                $passingPercentage = config('app.passing_percentage', 70) / 100;

                $userTest->update([
                    'end_at'                =>  now(),
                    'questions_attempted'   =>  $correctQuestionsCount + $inCorrectQuestionsCount,
                    'correct_answers'       =>  $correctQuestionsCount,
                    'incorrect_answers'     =>  $inCorrectQuestionsCount,
                    'is_passed'             =>  $userPercentage >= $passingPercentage,
                    'is_auto_stop'          =>  false,
                ]);

                $userTest->refresh();

                event(new TestCompleted($userTest));
            } else {
                $userTest->update([
                    'questions_attempted'   =>  $correctQuestionsCount + $inCorrectQuestionsCount,
                    'correct_answers'       =>  $correctQuestionsCount,
                    'incorrect_answers'     =>  $inCorrectQuestionsCount,
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

            $passingPercentage = config('app.passing_percentage', 70) / 100;
            $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
            $userPercentage = $correctQuestionsCount / $attemptedQuestionsCount;
            $timeTaken = $attemptedQuestions->sum('time_taken');

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

                                    <p>Your Socre is: {$correctQuestionsCount}/{$questionsCount}</p>
                                    <p>Total Time: " . gmdate("i:s", $timeTaken) . "</p>

                                    <p>You'll also recieve an email of the result</p>
                                    <p>
                                        <a href='" . route('home') . "' class='btn btn-sm {$btnClass}'>Go to Home</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>";
        } else {

            // return question response

            // Put question start time in session
            session()->put('question_start_time', now());

            $attemptedQuestionsIds = $attemptedQuestions->pluck('question_id')->toArray();
            $nextQuestion = Question::inRandomOrder()->whereNotIn('id', $attemptedQuestionsIds)->first();
            $buttonText = ($attemptedQuestionsCount == $questionsCount - 1) ? "Finish" : "Next <i class='ace-icon fa fa-arrow-right icon-on-right'></i>";
            $attemptedQuestionsCount++;

            $optionsArray = ['a', 'b', 'c', 'd'];
            shuffle($optionsArray);
            $choices = "";

            foreach ($optionsArray as $alpha) {

                $optionText = $nextQuestion->{"option_" . $alpha};

                $choices .= "<div class='radio'>
                                <label>
                                    <input name='user_choice' type='radio' class='ace' value='option_{$alpha}'>
                                    <span class='lbl'> {$optionText}</span>
                                </label>
                            </div>";
            };

            return "<div class='widget-box ui-sortable-handle'>
                    <div class='widget-header'>
                        <h5 class='widget-title'>Question #{$attemptedQuestionsCount}/{$questionsCount}</h5>
                        <div class='widget-toolbar'><span class='question-time'>00:00</span>/" . gmdate("i:s", config('app.question_timer_seconds', 120)) . "</div>
                    </div>                    
                    <div class='widget-body'>
                        <form>
                            <div class='widget-main'>
                                <p class='alert alert-info'>{$nextQuestion->question}</p>
                
                                <div class='control-group'>
                                    {$choices}
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

    /**
     * Stop active test
     */
    public function stopActiveTest()
    {
        $userTest = Auth::user()->activeTest;

        if ($userTest instanceof UserTest) {

            try {

                $attemptedQuestionsCount = $userTest->userTestSheets->count();
                $passingPercentage = config('app.passing_percentage', 70) / 100;
                $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
                $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();
                $userPercentage = ($attemptedQuestionsCount == 0) ? 0 : $correctQuestionsCount / $attemptedQuestionsCount;

                $userTest->update([
                    'end_at'                => now(),
                    'questions_attempted'   =>  $correctQuestionsCount + $inCorrectQuestionsCount,
                    'correct_answers'       =>  $correctQuestionsCount,
                    'incorrect_answers'     =>  $inCorrectQuestionsCount,
                    'is_passed'             =>  $userPercentage >= $passingPercentage,
                    'is_auto_stop'          =>  true,
                ]);

                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return true;
    }

    /**
     * Store Test Data : API
     */
    public function storeTestData($input)
    {
        $userTest = Auth::user()->activeTest;

        try {

            if ($userTest instanceof UserTest) {

                // Stop active test
                $attemptedQuestionsCount = $userTest->userTestSheets->count();
                $passingPercentage = config('app.passing_percentage', 70) / 100;
                $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
                $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();
                $userPercentage = ($attemptedQuestionsCount == 0) ? 0 : $correctQuestionsCount / $attemptedQuestionsCount;

                $userTest->update([
                    'end_at'                => now(),
                    'questions_attempted'   =>  $correctQuestionsCount + $inCorrectQuestionsCount,
                    'correct_answers'       =>  $correctQuestionsCount,
                    'incorrect_answers'     =>  $inCorrectQuestionsCount,
                    'is_passed'             =>  $userPercentage >= $passingPercentage,
                    'is_auto_stop'          =>  true,
                ]);
            }

            $userTest = Auth::user()->tests()->create([
                'start_at'  => $input['start_at'],
            ]);

            $userTestSheetData = [];

            foreach ($input['question_id'] as  $k => $question_id) {

                $question = Question::findOrFail($question_id);

                $answer_option = $input['answer_option'][$k] ?? null;
                $time_taken = $input['time_taken'][$k] ?? null;

                $userTestSheetData[] = [
                    'question_id'   =>  $question_id,
                    'answer_option' =>  $answer_option,
                    'is_correct'    => ($question->correct_answer == $answer_option) ? true : false,
                    'time_taken'    =>  $time_taken,
                ];
            }

            $userTest->userTestSheets()->createMany($userTestSheetData);

            $attemptedQuestionsCount = $userTest->userTestSheets->count();
            $passingPercentage = config('app.passing_percentage', 70) / 100;
            $correctQuestionsCount = $userTest->userTestSheets()->correctAnswers()->count();
            $inCorrectQuestionsCount = $userTest->userTestSheets()->inCorrectAnswers()->count();
            $userPercentage = ($attemptedQuestionsCount == 0) ? 0 : $correctQuestionsCount / $attemptedQuestionsCount;

            $userTest->update([
                'end_at'                =>  $input['end_at'],
                'questions_attempted'   =>  $correctQuestionsCount + $inCorrectQuestionsCount,
                'correct_answers'       =>  $correctQuestionsCount,
                'incorrect_answers'     =>  $inCorrectQuestionsCount,
                'is_passed'             =>  $userPercentage >= $passingPercentage,
                'is_auto_stop'          =>  false,
            ]);

            $userTest->refresh();

            event(new TestCompleted($userTest));

            return [
                'questions_attempted'   =>  $userTest->questions_attempted,
                'correct_answers'       =>  $userTest->correct_answers,
                'incorrect_answers'     =>  $userTest->incorrect_answers,
                'is_passed'             =>  $userTest->is_passed,
                'total_time_taken'      =>  $userTest->userTestSheets->sum('time_taken'),
            ];
        } catch (Exception $e) {
            throw new GeneralException("Unable to store test data");
        }
    }
}
