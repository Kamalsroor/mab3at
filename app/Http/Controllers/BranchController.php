<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\BranchRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\BranchRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    protected $module = 'branch';

    private $request;
    private $repo;
    protected $activity;
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, BranchRepository $repo, UserRepository $user, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->middleware('permission:access-branch');

    }

    /**
     * Used to get Pre Requisite for branch Module
     * @get ("/api/branch/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $user = generateSelectOption($this->user->listByName());

        return $this->ok($user);
    }

    /**
     * Used to get all Branch
     * @get ("/api/branch")
     * @return Response
     */
    public function index()
    {
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
    public function store(BranchRequest $request)
    {
        try {
            $branch = $this->repo->create($this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $branch->id,
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
     * Used to get Branch detail
     * @get ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $branch = $this->repo->findOrFail($id);
        if ($branch->deleted_at) {
            return $this->error(['message' => "خطاء , لا يمكن تعديل هذا السجل لانه محذوف"  ]);
        }
        return $this->ok($branch);
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
    public function update($id, BranchRequest $request)
    {
        try {

            $branch = $this->repo->findOrFail($id);
            $branch = $this->repo->update($branch, $this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $branch->id,
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
     * Used to delete Branch
     * @delete ("/api/branch/{id}")
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

            $branch = $this->repo->findOrFail($id);
            $deleted_at = false;
            if ($branch->deleted_at) {
                $deleted_at = true;
                $this->repo->restore($branch);
            }else{
                $this->repo->delete($branch);
            }


            $this->activity->record([
                'module' => $this->module,
                'module_id' => $branch->id,
                'activity' =>  $deleted_at ? 'restored' : 'deleted',
            ]);
      
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e ]);
        }
        if ($deleted_at) {
            return $this->success(['message' => trans('app.restore')]);
        }
        return $this->success(['message' => trans('app.deleted')]);
    }
}
