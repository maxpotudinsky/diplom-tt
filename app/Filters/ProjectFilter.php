<?php

namespace App\Filters;

class ProjectFilter extends QueryFilter
{
    public function project_id($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('id', $id);
        });
    }

    public function executor_id($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('id', $id);
        });
    }
}
