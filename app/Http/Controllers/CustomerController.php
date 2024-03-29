<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $module = 'customer';

    private $request;
    private $repo;
    protected $activity;
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, CustomerRepository $repo, UserRepository $user, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        
    }

    /**
     * Used to get Pre Requisite for branch Module
     * @get ("/api/branch/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $user = generateSelectOption($this->user->listByName());
        // $newCollection = collect($this->repo->listType())->pluck('id', 'name');
        $type = generateSelectOption(collect($this->repo->listType())->pluck('name', 'id'));

        return $this->success(compact('user', 'type'));
    }

    /**
     * Used to get Pre Requisite for branch Module
     * @get ("/api/branch/pre-requisite")
     * @return Response
     */
    public function getCustomerAccount($customer_id, $amount = 0)
    {
        // if ($not_id != 0){
        //     $not_id = $not_id;
        // }
        $customerAccount = $this->repo->getCustomerAccount($customer_id, $amount);
        return $this->success(compact('customerAccount'));
    }

    /**
     * Used to get all Branch
     * @get ("/api/branch")
     * @return Response
     */
    public function getStatement()
    {
        // dd($this->repo->paginate($this->request->all());
        return $this->ok($this->repo->getStatement());
    }

    /**
     * Used to get all Branch
     * @get ("/api/branch")
     * @return Response
     */
    public function getStatementByCustomer($id , Request $request)
    {
        // dd($this->repo->paginate($this->request->all());
        return $this->ok($this->repo->getStatementByCustomer($id , $request));
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
    public function store(CustomerRequest $request)
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
    public function update($id, CustomerRequest $request)
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
