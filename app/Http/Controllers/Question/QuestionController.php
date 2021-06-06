<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionManageRequest;
use App\Http\Requests\Question\QuestionStoreRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    /**
     * @var \App\Repositories\QuestionRepository  $repository
     */
    private $repository;

    /**
     * @param \App\Repositories\QuestionRepository
     */
    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\Question\QuestionManageRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionManageRequest $request)
    {
        return view('question.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \App\Http\Requests\Question\QuestionManageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionManageRequest $request)
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Question\QuestionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        if ($this->repository->store($request->validated())) {
            return redirect()->route("questions.index")->withSuccess("Question added successfully.");
        } else {
            return back()->withError("Question not added.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @param  \App\Http\Requests\Question\QuestionManageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, QuestionManageRequest $request)
    {
        return view('question.show')->withQuestion($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @param  \App\Http\Requests\Question\QuestionManageRequest  $request
     */
    public function edit(Question $question, QuestionManageRequest $request)
    {
        return view('question.edit')->withQuestion($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Question  $question
     * @param  \App\Http\Requests\Question\QuestionUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, QuestionUpdateRequest $request)
    {
        if ($this->repository->update($question, $request->validated())) {
            return redirect()->route("questions.index")->withSuccess("Question updated successfully.");
        } else {
            return back()->withError("Question not updated.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @param  \App\Http\Requests\Question\QuestionManageRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, QuestionManageRequest $request)
    {
        if($question->userTestSheets->count()){
            return back()->withError("Tests conducted on this question. Can't delete.");
        }

        if ($this->repository->destroy($question)) {
            return redirect()->route("questions.index")->withSuccess("Question deleted successfully.");
        } else {
            return back()->withError("Question not deleted.");
        }
    }

    /**
     * Get datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTable()
    {
        return DataTables::of($this->repository->getTable())
            ->editColumn('created_at', function ($question) {
                return ($question->created_at) ? $question->created_at->format('Y-m-d') : null;
            })
            ->editColumn('updated_at', function ($question) {
                return ($question->updated_at) ? $question->updated_at->format('Y-m-d') : null;
            })
            ->make(true);
    }
}
