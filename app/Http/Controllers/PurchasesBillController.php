<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchasesBillRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\BranchRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PurchasesBillRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class PurchasesBillController extends Controller
{
    protected $module = 'purchases_bill';

    private $request;
    private $repo;
    protected $activity;
    protected $user;
    protected $branch;
    protected $product;
    protected $customer;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, ProductRepository $product, PurchasesBillRepository $repo, UserRepository $user, BranchRepository $branch, CustomerRepository $customer, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->branch = $branch;
        $this->customer = $customer;
        $this->product = $product;

        // 
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
        $product = generateSelectOption($this->product->listByNameAndParcode());
        return $this->success(compact('user', 'branch', 'customer', 'product'));
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return data
     */

    public function getProductBySrialnumper($serialnumper)
    {
        $data = $this->data->where($serialnumper);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $data;
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
    public function store(PurchasesBillRequest $request)
    {

        $data = $this->repo->create($this->request->all());
        $this->activity->record([
            'module' => $this->module,
            'module_id' => $data->id,
            'activity' => 'added',
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
    public function update($id, PurchasesBillRequest $request)
    {

        $data = $this->repo->find($id);
        $data = $this->repo->update($data, $this->request->all());

        $this->activity->record([
            'module' => $this->module,
            'module_id' => $data->id,
            'activity' => 'updated',
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
            'module' => $this->module,
            'module_id' => $data->id,
            'activity' => 'deleted',
        ]);

        $this->repo->delete($data);

        return $this->success(['message' => trans('todo.deleted')]);
    }
}
