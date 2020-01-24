<?php

namespace App\Repositories;

use App\Product;
use App\PurchasesBill;
use App\SalesBill;
use Illuminate\Validation\ValidationException;

class ProductRepository
{
    private $product;
    protected $PurchasesBill;
    protected $SalesBill;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Product $product, PurchasesBill $PurchasesBill, SalesBill $SalesBill)
    {
// rwar
        $this->data = $product->with('Category', 'Group');
        $this->PurchasesBill = $PurchasesBill;
        $this->SalesBill = $SalesBill;
    }

    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->data;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return data
     */

    public function getProduct($id)
    {
        $data = $this->data->find($id);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }

        return $data;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return data
     */

    public function getProductBySrail($srial)
    {
        $data = $this->data->find($id);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }

        return $data;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return data
     */

    public function CheckSrirals($srials)
    {

        $customerStatement = collect();
        $i = 0;
        $NotFound = $customerStatement->pull('NotFound');
        $NotFound = [];
        $FoundFalse = $customerStatement->pull('FoundFalse');
        $FoundFalse = [];
        $FoundTrue = $customerStatement->pull('FoundTrue');
        $FoundTrue = [];
        foreach ($srials as $srial) {

            $PurchasesBill = $this->PurchasesBill->whereHas('PurchasesBillDetails', function ($q) use ($srial) {
                $q->whereHas('PurchasesBillDetailSrials', function ($q) use ($srial) {
                    $q->where('srialnumper', $srial);
                });
            })->get();
            if (count($PurchasesBill) > 0) {
                $SalesBill = $this->SalesBill->whereHas('SalesBillDetails', function ($q) use ($srial) {
                    $q->whereHas('SalesBillDetailSrials', function ($q) use ($srial) {
                        $q->where('srialnumper', $srial);
                    });
                })->get();
                if (count($SalesBill) > 0) {
                    $FoundFalse = [
                        'status' => "FoundFalse",
                        'srial' => $srial,
                    ];
                    $customerStatement->push($FoundFalse);

                } else {

                    $FoundTrue = [
                        'status' => "FoundTrue",

                        'srial' => $srial,
                    ];
                    $customerStatement->push($FoundTrue);
                }
            } else {
                $NotFound = [
                    'status' => "NotFound",
                    'srial' => $srial,
                ];
                $customerStatement->push($NotFound);
            }
            // $customerStatement->put($i, $items);
            // $i++;
        }
        return $customerStatement;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return data
     */

    public function findOrFail($id)
    {
        $data = $this->data->find($id);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }

        return $data;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function find($id)
    {
        $data = $this->data->find($id);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $data;
    }

    /**
     * Paginate all todos using given params.
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function paginate($params)
    {

        $sort_by = isset($params['sort_by']) ? $params['sort_by'] : 'created_at';
        $order = isset($params['order']) ? $params['order'] : 'desc';
        $page_length = isset($params['page_length']) ? $params['page_length'] : config('config.page_length');
        $keyword = isset($params['keyword']) ? $params['keyword'] : null;
        $status = isset($params['status']) ? $params['status'] : 0;
        $start_date = isset($params['start_date']) ? $params['start_date'] : null;
        $end_date = isset($params['end_date']) ? $params['end_date'] : null;
        $query = $this->data;
        return $query->orderBy($sort_by, $order)->paginate($page_length);
    }

    /**
     * Create a new todo.
     *
     * @param array $params
     * @return Todo
     */
    public function create($params)
    {
        return $this->data->forceCreate($this->formatParams($params));
    }

    /**
     * List user except authenticated user by name & email
     *
     * @param string $token
     * @return User
     */

    public function listByNameAndParcode()
    {
        return $this->data->get()->pluck('name_with_parcode', 'id')->all();
    }

    /**
     * List user by name only
     *
     * @param string $token
     * @return User
     */

    public function listType()
    {
        $type = [
            ['id' => 'client', 'name' => 'عميل'],
            ['id' => 'seller', 'name' => 'تاجر'],
        ];
        return $type;
    }

    /**
     * Prepare given params for inserting into database.
     *
     * @param array $params
     * @param string $type
     * @return array
     */
    private function formatParams($params, $action = 'create')
    {
        $formatted = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'min_price' => isset($params['min_price']) ? $params['min_price'] : null,
            'max_price' => (isset($params['max_price']) && $params['max_price']) ? $params['max_price'] : null,
            'parcode' => (isset($params['parcode']) && $params['parcode']) ? $params['parcode'] : null,
            'status' => (isset($params['status']) && $params['status']) ? $params['status'] : null,
        ];
        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }
        return $formatted;
    }

    /**
     * Update given Branch.
     *
     * @param Branch $branch
     * @param array $params
     *
     * @return branch
     */
    public function update(Product $product, $params)
    {
        $product->forceFill($this->formatParams($params, 'update'))->save();
        return $product;
    }

    /**
     * Delete Branch.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Product $product)
    {
        return $product->delete();
    }

    /**
     * Delete multiple branches.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->data->whereIn('id', $ids)->delete();
    }
}
