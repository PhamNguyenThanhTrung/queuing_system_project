<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pham Nguyen Thanh Trung </title>
    <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link FontAwesome -->
    <script src="https://kit.fontawesome.com/9ddb5fa8d6.js" crossorigin="anonymous"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <link href="./resources/views/templates1.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Thư viện Morris.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
      /* Body */
      .dangnhap, .datlaimatkhau, .quenmatkhau{
        margin-top: 90px;
    }
    .dangky {
        background-color: #f7f7f7;
    }
    /* Logo */
    .img {
        text-align: center;
    }
    .img_dangnhap {
        text-align: center;
    }
    .img_dangky {
        margin-left: 600px;
    }
    .img_datlaimatkhau {
        text-align: center;
    }
    .img_quenmatkhau {
        text-align: center;
    }
    /* Chỉnh các input */
    .nhap {
    width: 550px;
    height: 50px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    }
    .nhap_quenmk {
    width: 500px;
    height: 50px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    }
    .nhap_avatar {
        width: 370px;
        height: 40px;
        border-radius: 8px;
        background-color: #d8d8d8;
        border: 1px solid rgb(202, 202, 202);
        padding-left: 10px;
    }
    .dropd {
        width: 270px;
        height: 45px;
        border-radius: 8px;
        border: 1px solid rgb(202, 202, 202);
        padding-left: 10px;
    }
    .dropdown-icon {
        position: relative;
    }

    .dropdown-icon select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .dropdown-icon i {
        position: absolute;
        top: 50%;
        left: 240px;
        transform: translateY(-50%);
    }
    .icon_dropd {
        color: orangered;
        font-size: 25px;
    }
    /* Chỉnh màu ký tự quenmk */
    .quenmk a {
        text-decoration: none;
        color: #ff0000;
    }
    /* Nút button */
    .button_dangnhap {
        width: 105px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
    }
    .button_dangnhap:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_dangky {
        width: 125px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
        text-align: center;
    }
    .button_dangky:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_datlaimatkhau {
        width: 105px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
    }
    .button_datlaimatkhau:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_xn {
        width: 140px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
        margin-left: 40px;
    }
    .button_xn:hover {
        background-color: rgb(201, 54, 1);
    }
    /* Nút button hủy */
    .button_huy {
        text-decoration: none;
        display: inline-block;
        width: 140px;
        height: 40px;
        border-radius: 6px;
        border: 1px solid orangered;
        background-color: #f7f7f7;
        color: orangered;
        text-align: center;
        line-height: 37px;
    }
    .button_huy:hover {
        background-color: #f7f7f7;
        border: 1px solid rgb(201, 54, 1);
        color:rgb(201, 54, 1);
    }
    .button_dn {
        margin-top: 210px;
        width: 140px;
        height: 37px;
        color: orangered;
        font-weight: 400;
        background-color: #fceac8;
        border: none;
        border-radius: 6px;
    }
     /* Menu */
    .menu ul {
        list-style-type: none;
        padding: 0px;
    }
    .menu ul a {
        padding-left: 15px;
        color: #848387;
        text-decoration: none;
        line-height: 50px;
        display: block;
    }
    .menu ul a:hover {
        color: orangered;
        background-color: #fceac8;
    }
    /* Thông tin của user */
    .khung {
        margin-top: 70px;
        background-color: #ffffff;
        border-radius: 10px;
        width: 1100px;
        height: 380px;
        box-shadow: 2px 2px 10px #848387;
    }
    .khung img {
        margin-top: 10px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        margin-left: 10px;
    }
    .khung h5 {
        margin-top: 25px;
        font-size: 25px;
        text-align: center;
        font-weight: 600;
    }
    /* Chỉnh icon bell */
    .icon {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 2px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        margin-left: 690px;
    }
    .icon_notify {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 3.5px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        border: none;
    }
    /* Button chuông khi chưa đăng nhập ở trang cá nhân */
    .icon_notify_chuadn {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 3.5px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        /* margin-left: 730px; */
        border: none;
    }
    .icon:hover, .icon_notify:hover, .icon_notify_chuadn:hover {
        color: #ffffff;
        background-color: orangered;
    }
    /* Chỉnh hình avatar nhỏ */
    .icon_avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    /* Chỉnh icon camera */
    .icon_camera {
        color: #ffffff;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 50%;
        background-color: orangered;
        position: absolute;
        top: 365px;
        left: 440px;
        border: 3px solid #ffffff;
        font-size: 26px;
        padding-top: 2px;
    }
    /* Thanh tìm kiếm */
    .icon_search {
        color: orangered;
        font-size: 20px;
    }
    .dropd::-webkit-search-cancel-button {
        display: none;
    }

    /* Thanh cuộn dropdown (icon chuông) */
    .dropdown-menu-notification {
        z-index: 99999;
        width: 360px;
        height: 526px;
        position: absolute;
        top: 0;
        left: 800;
        margin: 0;
        padding: 0;
        border-radius: 10px;
        margin-right: -20px;
        overflow: hidden;
        border: none;
        background-color: #ffffff;
    }
    .header-notification {
        background-color: #FF9138;
        height: 48px;
        display: flex;
    }

    .header-notification p {
        margin: 0;
        padding: 0;
        color: #fff;
        display: flex;
        align-items: center;
        margin-left: 24px;
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
    }
    .list-notification {
        height: 477px;
        overflow-y: auto;
        background-color: #fff;
    }
    /* Thanh cuộn notification*/
    .list-notification::-webkit-scrollbar {
        width: 0em;
    }

    .list-notification:hover::-webkit-scrollbar {
        width: 0.3em;
    }
    .list-notification:hover::-webkit-scrollbar-thumb {
        margin-left: 5px;
    }

    .list-notification::-webkit-scrollbar-track {
        -webkit-box-shadow: none;
        background-color: transparent;
    }

    .list-notification::-webkit-scrollbar-thumb {
        background-color: #FFC89B;
        outline: none;
        border-radius: 20px;
    }

    .item-notification {
        padding: 16px 0px 12px 24px;
        border-bottom: 1.5px solid #D4D4D7;
    }
    .item-notification:hover {
        background-color: #FFF2E7;
    }

    .text-user-notifi {
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-weight: 700;
        line-height: 24px;
        color: #BF5805;
    }

    .condition-notifi {
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        color: #535261;
    }

    /* Button thêm thiết bị */
    .themthietbi {
        margin-top: 16px;
        width: 80px;
        height: 90px;
        text-align: center;
        border-radius: 8px 8px px 8px;
        background-color: #fceac8;
        padding: 5px;
        box-shadow: 1px 1px 10px #848387;
        font-weight: 600;
    }
    .themthietbi i {
        color: orangered;
        font-size: 29px;
    }

