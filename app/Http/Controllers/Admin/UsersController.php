<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Admin\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    private $data;
    private $users;
    const _PER_PAGE = 5;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function index(Request $request)
    {
        $this->data['title'] = 'Users';

        $filters = [];
        $keywords = null;

        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }

            $filters[] = ['users.status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;


            $filters[] = ['users.group_id', '=', $groupId];
        }
        // dd($filters);
        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
            // echo $keywords;            
        }

        //Xử lý logic sắp xếp
        $sortBy = $request->input('sort-by');

        $sortType = $request->input('sort-type');

        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        $this->data['users'] = $this->users->getAllUsers($filters, $keywords, $sortArr, self::_PER_PAGE);

        $this->data['sortType'] = $sortType;
        // dd($this->data);

        return view('clients.admin.users.list', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Thêm User';
        $this->data['allgroups'] = getAllGroups();

        return view('clients.admin.users.add', $this->data);
    }

    public function postAdd(UserRequest $request)
    {
        $dataInsert = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'fullname' => $request->fullname,
            'dateofbirth' => $request->dateofbirth,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')
        ];

        $this->users->insert($dataInsert);

        return back()->with('msg', 'Thêm người dùng thành công')->with('stt', 'success');
    }

    public function edit(Request $request, $id)
    {
        $this->data['title'] = 'Cập nhật User';
        $this->data['user'] = $this->users->getUser($id);
        $this->data['allgroups'] = getAllGroups();


        if (!empty($id)) {
            // dd($this->data['movieDetail'][0]->name);
            if (!empty($this->data['user'][0]->id)) {
                # code...
                $request->session()->put('id', $id);
            } else {
                return redirect()->route('admin.users.index')->with('msg', 'User không tồn tại!')->with('stt', 'danger');
            }
        } else {
            return redirect()->route('admin.users.index')->with('msg', 'Liên kết không tồn tại!')->with('stt', 'danger');
        }

        return view('clients.admin.users.edit', $this->data);
    }

    public function postEdit(UserRequest $request, $id = 0)
    {
        $id = session('id');
        // dd($id);
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $checkPass = $this->users->getUser($id);

        if ($request->password == null) {
            $password = $checkPass[0]->password;
        } else {
            $password = bcrypt($request->password);
        }

        $dataUpdate = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $password,
            'fullname' => $request->fullname,
            'dateofbirth' => $request->dateofbirth,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return redirect()->route('admin.users.index')->with('msg', 'Cập nhật người dùng thành công')->with('stt', 'success');
    }
}
