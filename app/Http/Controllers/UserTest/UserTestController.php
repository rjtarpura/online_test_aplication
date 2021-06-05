<?php

namespace App\Http\Controllers\UserTest;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTest\UserTestAnswerRequest;
use App\Http\Requests\UserTest\UserTestRequest;
use App\Http\Requests\UserTest\UserTestStartRequest;
use App\Question;
use App\Repositories\UserTestRepository;
use App\UserTest;
use Illuminate\Http\Request;

class UserTestController extends Controller
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
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\UserTest\UserTestRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function index(UserTestRequest $request)
    {
        return view('user-test.index');
    }

    /**
     * @param  \App\Http\Requests\UserTest\UserTestRequest  $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function load(UserTestRequest $request)
    {
        $htmlOrFalse = $this->repository->loadData();

        if ($htmlOrFalse === false) {
            return response()->json([
                'status' => false,
                'html' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'html' => $htmlOrFalse
        ]);
    }

    /**
     * 
     * @param \App\UserTest  $userTest
     * @param  \App\Http\Requests\UserTest\UserTestAnswerRequest  $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function answer(UserTest $userTest, UserTestAnswerRequest $request)
    {
        $htmlOrFalse = $this->repository->answer($userTest, $request->validated());

        if ($htmlOrFalse === false) {
            return response()->json([
                'status' => false,
                'html' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'html' => $htmlOrFalse
        ]);
    }

    /**
     * Start new test
     *
     * @param  \App\Http\Requests\UserTest\UserTestStartRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function start(UserTestStartRequest $request)
    {
        if($this->repository->start()) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
