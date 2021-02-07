<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Validation\ValidationException;

class CategoryRepository
{
    private $category;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;

    }



    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->category;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function findOrFail($id)
    {
        $category = $this->category->withTrashed()->find($id);
        if (!$category) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $category;
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
        $status = isset($params['status']) ? $params['status'] : 0;
        $start_date = isset($params['start_date']) ? $params['start_date'] : null;
        $deleted = isset($params['deleted']) ? $params['deleted'] : false;


        $end_date = isset($params['end_date']) ? $params['end_date'] : null;
        $query = $this->category->createdAtDateBetween([
            'start_date' => $start_date,
            'end_date' => $end_date
        ])->filterByName($name)->GetDeleted($deleted);
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
        return $this->category->forceCreate($this->formatParams($params));
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
            'is_serial' => isset($params['is_serial']) && $params['is_serial'] != ""  ? $params['is_serial'] : 0,
        ];

 
        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }

        return $formatted;
    }

    /**
     * Update given Category.
     *
     * @param Category $category
     * @param array $params
     *
     * @return category
     */
    public function update(Category $category, $params)
    {
        $category->forceFill($this->formatParams($params, 'update'))->save();

        return $category;
    }

    /**
     * Delete Category.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }



    /**
     * Restore Category.
     *
     * @param integer $id
     * @return bool|null
     */
    public function restore(Category $category)
    {
        return $category->restore();
    }


    /**
     * List category by name only
     *
     * @param string $token
     * @return category
     */

    public function listByName()
    {
        return $this->category->get()->pluck('name', 'id')->all();
    }

 
    /**
     * Delete multiple Categories.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->category->whereIn('id', $ids)->delete();
    }



}
