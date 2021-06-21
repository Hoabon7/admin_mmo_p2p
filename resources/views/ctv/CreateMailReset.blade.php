@extends('layouts.admin')

@section('content')

    <!-- Content area -->
    <div class="content">
        <div class="card">

            <h1>password reset</h1>
            <form class="form" method="post" action="{{ route('forgot_password.store') }}">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">   
                        <label>Mail <span style="color: red;">*</span></label>
                        <input type="text" name="email" id="">
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
