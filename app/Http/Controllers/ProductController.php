<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\ActivityLogRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\GroupRepository;
class ProductController extends Controller
{
    protected $module = 'product';

    private $request;
    private $repo;
    protected $activity;
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, ProductRepository $repo, UserRepository $user, ActivityLogRepository $activity ,CategoryRepository $category ,GroupRepository $group)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->user = $user;
        $this->category = $category;
        $this->group = $group;

        $this->middleware('permission:access-product');

    }

    /**
     * Used to get Pre Requisite for product Module
     * @get ("/api/product/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $category = generateSelectOption($this->category->listByName());
        
        $group = generateSelectOption($this->group->listByName());

        return $this->success(compact('category' ,'group'));
        // return $this->ok($user);
    }



    /**
     * Used to get all Product
     * @get ("/api/product")
     * @return Response
     */
    public function index()
    {
        return $this->ok($this->repo->paginate($this->request->all()));
    }


    /**
     * Used to store product
     * @post ("/api/product")
     * @param ({
     *      @Parameter("name", type="string", required="true", description="Name of product"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->repo->create($this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $product->id,
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
     * Used to get Product detail
     * @get ("/api/product/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function show($id)
    {
        $product = $this->repo->findOrFail($id);
        // dd( , $product->type);
        return $this->ok($product);
    }

    /**
     * Used to update Product
     * @patch ("/api/product/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     *      @Parameter("title", type="string", required="true", description="Title of Todo"),
     *      @Parameter("date", type="date", required="true", description="Due date of Todo"),
     * })
     * @return Response
     */
    public function update($id, ProductRequest $request)
    {
        try {

            $product = $this->repo->findOrFail($id);
            $product = $this->repo->update($product, $this->request->all());
            $this->activity->record([
                'module' => $this->module,
                'module_id' => $product->id,
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
     * Used to delete Product
     * @delete ("/api/product/{id}")
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
            $product = $this->repo->findOrFail($id);

            $this->activity->record([
                'module' => $this->module,
                'module_id' => $product->id,
                'activity' => 'deleted',
            ]);
            $this->repo->delete($product);
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
