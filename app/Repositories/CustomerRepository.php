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
        $this->customer = $customer;

    }



    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->customer;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function findOrFail($id)
    {
        $customer = $this->customer->find($id);
        if (!$customer) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $customer;
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
        $name = isset($params['name']) ? $params['name'] : null;
        $address = isset($params['address']) ? $params['address'] : null;
        $status = isset($params['status']) ? $params['status'] : 0;
        $start_date = isset($params['start_date']) ? $params['start_date'] : null;


        $end_date = isset($params['end_date']) ? $params['end_date'] : null;
        $query = $this->customer->createdAtDateBetween([
            'start_date' => $start_date,
            'end_date' => $end_date
        ])->filterByName($name)->filterByAddress($address);
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
        return $this->customer->forceCreate($this->formatParams($params));
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
            'type' => (isset($params['type']) && $params['type']) ? $params['type'] : null,
            'email' => (isset($params['email']) && $params['email']) ? $params['email'] : null,

        ];
        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }

        return $formatted;
    }

    /**
     * Update given Customer.
     *
     * @param Customer $customer
     * @param array $params
     *
     * @return customer
     */
    public function update(Customer $customer, $params)
    {
        $customer->forceFill($this->formatParams($params, 'update'))->save();

        return $customer;
    }

    /**
     * Delete Customer.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Customer $customer)
    {
        return $customer->delete();
    }

    /**
     * List customer by name only
     *
     * @param string $token
     * @return customer
     */

    public function listByName()
    {
        return $this->customer->get()->pluck('name', 'id')->all();
    }

    /**
     * List customer by name only
     *
     * @param string $token
     * @return customer
     */

    public function listWhereUserIdByName()
    {
        return $this->customer->where('user_id', Auth()->user()->id)->get()->pluck('name', 'id')->all();
    }

    /**
     * Delete multiple customeres.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->customer->whereIn('id', $ids)->delete();
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

}
