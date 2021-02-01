<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $module = 'category';

    private $request;
    private $repo;
    protected $activity;
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, CategoryRepository $repo, UserRepository $user, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->middleware('permission:access-category');

    }

    /**
     * Used to get Pre Requisite for category Module
     * @get ("/api/category/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        return $this->success();
        // return $this->ok($user);
    }

    /**
     * Used to get all Category
     * @get ("/api/category")
     * @return Response
     */
    public function index()
    {
        return $this->ok($this->repo->paginate($this->request->all()));
    }


    /**
     * Used to store category
     * @post ("/api/category")
     * @param ({
     *      @Parameter("name", type="string", required="true", description="Name of category"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->repo->create($this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $category->id,
                'activity' => 'added',
            ]);
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e  ]);
        }
        return $this->success(['message' => trans('app.added')]);
    }

    /**
     * Used to get Category detail
     * @get ("/api/category/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $category = $this->repo->findOrFail($id);
        return $this->ok($category);
    }

    /**
     * Used to update Category
     * @patch ("/api/category/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     *      @Parameter("title", type="string", required="true", description="Title of Todo"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function update($id, CategoryRequest $request)
    {
        try {

            $category = $this->repo->findOrFail($id);
            $category = $this->repo->update($category, $this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $category->id,
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
     * Used to delete Category
     * @delete ("/api/category/{id}")
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
            $category = $this->repo->findOrFail($id);

            $this->activity->record([
                'module' => $this->module,
                'module_id' => $category->id,
                'activity' => 'deleted',
            ]);
            $this->repo->delete($category);
        } catch (\Exception $e) {
            $this->activity->record([
                'module' => $this->module,
                'massage' => $e->getMessage(),
                'activity' => 'error',
            ]);
            return $this->error(['message' => "خطاء , اعد تحميل الصفحه" ,'Exception' => $e  ]);
        }

        return $this->success(['message' => trans('app.deleted')]);
    }
}
