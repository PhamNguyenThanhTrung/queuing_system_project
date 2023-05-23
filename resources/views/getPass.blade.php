@extends("Template.templates")




@section('form1')
<style>

    /* Logo */
    .img {
        text-align: center;
    }
    /* Chỉnh các input */
    .nhap {
    width: 500px;
    height: 50px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    }
    /* Chỉnh màu ký tự quenmk */
    .quenmk a {
        text-decoration: none;
        color: #ff0000;
    }
    /* Nút button */
    .button {
        width: 105px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
    }
    .button:hover {
        background-color: rgb(201, 54, 1);
    }
</style>
<body>
    <div class="container">
        <div class="row">

            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-6" style="background-color: #f7f7f7; padding: 50px;">
                <div>
                    <p class="img" style="text-align:center"><img src="{{ asset($Name_Img ?? 'storage/app/public/Imgs/Logo.jpg') }}" width="30%" height="30%" alt=""></p>

                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">xin chao    {{$members->MemberName}}</h5>
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">Đặt lại mật khẩu mới </h5>
                    <!-- Input mật khẩu -->
                    <form method="post" action="{{ route('getPass', ['email' => $email, 'token' => $token]) }}">
                        @csrf
                        @method('PUT')
    <div class="form-group">

        <label for="password">Vui lòng nhập mật khẩu mới để đặt lại mật khẩu của bạn *</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới của bạn">
        @if ($errors->has('password'))
            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="confirm_password">Vui lòng nhập lại mật khẩu mới để đặt lại mật khẩu của bạn *</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu của bạn">
        @if ($errors->has('confirm_password'))
            <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
        @endif
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (isset($success))
        <script>
            alert("{{ $success }}");
            window.location.href = "/queuing_system/login";
        </script>
    @endif
    <div class="form-group">
        <a href="{{ route('login') }}" class="btn btn-danger">Hủy</a>
        <button type="submit" class="btn btn-primary">Tiếp tục</button>
    </div>
</form>

                </div>
            </div>

            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="{{ asset($Name_Img ?? 'storage/app/public/Imgs/Background_quenmatkhau.jpg') }}"  width="100%" height="100%" alt="">
            </div>

        </div>
    </div>
</body>
