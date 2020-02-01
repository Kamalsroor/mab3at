<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\PurchasesBill;
use App\Repositories\ActivityLogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GroupRepository;
use App\Repositories\ProductRepository;
use App\SalesBill;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $module = 'product';

    private $request;
    private $repo;
    protected $activity;
    protected $group;
    protected $PurchasesBill;
    protected $SalesBill;
    protected $category;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, ProductRepository $repo, PurchasesBill $PurchasesBill, SalesBill $SalesBill, CategoryRepository $category, GroupRepository $group, ActivityLogRepository $activity)
    {
        $this->request = $request;
        $this->repo = $repo;
        $this->activity = $activity;
        $this->category = $category;
        $this->PurchasesBill = $PurchasesBill;
        $this->SalesBill = $SalesBill;

        $this->group = $group;
    }

    /**
     * Used to get Pre Requisite for branch Module
     * @get ("/api/branch/pre-requisite")
     * @return Response
     */
    public function preRequisite()
    {
        $category = generateSelectOption($this->category->listByName());
        $group = generateSelectOption($this->group->listByName());
        // $newCollection = collect($this->repo->listType())->pluck('id', 'name');

        return $this->success(compact('category', 'group'));
    }

    /**
     * Used to get Branch detail
     * @get ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function getProductWithPrice($id, $price)
    {
        $data = $this->repo->getProduct($id);
        if ($data->min_price > $price) {
            return $this->error(['message' => ' اقل سعر هو ' . $data->min_price]);
            // return $this->error($error);
        } else if ($data->max_price < $price) {
            return $this->error(['message' => ' اعلي سعر هو ' . $data->max_price]);
        }
        return $this->ok($data);
    }

    /**
     * Used to get Branch detail
     * @get ("/api/branch/{id}")
     * @param ({
     *      @Parameter("id", type="integer", required="true", description="Id of Todo"),
     * })
     * @return Response
     */
    public function checkSriral($srailnumper, $type)
    {
        // dd($this->PurchasesBill->with('PurchasesBillDetails')->get());
        $PurchasesBill = $this->PurchasesBill->whereHas('PurchasesBillDetails', function ($q) use ($srailnumper) {
            $q->whereHas('PurchasesBillDetailSrials', function ($q) use ($srailnumper) {
                $q->where('srialnumper', $srailnumper);
            });
        })->get();
        if (count($PurchasesBill) > 0) {
     
            if ($type == "PurchasesBill") {
                return $this->error(['message' => 'تم شراء هذا الجهاز من قبل']);
            }
        }
        if ($type == "SalesBill") {
            if (count($PurchasesBill) == 0) {
                return $this->error(['message' => 'لا يوجد ف الخزينه هذا الجهاز']);
            } else {
                $SalesBill = $this->SalesBill->whereHas('SalesBillDetails', function ($q) use ($srailnumper) {
                    $q->whereHas('SalesBillDetailSrials', function ($q) use ($srailnumper) {
                        $q->where('srialnumper', $srailnumper);
                    });
                })->get();
                if (count($SalesBill) > 0) {
                    return $this->error(['message' => 'تم بيع هذا الجهاز من قبل']);
                }
            }

        }

  

        return $this->ok($PurchasesBill);
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
        $data = $this->repo->getProduct($id);
        if ($data->min_price > $price) {
            return $this->error(['message' => ' اقل سعر هو ' . $data->min_price]);
            // return $this->error($error);
        } else if ($data->max_price < $price) {
            return $this->error(['message' => ' اعلي سعر هو ' . $data->max_price]);
        }
        return $this->success('');
    }

    /**
     *
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
    public function CheckSrirals(Request $request)
    {

        $data = $this->repo->CheckSrirals($this->request->serials);


        return $this->ok($data);
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
    public function store(ProductRequest $request)
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
    public function update($id, ProductRequest $request)
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
     * @var App\Repositories\data $data
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
