<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();
// Lấy thông tin người dùng hiện tại
$request = request();
// Kiểm tra vai trò của người dùng


// Thực hiện các hành động khác cho quyền truy cập được phép


?>
<!-- Hiện khung menu -->
<p class="img"><a href="{{ url('/') }}/taikhoancanhan">
    <img src="https://phamnguyenthanhtrung.github.io/Image_queuing_system/Imgs/Logo.jpg" width="45%" height="45%"alt=""></a></p>
<div class="menu">
    <ul>
        <li><a href="{{ url('/Dashboard') }}?Dashboard=Dashboard"><i class="fa-brands fa-windows"></i> Dashboard</a></li>
        <li><a href="{{ url('/Thietbi') }}?Thietbi=Thietbi"><i class="fa-solid fa-computer"></i> Thiết bị</a></li>
        <li><a href="{{ url('/Dichvu') }}?Dichvu=Dichvu"><i class="fa-brands fa-servicestack"></i> Dịch vụ</a></li>
        <li><a href="{{ url('/Capso') }}?Capso=Capso"><i class="fa-brands fa-dropbox"></i> Cấp số</a></li>
        <li><a href="{{ url('/Baocao') }}?Baocao=Baocao"><i class="fa-solid fa-bookmark"></i> Báo cáo</a></li>
        <li>
            <div class="dropdown dropend">
                <p data-bs-toggle="dropdown"><a href="#">
                        <i class="fa-solid fa-gear"></i> Cài đặt hệ thống
                        <i class="fa-solid fa-ellipsis-vertical"></i></a></p>
                <ul class="dropdown-menu">
                    <a href="{{ url('/Themthietbi') }}?tangtudong=something" style="text-decoration: none; color: orangered;">

                    <li><a class="dropdown-item" href="{{ url('/Vaitro') }}?Admin=fix">Quản lý vai trò</a></li>
                    <li><a class="dropdown-item" href="{{ url('/quanlytaikhoan') }}?Admin=fix">Quản lý tài khoản</a></li>
                    <li><a class="dropdown-item" href="{{ url('/Nhatky') }}?Admin=fix">Nhật ký người dùng</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!-- Nút button đăng nhập -->
<p style="text-align: center;">
    @if ($user = session('user'))
        <a href="{{ url('/logout') }}">
            <button type="button" class="button_dn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất
            </button>
        </a>
    @else
        <a href="{{ url('/login') }}">
            <button type="button" class="button_dn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng nhập
            </button>
        </a>
    @endif
</p>

<div style="display: flex; position: absolute; top: 20px; width: 100px;">
    <div style="width: 30px; margin-left: 1100px;">
        @if ($user = session('user'))
            <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <button type="button" class="icon_notify"><i class="fa-solid fa-bell"></i></button>
                </a>
                <div class="dropdown-menu dropdown-menu-start dropdown-menu-notification dropdown-menu-end">
                    <div class="header-notification">
                        <p>Thông báo</p>
                    </div>

                    <div class="item-notification">

                        <?php

$servername = "127.0.0.1";
$username = "queuing_system_Admin";
$password = "12345678";
$dbname = "queuing_system";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Kiểm tra kết nối
$query = "SELECT g.STT, g.MemberName, g.Name_Dv, g.source, g.member_id, g.ID_Tb, g.created_at, g.updated_at, g.expired_at, a.ID_Img, a.Name_Img, a.created_at AS avatar_created_at, a.updated_at AS avatar_updated_at FROM `grant` AS g INNER JOIN `avatar` AS a ON g.member_id = a.member_id";
$stmt = $conn->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $STT = $row['STT'];
    $MemberName = $row['MemberName'];
    // Lấy các trường khác tương tự
    $Name_Img = $row['Name_Img'];
    $created_at = $row['created_at'];
    // Các thông tin khác của grant


// Đóng kết nối
$conn = null;
?>
                        <p class="text-user-notifi">

                            Người dùng:
                            <!-- Dòng thứ nhất -->




                            <?php echo $row['MemberName']; ?>


                        </p>
                        <p class="condition-notifi">Thời gian nhận số: <?php echo $row['created_at'];
                        ?></p>
                        <?php }?>
                    </div>


                </div>
            </div>
        @else
            <div>
                <a href="#">
                    <p class="icon_notify_chuadn"><i class="fa-solid fa-bell"></i></p>
                </a>
            </div>
        @endif
    </div>
    <div style="display: flex;">
        <!-- Chia khung cho avatar -->
        @if (Auth::check())
        <div style="width: 40px; height: 40px; margin-left: 20px;">
            <?php
          $user = Auth::user();
$memberID = $user->MemberID;

$rows = DB::table('avatar')->where('member_id', $memberID)->get();

foreach ($rows as $row) {
    $Name_Img = $row->Name_Img;
    // Thực hiện các thao tác khác với dữ liệu


            ?>

                   <img src="{{ asset($Name_Img ?? 'storage/app/public/pp.png') }}" class="icon_avatar">
                <?php } ?>

            </div>
        @endif
        <!-- Chia khung cho tên người dùng -->
        @if ($user = session('user'))
            <div style="width: 200px; height: 40px; margin-left: 10px;">
                <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>

                    <span style="color: black; font-weight: 500;">{{ $user->MemberName }}</span>
                </p>
            </div>
        @elseif(!View::hasSection('themthietbi'))
            <div style="width: 180px; height: 40px; margin-left: 20px;">
                <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>
                    <span style="color: black; font-weight: 500;">Bạn cần đăng nhập</span>
                </p>
            </div>
        @endif
    </div>
</div>
