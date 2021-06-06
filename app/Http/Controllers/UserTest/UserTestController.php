<?php

namespace App\Http\Controllers\UserTest;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTest\ManageUserTestRequest;
use App\Http\Requests\UserTest\UserTestAnswerRequest;
use App\Http\Requests\UserTest\UserTestRequest;
use App\Http\Requests\UserTest\UserTestStartRequest;
use App\Repositories\UserTestRepository;
use App\UserTest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        if (!$this->repository->stopActiveTest()) {
            return redirect()->route("home")->withError("Unable to stop active test. Please try again.");
        }

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
        if ($this->repository->start()) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Manage User Tests
     *
     * @param  \App\Http\Requests\UserTest\ManageUserTestRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function manageTests(ManageUserTestRequest $request)
    {
        return view('user-test.tests');
    }

    /**
     * Get datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTable()
    {
        return DataTables::of($this->repository->getTable())
            ->escapeColumns([])
            ->filterColumn('candidate_name', function ($userTest, $keyword) {
                $userTest->where('users.name', 'like', "%{$keyword}%");
            })
            ->editColumn('start_at', function ($userTest) {
                return ($userTest->start_at) ? $userTest->start_at->format('Y-m-d H:i:s') : null;
            })
            ->editColumn('end_at', function ($userTest) {
                return ($userTest->end_at) ? $userTest->end_at->format('H:i:s') : null;
            })
            ->editColumn('is_passed', function ($userTest) {
                $html = "";

                if ($userTest->is_passed === 1) {
                    $html = "<span class='label label-sm label-success'>Passed</span>";
                } elseif ($userTest->is_passed === 0) {
                    $html = "<span class='label label-sm label-danger'>Failed</span>";
                } elseif (!$userTest->end_at) {
                    $html = "<span class='label label-sm label-info'>On Going</span>";
                }

                return $html;
            })
            ->editColumn('is_auto_stop', function ($userTest) {
                $html = "";

                if ($userTest->is_auto_stop === 1) {
                    $html = "<span class='label label-sm label-danger'>Yes</span>";
                } elseif ($userTest->is_passed === 0) {
                    $html = "<span class='label label-sm label-success'>No</span>";
                } elseif (!$userTest->end_at) {
                    $html = "N/A";
                }

                return $html;
            })
            ->addColumn('time_taken', function ($userTest) {
                return ($userTest->userTestSheets) ? gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) : "00:00";
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTest  $userTest
     * @param \App\Http\Requests\UserTest\ManageUserTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(UserTest $userTest, ManageUserTestRequest $request)
    {
        return view('user-test.show')->withUserTest($userTest);
    }
}
