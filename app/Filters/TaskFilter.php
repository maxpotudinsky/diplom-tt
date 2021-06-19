<?php

namespace App\Filters;

use App\RoleTask;

class TaskFilter extends QueryFilter
{
    public function executor_id($id = null)
    {
//        $executorTask_ids = collect();
//        $executors = RoleTask::where(['user_id' => $id, 'role_id' => 2])->get();
//        foreach ($executors as $executor) {
//            $executorTask_ids->push($executor->task_id);
//        }
//        return $this->builder->when($executorTask_ids, function ($query) use ($executorTask_ids) {
//            //        dd($executorTask_ids);
//
////            for ($i = 0; $i < count($executorTask_ids); $i++) {
////                $query->where('id', $executorTask_ids[$i]);
////            }
//
//            foreach ($executorTask_ids as $executorTask_id) {
//                $query->where('id', $executorTask_id);
//            }
//        });
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('id', $id);
        });
    }

    public function director_id($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('id', $id);
        });
    }
}
