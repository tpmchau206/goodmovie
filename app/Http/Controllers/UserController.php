<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Admin\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    //
    private $user;
    private $data;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $this->data['title'] = 'Đăng nhập - Login';
        return view('clients.login', $this->data);
    }

    public function postLogin(UserRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = $this->user->getUserLogin($email);
        if ($user == null) {
            return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
        }
        $hashedPassword = $user->password;
        if (Hash::check($password, $hashedPassword)) {
            // Mật khẩu khớp, thực hiện đăng nhập
            session()->put([
                'id' => $user->id,
                'username' => $user->username
            ]);
            if ($user->trash == 0) {
                if ($user->status == 1) {
                    if ($user->group_id == 1) {
                        return redirect()->route('admin.index');
                    } else if ($user->group_id == 2) {
                        return redirect()->route('index.home');
                    }
                } else {
                    return back()->with('msg', 'Tài khoản của bạn chưa kích hoạt.');
                }
            } else {
                return back()->with('msg', 'Tài khoản của bạn không còn tồn tại');
            }
        } else {
            // Mật khẩu không khớp
            $password = '';
            return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function getRegister()
    {
        $this->data['title'] = 'Đăng ký - Register';

        return view('clients.register', $this->data);
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'confirmed', Password::min(6)],
            // 'password_confirm' => ['required', 'confirmed', Password::min(6)]
        ];
        $messages = [
            'required' => 'Vui lòng nhập :attribute.',
            'email' => ':attribute đăng nhập phải là địa chỉ :attribute hợp lệ.',
            'min' => ':attribute đăng nhập phải có ít nhất :min ký tự.',
            'confirmed' => ':attribute không đúng.'
        ];
        $attributes = [
            'username' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu nhập lại',

        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        $validator->validate();
        $email = $request->email;
        $user = $this->user->getUserLogin($email);
        // dd($user);
        $dataRegister = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 1,
            'group_id' => 2,
            'create_at' => date('Y-m-d H:i:s')
        ];
        if ($user == null) {
            $this->user->registerUser($dataRegister);
            return redirect()->route('user.login')->with('msg', 'Đăng ký thành công');
        } else {
            return back()->with('msg', 'Tài khoản bạn đăng ký đã tồn tại.');
        }

        // $password = bcrypt($request->password);

        // dd($dataRegister);
        // return $validator;
    }

    public function getLogout()
    {
        session()->flush();

        return redirect()->route('user.login');
    }

    public function getForgetPass()
    {
        $this->data['title'] = 'Quên mật khẩu - Forget Password';

        return view('clients.forgetpass', $this->data);
    }

    public function postForgetPass(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:user'],
        ];
        $messages = [
            'required' => 'Vui lòng nhập :attribute.',
            'email' => ':attribute đăng nhập phải là địa chỉ :attribute hợp lệ.',
            'exists' => ':attribute không tồn tại trong hệ thống',
        ];
        $attributes = [
            'email' => 'Email',

        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        $validator->validate();

        $token = $request->session()->token();

        if ($token) {
            $checkEmail = $request->email;
            $user = $this->user->getUserLogin($checkEmail);

            $expiration = Carbon::now()->addMinutes(3); // Thời gian hết hạn 3 phút sau khi tạo session
            Session::put('email', $user->email);
            Session::put('expiration', $expiration);

            Mail::send('clients.emails.check_email_forget', compact('user'), function ($email) use ($user) {
                $email->subject('GoodMovie - Lấy lại mật khẩu');
                $email->to($user->email, $user->username);
            });

            return response()->json([
                'msg' => 'Đã gửi liên kết lấy lại mật khẩu đến Email của bạn.',
                // 'token' => $user
            ], 200);
        }
    }

    public function getChangePass($email)
    {
        $this->data['title'] = 'Đổi mật khẩu - Change Password';

        $this->data['user'] =  $this->user->getUserLogin($email);

        return view('clients.changepass', $this->data);
    }

    public function postChangePass(Request $request)
    {
        $rules = [
            'password' => ['required', 'confirmed', Password::min(6)],
            // 'password_confirm' => ['required', 'confirmed', Password::min(6)]
        ];
        $messages = [
            'required' => 'Vui lòng nhập :attribute.',
            'min' => ':attribute đăng nhập phải có ít nhất :min ký tự.',
            'confirmed' => ':attribute không đúng.'
        ];
        $attributes = [
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu nhập lại',

        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        $validator->validate();

        if (Carbon::now()->gt(Session::get('expiration'))) {
            // Session đã hết hạn
            // Xử lý khi session đã hết hạn ở đây
            dd('het hieu luc session');
        } else {
            // Session vẫn còn hiệu lực
            // Xử lý khi session vẫn còn hiệu lực ở đây
            $email = session('email');
            $changePass = ['password' => bcrypt($request->password)];
            if ($email) {
                $this->user->changePass($email, $changePass);
                return redirect()->route('user.login')->with('msg', 'Đổi mật khẩu thành công, mời bạn đăng nhập');
            }
        }
    }

    public function getLoginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getLoginGoogleCallBack()
    {
        $user = Socialite::driver('google')->user();
        $checkUser = $this->user->getUserLogin($user->getEmail());
        // dd($checkUser);
        if ($checkUser == null) {
            $dataRegister = [
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'status' => 1,
                'group_id' => 2,
                'create_at' => date('Y-m-d H:i:s'),
            ];
            $this->user->registerUser($dataRegister);
            $user = $this->user->getUserLogin($user->getEmail());

            // dd($this->user);
            session()->put([
                'id' => $user->id,
                'username' => $user->username
            ]);
            return redirect()->route('index.home');
        } else {
            $user = $this->user->getUserLogin($user->getEmail());
            session()->put([
                'id' => $user->id,
                'username' => $user->username
            ]);
            return redirect()->route('index.home');
        }
    }
}
