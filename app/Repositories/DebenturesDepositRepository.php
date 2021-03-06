<?php

namespace App\Repositories;

use App\DebenturesDeposit;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class DebenturesDepositRepository
{
    private $debentures_deposit;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(DebenturesDeposit $debentures_deposit)
    {
        $this->data = $debentures_deposit->with('user', 'user.profile', 'customer', 'branch');
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

        $sort_by     = isset($params['sort_by']) ? $params['sort_by'] : 'created_at';
        $order      = isset($params['order']) ? $params['order'] : 'desc';
        $page_length = isset($params['page_length']) ? $params['page_length'] : config('config.page_length');
        $keyword     = isset($params['keyword']) ? $params['keyword'] : null;
        $status     = isset($params['status']) ? $params['status'] : 0;
        $start_date = isset($params['start_date']) ? $params['start_date'] : null;
        $end_date   = isset($params['end_date']) ? $params['end_date'] : null;
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
            'user_id'       => isset($params['user_id']) ? $params['user_id'] : auth()->user()->id,
            'branch_id'       => isset($params['branch_id']) ? $params['branch_id'] : null,
            'customer_id'       => isset($params['customer_id']) ? $params['customer_id'] : null,
            'note'       => isset($params['note']) ? $params['note'] : null,
            'amount' => (isset($params['amount']) && $params['amount']) ? $params['amount'] : null,
            'date_at' => (isset($params['date_at']) && $params['date_at']) ? $params['date_at'] : null,
        ];

        // branch_id
        // user_id
        // customer_id
        // note
        // img
        // type
        // amount
        // date_at
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
    public function update(DebenturesDeposit $debentures_deposit, $params)
    {
        $debentures_deposit->forceFill($this->formatParams($params, 'update'))->save();
        return $debentures_deposit;
    }

    /**
     * Delete Branch.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(DebenturesDeposit $debentures_deposit)
    {
        return $debentures_deposit->delete();
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
