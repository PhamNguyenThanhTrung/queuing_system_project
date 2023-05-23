
@extends("Template.templates")
@section('form1')
<?php
$dv=['Kế Toán', 'Lập Trình PHP ( Laravel )', 'Lập Trình backend', 'Lập Trình App Mobile'];
$tt=['Ngưng hoạt động', 'Hoạt động',];
?>

    <div class="container">
        <div class="row">

            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-6" style="background-color: #f7f7f7; padding: 50px;padding-bottom: 20px; margin: auto;">    
            {!! Form::open(['url' => 'register', 'files'=>'true']) !!}
<h1 style="text-align: center;">đăng ký</h1>
<hr>
<div class="form-group">
    {{ Form::label('ten', 'Tên :') }}
    {{ Form::text('ten', '', ['class' => 'form-control']) }}
    @error('ten')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
{{ Form::label('tenDN', 'Tên đăng nhập:') }}
{{ Form::text('tenDN', '', ['class' => 'form-control', 'placeholder' => 'nhập tên đăng nhập']) }}

    @error('tenDN')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

{{ Form::label('matkhau', 'Mật khẩu:') }}
{{ Form::password('matkhau', ['class' => 'form-control', 'placeholder' => 'nhập mật khẩu']) }}

<div class="form-group">
{{ Form::label('sdt', 'Số điện thoại:') }}
{{ Form::number('sdt', '', ['class' => 'form-control', 'placeholder' => 'nhập số điện thoại']) }}

    @error('sdt')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
{{ Form::label('email', 'Email:') }}
{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'nhập email']) }}
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
{{ Form::label('diachi', 'Địa chỉ:') }}
{{ Form::text('diachi', '', ['class' => 'form-control', 'placeholder' => 'nhập địa chỉ']) }}

    @error('diachi')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
{{ Form::label('vaitro', 'Vai Trò :') }}
{{ Form::select('vaitro',  $dv, '', ['class' => 'form-control', 'placeholder' => 'chọn']) }}

    @error('diachi')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
{{ Form::label('Tinhtrang', 'Tình Trạng :') }}
{{ Form::select('Tinhtrang',  $tt, '', ['class' => 'form-control', 'placeholder' => 'chọn']) }}

    @error('Tinhtrang')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<br>
<!-- @if ($errors)
    @foreach ($errors->all() as $e)
        {{ $e }} <br>
    @endforeach
@endif -->

@if (isset($success))
    <script>
        alert("{{ $success }}");
        window.location.href = "/queuing_system/login";
    </script>
@endif


<hr>
{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}

{!! Form::close() !!}

</div>
            
            
            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="./resources/views/Imgs/Background_dangnhap.jpg"  width="100%" height="100%" alt="">
            </div>

        </div>
    </div>

    @endsection