<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $module = 'group';

    private $request;
    private $repo;
    protected $activity;
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, GroupRepository $repo, UserRepository $user, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->middleware('permission:access-group');

    }

    /**
     * Used to get Pre Requisite for group Module
     * @get ("/api/group/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        return $this->success();
        // return $this->ok($user);
    }

    /**
     * Used to get all Group
     * @get ("/api/group")
     * @return Response
     */
    public function index()
    {
        return $this->ok($this->repo->paginate($this->request->all()));
    }


    /**
     * Used to store group
     * @post ("/api/group")
     * @param ({
     *      @Parameter("name", type="string", required="true", description="Name of group"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function store(GroupRequest $request)
    {
        try {
            $group = $this->repo->create($this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $group->id,
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
     * Used to get Group detail
     * @get ("/api/group/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $group = $this->repo->findOrFail($id);
        return $this->ok($group);
    }

    /**
     * Used to update Group
     * @patch ("/api/group/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     *      @Parameter("title", type="string", required="true", description="Title of Todo"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function update($id, GroupRequest $request)
    {
        try {

            $group = $this->repo->findOrFail($id);
            $group = $this->repo->update($group, $this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $group->id,
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
     * Used to delete Group
     * @delete ("/api/group/{id}")
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
            $group = $this->repo->findOrFail($id);

            $this->activity->record([
                'module' => $this->module,
                'module_id' => $group->id,
                'activity' => 'deleted',
            ]);
            $this->repo->delete($group);
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
