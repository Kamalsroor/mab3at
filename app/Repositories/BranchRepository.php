<?php

namespace App\Repositories;

use App\Branch;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class BranchRepository
{
    private $branch;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Branch $branch)
    {
        $this->branch = $branch->with('user', 'user.profile');
    }

    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->branch;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function findOrFail($id)
    {
        $branch = $this->branch->find($id);
        if (!$branch) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $branch;
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
        $query = $this->branch;
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
        return $this->branch->forceCreate($this->formatParams($params));
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
            'name'       => isset($params['name']) ? $params['name'] : null,
            'address'       => isset($params['address']) ? $params['address'] : null,
            'phone'       => isset($params['phone']) ? $params['phone'] : null,
            'telephone'       => isset($params['telephone']) ? $params['telephone'] : null,
            'user_id' => (isset($params['user_id']) && $params['user_id']) ? $params['user_id'] : null,

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
    public function update(Branch $branch, $params)
    {
        $branch->forceFill($this->formatParams($params, 'update'))->save();

        return $branch;
    }

    /**
     * Delete Branch.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Branch $branch)
    {
        return $branch->delete();
    }


    /**
     * List branch by name only
     *
     * @param string $token
     * @return branch
     */

    public function listByName()
    {
        return $this->branch->get()->pluck('name', 'id')->all();
    }


    /**
     * List branch by name only
     *
     * @param string $token
     * @return branch
     */

    public function listWhereUserIdByName()
    {
        return $this->branch->where('user_id', Auth()->user()->id)->get()->pluck('name', 'id')->all();
    }

    /**
     * Delete multiple branches.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->branch->whereIn('id', $ids)->delete();
    }
}
