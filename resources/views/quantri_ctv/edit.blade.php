@extends('layouts.admin')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang
                    chủ</a>
                <span class="breadcrumb-item">Danh sách CTV
                </span>
                <span class="breadcrumb-item active">Thêm mới</span>
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
            <h5 class="card-title pb-3">Chỉnh sửa thông tin</h5>
            <div class="header-elements">
                <div class="list-icons">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form class="form"  method="post" action="{{route('member.ctv.update')}}" >
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $dataCtv['id']}}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên CTV<span style="color: red;">*</span></label>
                            <input type="text" name="name" value="{{ $dataCtv['name'] }}" class="form-control" 
                               >
                        </div>
                        @if($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số điện thoại<span style="color: red;">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="số điện thoại"
                                   value="{{ $dataCtv['phone'] }}">
                        </div>
                        @if($errors->has('phone'))
                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                    
                   
                </div>
                <div class="text-right pt-6">
                    <button type="submit" class="btn btn-success" name="submit" >
                        Lưu <i class="icon-floppy-disk ml-2"></i>
                    </button>
                    <a  href="/member/ctv/all" class="btn btn-primary text-white" >
                        Quay lại <i class="fa fa-times"></i>
                    </a>
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
    var date = new Date(document.getElementById("time").value);
    var timestamp = date.getTime();
    let BootstrapMultiselect = function () {
      // Default file input style
      let _componentMultiselect = function () {
        if (!$().multiselect) {
          console.warn('Warning - bootstrap-multiselect.js is not loaded.')
          return
        }

        // Basic initialization
        $('.multiselect').multiselect({
          nonSelectedText: 'Chọn danh mục'
        })
      }

      // Return objects assigned to module
      return {
        init: function () {
          _componentMultiselect()
        }
      }
    }()

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
