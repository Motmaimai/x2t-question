<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Repositories\QuestionRepository;
use App\Validators\QuestionValidator;
use Yajra\DataTables\DataTables;

/**
 * Class QuestionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $repository;
    protected $categoryRepository;
    protected $unitRepository;
    /**
     * @var QuestionValidator
     */
    protected $validator;

    /**
     * QuestionsController constructor.
     *
     * @param QuestionRepository $repository
     * @param QuestionValidator $validator
     */
    public function __construct(UnitRepository $unitRepository,CategoryRepository $categoryRepository,QuestionRepository $repository, QuestionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->categoryRepository = $categoryRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $questions = $this->repository->all();
        $categories = $this->categoryRepository->all();
        $unit = $this->unitRepository->all();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $questions,
            ]);
        }

        return view('admin.pages.questions.index', compact('questions','categories','unit'));
    }
    public function listQuestion(){
        $units = $this->unitRepository->findByField('status',1);
        return view('admin.pages.questions.list-question', compact('units'));
    }
    public function listQuestionUnit($id){
        $unit = $this->unitRepository->find($id);
        return view('admin.pages.questions.list-question-unit', compact('unit'));
    }
    public function loadData(){
        if (\request()->ajax()){
            return Datatables::of($this->repository->all()['data'])
                ->addColumn('action', function($row){
                    $btn = '<a data-url="'.route('admin.questions.show',['question'=>$row['id']]).'" href="javascript:void(0)" data-toggle="modal" data-target="#modal-show" class="btn-show btn btn-info btn-sm">View</a>';
                    $btn = $btn.'<a data-url="'.route('admin.questions.edit',['question'=>$row['id']]).'" href="javascript:void(0)" data-toggle="modal" data-target="#modal-edit" class="btn-edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.'<a  data-token="'.csrf_token().'" data-id="'.$row['id'].'" data-url="'.route('admin.questions.destroy',['question'=>$row['id']]).'" href="javascript:void(0)" class="btn-delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {


            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $question = $this->repository->create([
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->contents,
                'answer' => json_encode($request->answer),
                'order_by' => $request->order_by,
                'question_child'=>json_encode($request->question_child)
            ]);
            if($question['data']['category']->view == 'filling_in_the_blank'){
                $str = $question['data']['content'];
                $input = '<input type="text" class="question-x2t-'.$question['data']['id'].'" name="filling-in-the-blank['.$question['data']['id'].'][]">';
                $this->repository->update([
                    'content' => str_replace('(____)', $input, $str),
                ], $question['data']['id']);
            }

            $response = [
                'message' => 'Question created.',
                'data'    => $question,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->repository->find($id);
        $view = $question['data']['category']->view;
        return view('admin.pages.questions.show._show_'.$view, compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->repository->find($id);
        $view = $question['data']['category']->view;
        $unit = $this->unitRepository->all();
        return view('admin.pages.questions.edit._show_'.$view, compact('question','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(QuestionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $question = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Question updated.',
                'data'    => $question->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Question deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Question deleted.');
    }
}
