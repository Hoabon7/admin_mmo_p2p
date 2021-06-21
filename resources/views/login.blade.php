<!DOCTYPE html>
<html lang="en">
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Admin</title>
        
            <!-- Global stylesheets -->
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
                type="text/css">
                <link href="{{ asset('assets/backend/css/icons/icomoon/styles.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/backend/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/backend/css/bootstrap/bootstrap_admin.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/backend/css/layout.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/backend/css/components.min.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/backend/css/colors.min.css') }}" rel="stylesheet">
            
            <!-- /global stylesheets -->
        
            <!-- Core JS files -->
            <script src="{{ asset('assets/backend/js/main/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/backend/js/main/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/backend/js/plugins/loaders/blockui.min.js') }}"></script>
            <!-- /core JS files -->
        
            <!-- Theme JS files -->
            <script src="{{ asset('assets/backend/js/app.js') }}"></script>
            <!-- /theme JS files -->
        
        </head>
    
<body>
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">
               
                <!-- Login form -->
                <form class="login-form"
                    action="{{ route('check_login') }}" method="POST">
                    @csrf
                    @if(Session::has('danger'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{-- <strong>{{ Session::get('danger') }} </strong> --}}
                    </div>
                    @endif
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i
                                    class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Đăng nhập</h5>
                                {{-- <span class="d-block text-muted">Enter your credentials below</span> --}}
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" placeholder="Email" name="email">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập <i
                                        class="icon-circle-right2 ml-2"></i></button>
                            </div>

                            <div class="text-center">
                                <a href="{{url('forgot_password/create')}}">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->

            </div>
            <!-- /content area -->


            <!-- Footer -->
          
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
</body>
</html>