/* Bảng danh sách các thiết bị */
.table-list-device {
    width: 1112px;
    margin-top: 16px;
    border-radius: 12px;
}
table {
    border-radius: 12px;
    width: 1087px;
    filter: drop-shadow(2px 2px 8px rgba(232, 239, 244, 0.8));
}
tbody {
    border-radius: 12px;
}
table thead {
    background-color: orangered;
    color: #ffffff;
}
.th-border-left {
    border-radius: 12px 0px 0px 0px;
}
.th-border-right {
    border-radius: 0px 12px 0px 0px;
}
.th-border-bottom-left {
    border-radius: 0px 0px 0px 12px;
}
.th-border-bottom-right {
    border-radius: 0px 0px 12px 0px;
}
tr {
    height: 48px;
}
td {
    font-weight: 400;
    font-size: 16px;
    color: #848387;
    padding-left: 12px;
    line-height: 10px;
}
td a {
    font-weight: 400;
    font-size: 14px;
}
.border-table {
    border-right: 2px solid #ffe3cd;
    border-left: 2px solid #ffe3cd;
}
.color-tr-or {
    background-color: #fceac8;
}
.color-tr-white {
    background-color: #ffffff;
}
tr:nth-child(even) {
  background-color: #fceac8;
}
/* Phân trang */
.phantrang {
    display: inline-block;
    height: 32px;
    margin-top: 25px;
    margin-left: 765px;
}
.trang {
    display: flex;
}

.trang li {
    width: 32px;
    height: 32px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.trang li a {
    text-decoration: none;
    font-weight: 600;
    font-size: 19px;
    color: #848387;
}

.modautrang {
    background-color: orangered;
}
.modautrang a {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 19px;
}
/* Form nhập thiết bị */
.khung_themthietbi {
    margin-top: 25px;
    background-color: #ffffff;
    border-radius: 10px;
    width: 1100px;
    height: 560px;
    box-shadow: 2px 2px 10px #848387;
    padding-left: 20px;
}
.khung_themthietbi p {
    font-weight: 600;
}
/* Input thêm thiết bị */
.nhap_themthietbi {
    width: 495px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.nhap_dv {
    width: 1035px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
/* Select loại thiết bị */
.select_loai {
    width: 495px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    color: #757575;
}
.dropdown-loai {
    position: relative;
}
.dropdown-loai select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.dropdown-loai i {
    position: absolute;
    top: 50%;
    left: 465px;
    transform: translateY(-50%);
}
.icon_dropd {
    color: orangered;
    font-size: 25px;
}
/* Input chọn thời gian (trang dịch vụ) */
.chonthoigian {
    width: 180px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.chonthoigian input[type="date"]::-webkit-calendar-picker-indicator {
  color: orange; /* Tùy chỉnh màu sắc */
  background: transparent;
  font-size: 14px;
}
</style>
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>


<body>
    @yield ('form1')
<div class="row">

   <div class="col-lg-2" style="margin-top: 20px;">

            @if(View::hasSection('header'))
                @include ("includes.header")
            @endif
            @if(View::hasSection('BTCS'))
            @include ("includes.header")
        @endif
        </div>
        @if($user = session('user'))
        <div class="col-lg-10" style="background-color: #f7f7f7;">
        <!-- Trang tài khoản cá nhân -->

        @yield ('header')



        </div>@endif

          @yield ('BTCS')
    </div>

</body>


</html>
