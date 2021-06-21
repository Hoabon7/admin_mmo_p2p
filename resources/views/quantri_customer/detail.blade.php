@extends('layouts.admin')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang
                    chủ</a>
                <span class="breadcrumb-item">khách hàng
                </span>
                <span class="breadcrumb-item active">Chi tiết thông tin khách hàng</span>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="card">
        <div class="col-lg-12">
            @if (Session::has('notifi'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ Session::get('notifi') }} </strong>
                </div>
            @endif
        </div>
        <div class="card-header header-elements-inline">
            <h5 class="card-title pb-3">Chi tiết thông tin khách hàng</h5>
        </div>  
        <div class="card-body card-chitietdon">
            <form class="form" action="" method="POST" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <b>Tên khác hàng: </b>{{$data['customer']->name}} </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <b>Số điện thoại: </b>{{$data['customer']->phone}} </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <b>Trạng thái hoạt động: </b> {{app\Models\Customer::convertStatusFromIntToString($data['customer']->status)}}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <b>Vai trò: </b> {{app\Models\Customer::convertRoleFromIntToString($data['customer']->role)}}</label>
                          
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Email: </b>{{$data['customer']->email}}</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Bổ sung: </b>{{$data['customer']->reason}}</label>
                        </div>
                      </div>


                   
                    
                
                    <div class="form-group col-md-12">
                        <label> <b>Ảnh 2 sao kê ngân hàng </b></label>
                            <div class="d-flex flex-wrap">

                                @foreach ($data['image_bank'] as $item )
                                    @if (!empty($item))
                                    <a class="example-image-link mb-2 mr-2" href="/{{$item}}"  data-toggle="lightbox">
                                        <img src="/{{$item}}" width="150" height="70" />
                                      </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    <div class="form-group col-md-12">
                    <label> <b>Ảnh chứng minh thư </b></label>
                        <div class="d-flex flex-wrap">
                            @foreach ($data['image_idCard'] as $item )
                                @if (!empty($item))
                                <a class="example-image-link mb-2 mr-2" href="/{{$item}}"  data-toggle="lightbox">
                                    <img src="/{{$item}}" width="150" height="70" />
                                </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                   
                    <div class="text-right pt-6">
                        <a  href="{{route('member.customer.update_role', [$data['customer']->id,$data['customer']->role])}}" class="button btn-primary text-white" >
                            Xét duyệt <i class="fa fa-check-square-o"></i>
                        </a>
                    </div>
                    <div class="text-right pt-6">
                        <a  href="{{ route('member.customer.add_reason', $data['customer']->id)}}" class="button btn-success text-white" >
                            Bổ sung <i class="fa fa-pencil-square-o"></i>
                        </a>
                    </div>

                    <div class="text-right pt-6">
                        <a  href="{{route('member.customer.all')}}" class="button btn-danger text-white" >
                            Quay lại <i class="fa fa-undo "></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/backend/plugin/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('assets/backend/plugin/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('assets/backend/plugin/forms/selects/bootstrap_multiselect.js') }}"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    let FormStyle = function () {
      // Uniform
      let _componentUniform = function (element) {
        if (!$().uniform) {
          console.warn('Warning - uniform.min.js is not loaded.')
          return
        }

        // Default initialization
        $('.form-control-styled').uniform()
      }

      // Return objects assigned to module
      return {
        init: function () {
          _componentUniform()
        }
      }
    }()

    // Initialize module
    // ------------------------------
    document.addEventListener('DOMContentLoaded', function () {
      BootstrapMultiselect.init()
      FormStyle.init()
    })

    var button1 = document.getElementById( 'ckfinder-popup-1' );

    button1.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-1' );
    };

    var button2 = document.getElementById( 'ckfinder-popup-2' );

    button2.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-2' );
    };

    var button3 = document.getElementById( 'ckfinder-popup-3' );

    button3.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-3' );
    };

    function selectFileWithCKFinder( elementId ) {
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( elementId );
                    output.value = file.getUrl();
                } );

                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( elementId );
                    output.value = evt.data.resizedUrl;
                } );
            }
        } );
    }
</script>
@endsection
