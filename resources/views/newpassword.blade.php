@extends("Template.templates")




@section('matkhaumoi')
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
                    <p class="img"><img src="./resources/views/Imgs/Logo.jpg" width="30%" height="30%" alt=""></p>
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">Đặt lại mật khẩu mới</h5>
                    <!-- Input mật khẩu -->
                    <p>Mật khẩu *
                    <input type="password" class="nhap" name="matkhau"></p>
                    <!-- Input mật khẩu -->
                    <p>Nhập lại mật khẩu *
                    <input type="password" class="nhap" name="nlmatkhau"></p>
                    <!-- Nút button xác nhận -->
                    <p style="text-align: center;"><a href="login"><button type="submit" class="button">Xác nhận</button></a></p>
                </div>
            </div>
            
            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="./resources/views/Imgs/Background_quenmatkhau.jpg"  width="100%" height="100%" alt="">
            </div>

        </div>
    </div>
</body>

