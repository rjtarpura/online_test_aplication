<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\BaseApiController;
use App\Http\Requests\API\Test\TestSaveRequest;
use App\Http\Resources\QuestionResource;
use App\Question;
use App\Repositories\UserTestRepository;
use Illuminate\Http\Request;

class TestApiController extends BaseApiController
{
    /**
     * @var \App\Repositories\UserTestRepository  $repository
     */
    private $repository;

    /**
     * @param \App\Repositories\UserTestRepository
     */
    public function __construct(UserTestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get All questions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestions()
    {
        $questions = Question::all();
        return $this->respond([
            'status_code'   =>  200,
            'message'       =>  $questions->count() . " question(s) found.",
            'questions'     =>  QuestionResource::collection($questions),
        ]);
    }

    /**
     * Get All questions
     *
     * @param \App\Http\Requests\API\Test\TestSaveRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveResult(TestSaveRequest $request)
    {
        $result = $this->repository->storeTestData($request->validated());

        return $this->respond([
            'status_code'   =>  200,
            'message'       =>  "Test saved successfully.",
            'result'        =>  $result,
        ]);
    }
}
