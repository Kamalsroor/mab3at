<?php

namespace App\Repositories;

use App\Customer;
use Illuminate\Validation\ValidationException;

class CustomerRepository
{
    private $customer;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->data = $customer->with('user', 'user.profile', 'SalesBill.branch', 'SalesBill.user.profile', 'SalesBill.SalesBillDetails.Product', 'SalesBill.SalesBillDetails.SalesBillDetailSrials', 'AccountAdjustment', 'AccountAdjustment.user.profile', 'PurchasesBill.PurchasesBillDetails.PurchasesBillDetailSrials', 'PurchasesBill.PurchasesBillDetails.Product', 'PurchasesBill.branch', 'PurchasesBill.user.profile', 'DebentureCashings.user.profile', 'DebentureCashings.branch', 'DebentureDeposits.user.profile', 'DebentureDeposits.branch');
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
        $newCollection = collect($this->listType())->where('id', $data->type)->first();
        $data->typeName = $newCollection['name'];
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
     * List user by name only
     *
     * @param string $token
     * @return User
     */

    public function listType()
    {
        $type = [
            ['id' => 'cargo', 'name' => 'شحن'],
            ['id' => 'trade', 'name' => 'تجارة'],
            ['id' => 'cargo&trade', 'name' => 'شحن & تحارة'],
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
            'address' => isset($params['address']) ? $params['address'] : null,
            'phone' => isset($params['phone']) ? $params['phone'] : null,
            'telephone' => isset($params['telephone']) ? $params['telephone'] : null,
            'user_id' => (isset($params['user_id']) && $params['user_id']) ? $params['user_id'] : null,
            'type' => (isset($params['type']) && $params['type']) ? $params['type'] : null,
            'email' => (isset($params['email']) && $params['email']) ? $params['email'] : null,
        ];
        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }
        return $formatted;
    }

    /**
     * List Customer by name only
     *
     * @param string $token
     * @return Customer
     */

    public function listByName()
    {
        return $this->data->get()->pluck('name', 'id')->all();
    }

    /**
     * List CustomerAccount
     *
     * @param string $token
     * @return CustomerAccount
     */

    public function getCustomerAccount($id, $amount = 0)
    {
        $data = $this->data->find($id);
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        $PurchasesBillAmount = 0;
        foreach ($data->PurchasesBill as $PurchasesBill) {
            foreach ($PurchasesBill->PurchasesBillDetails as $PurchasesBillDetails) {
                $PurchasesBillAmount += count($PurchasesBillDetails->PurchasesBillDetailSrials) * $PurchasesBillDetails->amount;
            }
        }

        $SalesBillAmount = 0;
        foreach ($data->SalesBill as $SalesBill) {
            foreach ($SalesBill->SalesBillDetails as $SalesBillDetails) {
                $SalesBillAmount += count($SalesBillDetails->SalesBillDetailSrials) * $SalesBillDetails->amount;
            }
        }
        return $PurchasesBillAmount + $data->DebentureDeposits->sum('amount') - $data->DebentureCashings->sum('amount') - $SalesBillAmount - $amount - $data->AccountAdjustment->sum('amount');
    }

    public function getStatement()
    {
        $datas = $this->data->get();

        // $ProductStock = new stdClass;
        $customerStatement = collect();
        $i = 0;

        foreach ($datas as $data) {
            $items = $customerStatement->pull('items');
            $PurchasesBillAmount = 0;
            foreach ($data->PurchasesBill as $PurchasesBill) {
                foreach ($PurchasesBill->PurchasesBillDetails as $PurchasesBillDetails) {
                    $PurchasesBillAmount += count($PurchasesBillDetails->PurchasesBillDetailSrials) * $PurchasesBillDetails->amount;
                }
            }

            $SalesBillAmount = 0;
            foreach ($data->SalesBill as $SalesBill) {
                foreach ($SalesBill->SalesBillDetails as $SalesBillDetails) {
                    $SalesBillAmount += count($SalesBillDetails->SalesBillDetailSrials) * $SalesBillDetails->amount;
                }
            }
            if ($data->name == "كتكوت") {

                // dd($SalesBillAmount, $data->DebentureCashings->sum('amount') , $data->AccountAdjustment->sum('amount'));
            }
            $items = [
                'id' => $data->id,
                'name' => $data->name,
                'creditor' => $PurchasesBillAmount + $data->DebentureDeposits->sum('amount'),
                'debtor' => $data->DebentureCashings->sum('amount') + $SalesBillAmount + $data->AccountAdjustment->sum('amount'),
            ];
            $customerStatement->put($i, $items);
            $i++;
        }
        return $customerStatement;
    }

/**
 * List CustomerAccount
 *
 * @param string $token
 * @return CustomerAccount
 */

    public function getStatementByCustomer($id, $request)
    {
        $data = $this->data->find($id);
        // $result = ModelName::->get();
        if (!$data) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        $customerStatement = collect();

        $items = $customerStatement->pull('items');
        if ($request->from != 'Invalid date') {
            $DebentureCashings = collect();

            foreach ($data->DebentureCashings->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) as $value) {
                $value->type = 'DebentureCashings';
                $DebentureCashings->push($value);
            }

            $DebentureDeposits = collect();
            foreach ($data->DebentureDeposits->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) as $value) {
                $value->type = 'DebentureDeposits';
                $DebentureDeposits->push($value);

            }

            $PurchasesBill = collect();
            foreach ($data->PurchasesBill->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) as $value) {
                $value->type = 'PurchasesBill';
                $PurchasesBill->push($value);

            }

            $SalesBill = collect();
            foreach ($data->SalesBill->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) as $value) {
                $value->type = 'SalesBill';
                $SalesBill->push($value);

            }

            $AccountAdjustment = collect();
            foreach ($data->AccountAdjustment->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) as $value) {
                $value->type = 'AccountAdjustment';
                $AccountAdjustment->push($value);
            }
        } else {
            $DebentureCashings = collect();

            foreach ($data->DebentureCashings as $value) {
                $value->type = 'DebentureCashings';
                $DebentureCashings->push($value);
            }

            $DebentureDeposits = collect();
            foreach ($data->DebentureDeposits as $value) {
                $value->type = 'DebentureDeposits';
                $DebentureDeposits->push($value);

            }

            $PurchasesBill = collect();
            foreach ($data->PurchasesBill as $value) {
                $value->type = 'PurchasesBill';
                $PurchasesBill->push($value);

            }

            $SalesBill = collect();
            foreach ($data->SalesBill as $value) {
                $value->type = 'SalesBill';
                $SalesBill->push($value);

            }

            $AccountAdjustment = collect();
            foreach ($data->AccountAdjustment as $value) {
                $value->type = 'AccountAdjustment';
                $AccountAdjustment->push($value);
            }
        }
        $items = [
            'name' => $data->name,
            'DebentureCashings' => $DebentureCashings,
            'DebentureDeposits' => $DebentureDeposits,
            'PurchasesBill' => $PurchasesBill,
            'SalesBill' => $SalesBill,
            'AccountAdjustment' => $AccountAdjustment,
        ];
        $customerStatement->push($items);
        return $customerStatement;
    }

    /**
     * Update given Branch.
     *
     * @param Branch $branch
     * @param array $params
     *
     * @return branch
     */
    public function update(Customer $customer, $params)
    {
        $customer->forceFill($this->formatParams($params, 'update'))->save();
        return $customer;
    }

    /**
     * Delete Branch.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Customer $customer)
    {
        return $customer->delete();
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
