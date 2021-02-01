<?php

namespace App\Repositories;

use App\Group;
use Illuminate\Validation\ValidationException;

class GroupRepository
{
    private $group;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;

    }



    /**
     * Get todo query
     *
     * @return Todo query
     */

    public function getQuery()
    {
        return $this->group;
    }

    /**
     * Find todo with given id or throw an error.
     *
     * @param integer $id
     * @return Todo
     */

    public function findOrFail($id)
    {
        $group = $this->group->find($id);
        if (!$group) {
            throw ValidationException::withMessages(['message' => trans('todo.could_not_find')]);
        }
        return $group;
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


        $end_date = isset($params['end_date']) ? $params['end_date'] : null;
        $query = $this->group->createdAtDateBetween([
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
        return $this->group->forceCreate($this->formatParams($params));
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
       
        ];
        // if ($action === 'create') {
        //     $formatted['user_id'] = \Auth::user()->id;
        // }

        return $formatted;
    }

    /**
     * Update given Group.
     *
     * @param Group $group
     * @param array $params
     *
     * @return group
     */
    public function update(Group $group, $params)
    {
        $group->forceFill($this->formatParams($params, 'update'))->save();

        return $group;
    }

    /**
     * Delete Group.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Group $group)
    {
        return $group->delete();
    }

    /**
     * List group by name only
     *
     * @param string $token
     * @return group
     */

    public function listByName()
    {
        return $this->group->get()->pluck('name', 'id')->all();
    }

 
    /**
     * Delete multiple groupes.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->group->whereIn('id', $ids)->delete();
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
