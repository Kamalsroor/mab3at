<?php

namespace App\Http\Controllers;

use App\Customer;
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
        $this->middleware('permission:access-customer');

    }

    /**
     * Used to get Pre Requisite for customer Module
     * @get ("/api/customer/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $type = generateSelectOption(collect($this->repo->listType())->pluck('name', 'id'));
        return $this->success(compact( 'type'));
        // return $this->ok($user);
    }

    /**
     * Used to get all Customer
     * @get ("/api/customer")
     * @return Response
     */
    public function index()
    {
        return $this->ok($this->repo->paginate($this->request->all()));
    }


    /**
     * Used to store customer
     * @post ("/api/customer")
     * @param ({
     *      @Parameter("name", type="string", required="true", description="Name of customer"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            $customer = $this->repo->create($this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $customer->id,
                'activity' => 'added',
            ]);
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e ]);
        }

        return $this->success(['message' => trans('app.added')]);
    }

    /**
     * Used to get Customer detail
     * @get ("/api/customer/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->repo->findOrFail($id);
        // dd( , $customer->type);
        $customer->type_name = collect($this->repo->listType())->pluck('name', 'id')->toArray()[$customer->type];
        return $this->ok($customer);
    }

    /**
     * Used to update Customer
     * @patch ("/api/customer/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     *      @Parameter("title", type="string", required="true", description="Title of Todo"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function update($id, CustomerRequest $request)
    {
        try {

            $customer = $this->repo->findOrFail($id);
            $customer = $this->repo->update($customer, $this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $customer->id,
                'activity' => 'updated',
            ]);
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e ]);
        }


        return $this->success(['message' => trans('app.updated')]);
    }

    /**
     * Used to delete Customer
     * @delete ("/api/customer/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function destroy($id , Request $request)
    {
        try {
            $cheackPassword = checkPassword($request->password);
            if(is_object($cheackPassword)){
                return $cheackPassword ;
            }
            $customer = $this->repo->findOrFail($id);

            $this->activity->record([
                'module' => $this->module,
                'module_id' => $customer->id,
                'activity' => 'deleted',
            ]);
            $this->repo->delete($customer);
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e ]);
        }

        return $this->success(['message' => trans('app.deleted')]);
    }
}
