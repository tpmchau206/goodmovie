<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $user = 'users';

    public function getUser($id)
    {
        $user = DB::table($this->user)
            ->where('id', $id)
            ->get();
        return $user;
    }

    public function getUserLogin($email)
    {
        $user = DB::table($this->user)
            ->where('email', $email)
            ->first();
        return $user;
    }

    public function registerUser($dataInsert)
    {
        DB::table($this->user)->insert($dataInsert);
    }

    public function notify($id)
    {
        return DB::table('notifys')
            ->join('users', 'notifys.user_id', '=', 'users.id')
            ->select('users.id', 'users.username', 'notifys.*')
            ->where('user_id', $id)
            ->orderByDesc('create_at')
            ->get();
    }

    public function changePass($email, $data)
    {
        return DB::table($this->user)
            ->where('email', $email)
            ->update($data);
    }
}
