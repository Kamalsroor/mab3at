<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Validation\ValidationException;

class ProductRepository
{
    private $product;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product->with('Category', 'Group');

    }



    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->product;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function findOrFail($id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $product;
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
        $query = $this->product->createdAtDateBetween([
            'start_date' => $start_date,
            'end_date' => $end_date
        ])->filterByName($name);
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
        return $this->product->forceCreate($this->formatParams($params));
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
            'parcode' => isset($params['parcode']) ? $params['parcode'] : null,
            'category_id' => (isset($params['category_id']) && $params['category_id']) ? $params['category_id'] : null,
            'group_id' => (isset($params['group_id']) && $params['group_id']) ? $params['group_id'] : null,
            'min_price' => isset($params['min_price']) ? $params['min_price'] : 0,
            'max_price' => isset($params['max_price']) ? $params['max_price'] : 0,
            'status' => isset($params['status']) && $params['status'] != ""  ? $params['status'] : 0,

        ];

        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }

        return $formatted;
    }

    /**
     * Update given Product.
     *
     * @param Product $product
     * @param array $params
     *
     * @return product
     */
    public function update(Product $product, $params)
    {
        $product->forceFill($this->formatParams($params, 'update'))->save();

        return $product;
    }

    /**
     * Delete Product.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Product $product)
    {
        return $product->delete();
    }

    /**
     * List product by name only
     *
     * @param string $token
     * @return product
     */

    public function listByName()
    {
        return $this->product->get()->pluck('name', 'id')->all();
    }

    /**
     * List product by name only
     *
     * @param string $token
     * @return product
     */

    public function listWhereUserIdByName()
    {
        return $this->product->where('user_id', Auth()->user()->id)->get()->pluck('name', 'id')->all();
    }

    /**
     * Delete multiple productes.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->product->whereIn('id', $ids)->delete();
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
