@extends('layouts.admin')

@section('content')

    <!-- Content area -->
    <div class="content">
        <div class="card">

            <h1>password reset</h1>
            <form class="form" method="post" action="{{ route('forgot_password.reset') }}">
                @csrf

                <input type="hidden" name="token" class="form-control" value="{{$passwordReset['token']}}">
                <div class="col-md-12">
                    <div class="form-group">
                        
                        <label>Mật khẩu mới <span style="color: red;">*</span></label>
                        <input type="password" name="password" id="">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="email" class="form-control" value="email">
                        <label>Nhập lại mật khẩu <span style="color: red;">*</span></label>
                        <input type="password" name="password_confirm" id="">
                    </div>

                </div>


                <button type="submit" class="btn btn-success" name="submit">
                    Lưu <i class="icon-floppy-disk ml-2"></i>
                </button>
            </form>
        </div>
    @endsection
    @section('css')
        <style>
            .card-body.text-center,
            .card-body a {
                color: #3100FF;
            }

        </style>
    @endsection
