<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            width: 100%;
            background-color: #141414;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 1rem
        }

        .btn {
            padding: 1rem;
            outline: none;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.3rem;
            background-color: #e50914;
            color: white;
            font-weight: bold;
            text-decoration: none
        }
    </style>
</head>

<body>
    <div>
        <p>{{ $user->username }}</p>
        <p>Lấy lại mật khẩu</p>
        <p>Nhấp vào nút bên dưới để đổi mật khẩu</p>
        {{-- {{ route('routeName', ['id' => 1]) }} --}}
        <a href="{{ route('user.get-changePass', ['email' => $user->email]) }}">Đổi mật khẩu</a>

    </div>
</body>

</html>
