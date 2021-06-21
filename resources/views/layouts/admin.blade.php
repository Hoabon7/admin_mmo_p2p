<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="description" content="Quản trị tài khoản số đẹp">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
{{--	 <meta name="csrf-token" content="{{csrfToken}}">--}}

	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
	<title>Quản trị tài khoản số đẹp</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/css/icons/icomoon/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/bootstrap/bootstrap_admin.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/layout.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/components.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/colors.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">


	<link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet">

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->

	<!-- /global stylesheets -->

	<!-- Page stylesheets -->
	@yield('css')
	<!-- /page stylesheets -->


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="{{ asset('assets/backend/js/bootstrap/html5shiv.js') }}"></script>
	<script src="{{ asset('assets/backend/js/bootstrap/respond.min.js') }}"></script>
 	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<![endif]-->



<!--datatable.net-->
	{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> --}}
</head>

<body>
<!-- Main navbar -->
@include('partial.header')
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content">

@if  (Auth::check()))
	@include('partial.sidebar')
@endif
	




<!-- Main content -->
<div class="content-wrapper">
	@yield('content')
	@include('partial.footer')
</div>
</div>
<!-- /page content -->

<!-- Core JS files -->

<script src="{{ asset('assets/backend/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugin/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>

<!-- /core JS files -->

<!-- Theme JS files -->
<script src="{{ asset('assets/backend/plugin/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugin/notifications/pnotify.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/app.js') }}"></script>
<!-- /theme JS files -->
<!-- Datatable -->
<script src="{{ asset('assets/backend/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/demo_pages/datatables_api.js') }}"></script>
<!-- end dbtable -->
{{-- select --}}
<script src="{{ asset('assets/backend/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/demo_pages/form_select2.js') }}"></script>
{{-- end seclect --}}
{{-- multiselect --}}
<script src="{{ asset('assets/backend/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('assets/backend/js/demo_pages/form_multiselect.js') }}"></script>
{{-- end ultiselect --}}
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js') }}"> </script>


<script>
  function xacnhanxoa(msg){
    if(window.confirm(msg)){
        return true;
    }
    return false;
  }
</script>
<script>

	var button1 = document.getElementById( 'ckfinder-popup-1' );
	var button2 = document.getElementById( 'ckfinder-popup-2' );

	button1.onclick = function() {
		selectFileWithCKFinder( 'ckfinder-input-1' );
	};
	button2.onclick = function() {
		selectFileWithCKFinder( 'ckfinder-input-2' );
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


<script>
CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '{{ asset('assets/backend/plugin/ckfinder/ckfinder.html') }}',
        // filebrowserImageBrowseUrl: '{{ asset('assets/backend/plugin/ckfinder/ckfinder.html?type=Images') }}',
        // filebrowserUploadUrl: '{{ asset('assets/backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        // filebrowserImageUploadUrl: '{{ asset('assets/backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
	});

CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '{{ asset('assets/backend/plugin/ckfinder/ckfinder.html') }}',
        // filebrowserImageBrowseUrl: '{{ asset('assets/backend/plugin/ckfinder/ckfinder.html?type=Images') }}',
        // filebrowserFlashBrowseUrl: '{{ asset('assets/backend/plugin/ckfinder/ckfinder.html?type=Flash') }}',
        // filebrowserUploadUrl: '{{ asset('assets/backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        // filebrowserImageUploadUrl: '{{ asset('assets/backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        // filebrowserFlashUploadUrl: '{{ asset('assets/backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
});
</script>


<script type="text/javascript">
    $("div.alert").delay(3000).slideUp();
</script>
<!-- /theme JS files -->
{{-- @if(flashMessage('message'))
<script>
		Notify('{{flashMessage("message")}}', '{{flashMessage("type")}}')
</script>
@endif --}}
<!-- Page script -->
@yield('script')
<!-- /page script -->
</body>
</html>

