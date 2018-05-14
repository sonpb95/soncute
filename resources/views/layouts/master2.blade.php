<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ifunding </title>
	
	
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style1.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/summernote/summernote.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
	
	<!------ jquery need call here to use javascrip ---------->
	
	<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
	<style>
	.btn-file {
    position: relative;
    overflow: hidden;
	}
	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}
	
	#img-upload{
		width: 50%;
	}

	.note-group-select-from-files {
	  display: none;
	}
	</style>
  </head>
  <body>
  <div id="wrapper">
  
    
	@yield('navigation')
	<div id="page-wrapper" class="gray-bg">
	@include ('layouts.topnavbar')
    
        @yield('content')
    

    @include('layouts.footer2')
	</div>
	</div>
	<!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
	<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"> </script>
	<script src="{{ asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"> </script>
	<script src="{{ asset('js/plugins/summernote/summernote.min.js') }}"></script>
	 <!-- Data picker -->
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
	<!-- Sweet alert -->
	<script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	 <!-- Chosen -->
    <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
	<!-- Jquery Validate -->
    <script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
	<!-- Jquery DataTable -->
	<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
	 <script>
			$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {
				
				var input = $(this).parents('.input-group').find(':text'),
					log = label;
				
				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}
			
			});
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
						$('#img-upload').attr('src', e.target.result);
						
					}
					
					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});
			
			$('.tagsinput').tagsinput({
                tagClass: 'label label-primary',
				confirmKeys: [13, 32, 44]
            });
			$('.summernote').summernote({
			  height: 500,   //set editable area's height
			  codemirror: { // codemirror options
				theme: 'monokai'
			  }
			});
			 $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			$("#radio1").change(function() {
			var val = $(this).val();
			if(val === "option1") {
				$("#show_option").hide();
				
			}
			
		  }).trigger('change');
		  
		  $("#radio2").change(function() {
			var val = $(this).val();
			if(val === "option2") {
				$("#show_option").show();
				
			}
			
		  }).trigger('change');
		
		  $('.chosen-select').chosen({width: "100%"});
		  $("#form").validate({
                 rules: {
                     title: {
                         required: true,
                         minlength: 3
                     },
                     tagline: {
                         required: true,
						 minlength: 1
                     },
                     categories: {
                         required: true
                     },
                     location: {
                         required: true,
						 minlength: 6
                     },
                     duration: {
                         required: true,
						 minlength: 1,
						 maxlength: 2,
						 max: 60,
						 min: 1
                     },
					 account_number: {
                         required: true,
						 number: true,
						 minlength: 10
						
                     },
					 account_name: {
                         required: true
						
                     },
					 bank_name: {
                         required: true
						
                     },
					 branch: {
                         required: true
						
                     },
					 price: {
                         required: true,
						 number: true
						
                     },
					 retailprice: {
						 number: true,
						
                     },
					 title: {
                         required: true
						
                     },
					 item_name: {
                         required: true
                     }
					 
                 }
             });
			
		});
		
		//$.fn.datepicker.defaults.format = "dd-mm-yyyy";
		  
		$(".select2_demo_1").select2();
		
		
		
        </script>
  </body>
</html>
