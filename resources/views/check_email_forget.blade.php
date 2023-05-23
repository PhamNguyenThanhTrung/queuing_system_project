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
                    <p class="img"><img src="https://raw.githubusercontent.com/PhamNguyenThanhTrung/Image_queuing_system/main/Imgs/Background_dangnhap.jpg" width="30%" height="30%" alt=""></p>
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">xin chao    {{$members->MemberName}}</h5>
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">Đặt lại mật khẩu mới</h5>
                    <!-- Input mật khẩu -->
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">Nhấn vào nút bên dưới để xác nhận đổi mật khẩu mới</h5>


                </div style="margin:auto">
                <button class="btn-btn-warning"  style="font-size: larger; font-weight: 600; text-align: center;">   <a href="{{ route('pass.editgetPass',['email'=>$email, 'token' =>$token]) }}" class="btn btn-danger">lấy pass</a></button>

                <h5 style="font-size: larger; font-weight: 600; text-align: center;">đường dẫn chỉ có thời hạn 1 phút nếu qua 1 phút vui lòng xác nhận lại email</h5>

                <a  style="font-size: larger; font-weight: 600; text-align: center;"  href="{{ route('quenmatkhau') }}" class="btn btn-danger">xác nhận lại email</a>
            </div>




                </div>
            </div>

            <!-- Phần hiển thị background -->
      

        </div>
    </div>
</body>
