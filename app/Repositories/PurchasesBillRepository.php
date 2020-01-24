<?php

namespace App\Repositories;

use App\PurchasesBill;
use App\PurchasesBillDetails;
use App\PurchasesBillDetailSrials;
use Illuminate\Validation\ValidationException;

class PurchasesBillRepository
{
    private $purchases_bill;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(PurchasesBill $purchases_bill)
    {
        $this->data = $purchases_bill->with('user', 'user.profile', 'customer', 'branch', 'PurchasesBillDetails', 'PurchasesBillDetails.PurchasesBillDetailSrials');
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
        dd($data);
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
        $data = $this->data->forceCreate($this->formatParams($params));
        for ($i = 0; $i < count($params['products']); $i++) {
            $datadetail = new PurchasesBillDetails();
            $datadetail->product_id = $params['products'][$i]['id'];
            $datadetail->amount = $params['products'][$i]['price'];
            $datadetail->user_id = auth()->user()->id;
            $datadetail = $data->PurchasesBillDetails()->save($datadetail);
            // will save the image for the post.
            for ($k = 0; $k < count($params['products'][$i]['serial']); $k++) {
                $PurchasesBillDetailSrials = new PurchasesBillDetailSrials();
                $PurchasesBillDetailSrials->srialnumper = $params['products'][$i]['serial'][$k];
                $PurchasesBillDetailSrials->user_id = auth()->user()->id;
                $datadetail->PurchasesBillDetailSrials()->save($PurchasesBillDetailSrials); // will save the image for the post.
            }
        }
        return $data;
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
            'user_id' => isset($params['user_id']) ? $params['user_id'] : auth()->user()->id,
            'branch_id' => isset($params['branch_id']) ? $params['branch_id'] : null,
            'customer_id' => isset($params['customer_id']) ? $params['customer_id'] : null,
            'note' => isset($params['note']) ? $params['note'] : null,
            'img' => (isset($params['img']) && $params['img']) ? $params['img'] : null,
            'date_at' => (isset($params['date_at']) && $params['date_at']) ? $params['date_at'] : null,
            'amount' => null,
        ];
        $formatted['amount'] = 0;
        for ($i = 0; $i < count($params['products']); $i++) {
            $formatted['amount'] += $params['products'][$i]['price'] * count($params['products'][$i]['serial']);
        }

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
    public function update(PurchasesBill $purchases_bill, $params)
    {
        $purchases_bill->forceFill($this->formatParams($params, 'update'))->save();
        return $purchases_bill;
    }

    /**
     * Delete Branch.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(PurchasesBill $purchases_bill)
    {
        return $purchases_bill->delete();
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
