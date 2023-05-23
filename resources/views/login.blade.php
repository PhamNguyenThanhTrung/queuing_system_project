@extends("Template.templates")




@section('form1')



    <div class="container" >
        <div class="row">

            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-5" style="background-color: #f7f7f7; padding: 50px;padding-top:50px">

                    <p class="img" style="text-align:center"><img  src="./resources/views/Imgs/Logo.jpg" width="30%" height="30%" alt=""></p>
                    {!! Form::open(['route' => 'login', 'method' => 'post', 'files' => true]) !!}


                    <div class="form-group">
    {{ Form::label('tenDN', 'Tên Đăng Nhập:') }}
    {{ Form::text('tenDN', '', ['class' => 'form-control', 'placeholder' => 'Nhập tenDN']) }}
    @if ($errors->has('tenDN'))
    <div class="alert alert-danger">{{ $errors->first('tenDN') }}</div>
@endif

</div>

<div class="form-group">
    {{ Form::label('password', 'Mật khẩu:') }}
    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu']) }}
    @if($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
    @endif
</div>
<a href="{{Url("")}}/quenmatkhau" class="text-danger" style="  text-decoration:none">quên mật khẩu?</a>
<a href="{{Url("")}}/register"  class="text-danger" style="  text-decoration:none">Đăng ký?</a>
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


<hr>

{{ Form::submit('Đăng nhập', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

@if(session('success'))
<script>
    alert('{{ session('success') }}');

</script>
@endif


            </div>

            <!-- Phần hiển thị background -->
            <div class="col-lg-7">
            <a href="taikhoancanhan">
                <img src="./resources/views/Imgs/Background_dangnhap.jpg"  width="100%" height="100%" alt="">
            </a>
            </div>

        </div>
    </div>

    @endsection
