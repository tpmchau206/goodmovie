<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $user = 'users';

    public function getAllUsers($filters = [], $keywords = null, $sortByArr = null, $perPage)
    {
        $users = DB::table($this->user)
            ->select('users.*', 'groups.name as group_name')
            ->where('trash', 0)
            ->join('groups', 'users.group_id', '=', 'groups.id');
        // ->get()->all();

        $orderBy = 'users.create_at';
        $orderType = 'desc';

        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy, $orderType);

        if (!empty($filters)) {
            $users = $users->where($filters);
        }
        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('fullname', 'like', '%' . $keywords . '%');
                $query->orWhere('email', 'like', '%' . $keywords . '%');
            });
        }
        if (!empty($perPage)) {
            $users = $users->paginate($perPage);
        } else {
            $users = $users->get();
        }
        // dd($users);

        return $users;
    }

    public function getUser($id)
    {
        $user = DB::table($this->user)
            ->orWhere('id', $id)
            ->get();
        return $user;
    }

    public function insert($data)
    {
        DB::table($this->user)->insert($data);
    }

    public function updateUser($data, $id)
    {
        // $data[] = $id;

        // return DB::update('UPDATE ' . $this->table . ' set fullname = ?, email = ?, create_at = ? where id = ?', $data);

        return DB::table($this->user)
            ->where('id', $id)
            ->update($data);
    }

    public function getTotalUsers()
    {
        $count = DB::table($this->user)
            ->where('trash', 0)
            ->count();
        // dd($count);
        return $count;
    }
}
