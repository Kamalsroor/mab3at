<?php

namespace App\Http\Controllers;

use App\AccountAdjustment;
use Illuminate\Http\Request;
use App\Http\Requests\AccountAdjustmentRequest;
use App\Repositories\UserRepository;
use App\Repositories\AccountAdjustmentRepository;
use App\Repositories\BranchRepository;
use App\Repositories\CustomerRepository;



use App\Repositories\ActivityLogRepository;

class AccountAdjustmentController extends Controller
{
    protected $module = 'account_adjustment';

    private $request;
    private $repo;
    protected $activity;
    protected $user;
    protected $branch;
    protected $customer;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, AccountAdjustmentRepository $repo, UserRepository $user, BranchRepository $branch, CustomerRepository $customer, ActivityLogRepository $activity)
    {
        $this->request  = $request;
        $this->repo     = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->branch = $branch;
        $this->customer = $customer;
        $this->middleware('feature.available:todo');
    }


    /**
     * Used to get Pre Requisite for branch Module
     * @get ("/api/branch/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $user = generateSelectOption($this->user->listByName());
        $branch = generateSelectOption($this->branch->listWhereUserIdByName());
        $customer = generateSelectOption($this->customer->listByName());
        return $this->success(compact('user', 'branch', 'customer'));
    }




    /**
     * Used to get all Branch
     * @get ("/api/branch")
     * @return Response
     */
    public function index()
    {
        // dd($this->repo->paginate($this->request->all());

        return $this->ok($this->repo->paginate($this->request->all()));
    }

    /**
     * Used to store branch
     * @post ("/api/branch")
     * @param ({
     *      @Parameter("name", type="string", required="true", description="Name of branch"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function store(AccountAdjustmentRequest $request)
    {

        $data = $this->repo->create($this->request->all());

        $this->activity->record([
            'module'   => $this->module,
            'module_id' => $data->id,
            'activity' => 'added'
        ]);

        return $this->success(['message' => trans('todo.added')]);
    }

    /**
     * Used to get Branch detail
     * @get ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $data = $this->repo->findOrFail($id);
        // dd($data);

        return $this->ok($data);
    }


    /**
     * Used to update Branch
     * @patch ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     *      @Parameter("title", type="string", required="true", description="Title of Todo"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function update($id, AccountAdjustmentRequest $request)
    {

        $data = $this->repo->find($id);
        $data = $this->repo->update($data, $this->request->all());

        $this->activity->record([
            'module'   => $this->module,
            'module_id' => $data->id,
            'activity' => 'updated'
        ]);
        return $this->success(['message' => trans('todo.updated')]);
    }

    /**
     * Used to delete Branch
     * @delete ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->repo->findOrFail($id);


        $this->activity->record([
            'module'   => $this->module,
            'module_id' => $data->id,
            'activity' => 'deleted'
        ]);

        $this->repo->delete($data);

        return $this->success(['message' => trans('todo.deleted')]);
    }
}
