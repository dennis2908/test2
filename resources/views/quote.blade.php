@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <button type="button" onclick="showModalSave()" data-toggle="modal" data-target="#ModalData" class="btn btn-primary btn-sm">
                <svg width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
</svg> Add Company</button>

@stop

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<table class="table table-bordered quote">
        <thead>
            <tr>
                <th>No</th>
				<th>Action</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
<div class="modal fade" id="ModalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel"><svg width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
</svg> Add Company</h5><div class="spinner-grow text-primary ml-2" role="status">
  <span class="sr-only"></span>
</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <div class="alert alert-success print-success-add-data-msg" style="display:none">

				<ul></ul>

		</div>
		<div class="alert alert-danger print-error-add-data-msg" style="display:none">

				<ul></ul>

		</div>
        <form enctype="multipart/form-data" id="DataForm" action="">
		  <div class="form-group">
		    <input type="hidden" class="form-control" id="id" name="id" />
		    <label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" minlength="3" required />
			<small class="form-text text-muted">Enter Company Name</small>
		  </div>
		  <div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required />
			<small id="emailHelp" class="form-text text-muted">Enter Company Email</small>
		  </div>
		  <div class="form-group">
			<label for="name">Logo</label>
			<input class="form-control" id="logo" name="logo" type="file" required />
			<small class="form-text text-muted">Upload Company Logo</small>
		  </div>
		  <div class="form-group">
			<label for="name">Website</label>
			<input type="url" class="form-control" id="website" name="website" minlength="3" required />
			<small class="form-text text-muted">Enter Company Website</small>
		  </div>
		  <button type="submit" id="btn_sub" class="btn btn-primary"> </button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg width="14" height="14" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
</svg> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="CompanyModal" tabindex="-1" aria-labelledby="CompanyModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex justify-content-end col-xl-11" id="CompanyModalTitle"></h5>
        <button type="button" class="close close_del" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="spinner-grow text-primary ml-2" role="status">
  <span class="sr-only"></span>
</div>
          <div class="row" >
			  <div class="d-flex justify-content-center col-xl-12"><img id="company_logo" src="" alt="" class="m-5" width="150" height="150"/></div>
			  <div class="col">
				<label class="form-label">Company Name</label>
				<label class="form-control mb-4 company_name"></label>
				<label class="form-label">Company Website</label>
				<label class="form-control mb-4 company_website"></label>
				<label class="form-label">Company Email</label>
				<label class="form-control company_email"></label>
			  </div>	
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeDelMdl" data-dismiss="modal"><svg width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
</svg> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Confirmation</h5><div class="spinner-grow text-primary ml-2" role="status">
  <span class="sr-only"></span>
</div>
        <button type="button" class="close close_del" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body DeleteModal">
       
      </div>
      <div class="modal-footer">
	    <button type="button" onclick="DeleteProceed()" class="btn btn-danger"><svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> Proceed</button>
        <button type="button" class="btn btn-secondary closeDelMdl" data-dismiss="modal"><svg width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
</svg> Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="container" style="width:2000px;margin-left:-35px;margin-right:20px;background-color:aliceblue">
    <h3>Company List</h3>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
				<th>Action</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body> 
<script src="{{ asset('js/1.9.1.jquery.js') }}"></script>  
<script src="{{ asset('js/1.19.0.jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
let type="";
let id_delete = "";
$(function() {
	 $('.spinner-grow').css('display','none');
	 $('.content-header').css({"width": "1128px", "background-color": "aliceblue"});
	 $('.navbar-expand').css({"width": "1128px", "background-color": "aliceblue"});
	 $('.dropdown-toggle').css({"margin-left": "-150px"});
	 $.noConflict();
  var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : "{{ route('company.index') }}",
            type: 'GET',
            data: function (d) {
				 let itemCss = $(".content-wrapper").css("height");
				 console.log(itemCss);
				 $('.sidebar-dark-primary').css({"height": 2*itemCss});
            }
           },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
            {data: 'logo', name: 'logo'},
            {data: 'website', name: 'website'}
        ],
		columnDefs: [
			{ "width": 20, "targets": [0] },
			{ "width": 700, "targets": [1] },
			{ "width": 100, "targets": [2,4] },
			{
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<h5><span class="badge badge-pill badge-dark">'+data+'</span></h5>';
                },
                "targets": [2,3]
            },
			{
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<h5><a target="_blank" href="'+data+'"><span class="badge badge-pill badge-dark">'+data+'</span></h5>';
                },
                "targets": [5]
            },
			{
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
					let location = "uploads/"+data;
                    return '<h5><span class="badge badge-pill badge-dark"><img width="50" height="50" src= "{{ asset('') }}'+location+'" /></span></h5>';
                },
                "targets": [4]
            }
		],
		autoWidth: false
    });
	
	$("#DataForm").submit(function(e) {
		$(".print-error-add-data-msg").css('display','none');
		$(".print-success-add-data-msg").css('display','none');
	
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var form = $(this);
		var formData = new FormData(this);

		var url = form.attr('action');
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if(type==="PUT")
			formData.append('_method', 'PUT');
		
		
		$.ajax({
			   type: "POST",
			   url: url,
			   data: formData, // serializes the form's elements.
			   beforeSend: function() {
					$('.spinner-grow').css('display','block');
			   },
			   error: function (err) {
				   let errors = ['Duplicate Email. Please Enter Another Email'];
				   printErrorMsg(errors);
				   $('.spinner-grow').css('display','none');
					
			   },
			   success: function(data)
			   {
				    //alert(data); // show response from the php script.
				    if($.isEmptyObject(data.error)){
						
						$('.yajra-datatable').DataTable().ajax.reload(null, false );

                     	let success = [data.success];
						printSuccessMsg(success);
						

                    }else{
						
						console.log(data.error);

                        printErrorMsg(data.error);

                    }
					$('.spinner-grow').css('display','none');
			   },
			   cache: false,
			   contentType: false,
			   processData: false
			 });
			 
			 
		
	   });
	
	  function printErrorMsg (msg) {

            $(".print-error-add-data-msg").find("ul").html('');

            $(".print-error-add-data-msg").css('display','block');

            $.each( msg, function( key, value ) {

                $(".print-error-add-data-msg").find("ul").append('<li>'+value+'</li>');

           });

          }
		  
    function printSuccessMsg (msg) {

            $(".print-success-add-data-msg").find("ul").html('');

            $(".print-success-add-data-msg").css('display','block');

            $.each( msg, function( key, value ) {

                $(".print-success-add-data-msg").find("ul").append(value);

           });

          }
	
	
	 });
	 
	 
	 
	 function showModalSave(){
		 let btnsub = '<svg width="16" height="16" fill="currentColor" class="bi bi-check-lg m-2" viewBox="0 0 16 16">';
		 btnsub += '<path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>';
		 btnsub +='</svg>Add Data';
		 $("#btn_sub").html(btnsub);
		 let formTitle = '<svg width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">';
		 formTitle += '<path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>';
		 formTitle += '</svg> Add Company</h5>';
		 $("#formModalLabel").html(formTitle);
		 $("#DataForm").attr('action',"{{route('company.store')}}");
		 $("#DataForm").trigger("reset");
		 $(".print-error-add-data-msg").css('display','none');
		 $(".print-success-add-data-msg").css('display','none');
		 type = "POST";
	//	$('#ModalNewData').modal('show'); 
	 }
	
	function showModalEdit(id,name,website,email){
		 
		 let btnsub = '<svg width="16" height="16" fill="currentColor" class="bi bi-check-lg m-2" viewBox="0 0 16 16">';
		 btnsub += '<path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>';
		 btnsub +='</svg>Edit Data';
		 $("#btn_sub").html(btnsub);
		 let formTitle = '<svg width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">';
		 formTitle += '<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>';
		 formTitle += '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg> ';
		 formTitle += '<path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>';
		 formTitle += '</svg> Edit Company</h5>';
		 $("#formModalLabel").html(formTitle);
		 var url = '{{ route("company.update", ":id") }}';
		 url = url.replace(':id', parseInt(id));
		 $("#DataForm").attr('action',url);
		 $("#DataForm").trigger("reset");
		 $(".print-error-add-data-msg").css('display','none');
		 $(".print-success-add-data-msg").css('display','none');
		 console.log(id);
		 console.log(name);
		 $("#DataForm #id").val(parseInt(id));
		 $("#DataForm #name").val(name);
		 $("#DataForm #email").val(email);
		 $("#DataForm #website").val(website);
		 type = "PUT";
	//	$('#ModalNewData').modal('show'); 
	}
	
	function showModalDelete(id){
		id_delete = id;
		$('.DeleteModal').text("Do want to delete company id = "+id+" ?")
	}
	
	function showModalCompany(id){
		var url = '{{ route("company.show", ":id") }}';
		url = url.replace(':id', parseInt(id));
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax(
		{
			url: url,
			type: 'GET', // replaced from put
			dataType: "JSON",
			data: {
				"id": parseInt(id) // method and token not needed in data
			},
			beforeSend: function() {
					$('.spinner-grow').css('display','block');
			},
			error: function (err) {
				   $('.spinner-grow').css('display','none');
					
			},   
			success: function (response)
			{
				$('#CompanyModalTitle').text(response.data.name);
				$('.company_name').text(response.data.name);
				$('.company_email').text(response.data.email);
				$('.company_website').html("<a target='_blank' href='"+response.data.website+"'>"+response.data.website+"</a>");
				let location = "uploads/"+response.data.logo;
				$('#company_logo').attr('src',location);
				$('.spinner-grow').css('display','none');
			},	
			error: function(xhr) {
			 console.log(xhr.responseText); // this line will save you tons of hours while debugging
			// do something here because of error
		   }
		});
	}
	
	function DeleteProceed () {
		var url = '{{ route("company.destroy", ":id") }}';
		url = url.replace(':id', parseInt(id_delete));
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax(
		{
			url: url,
			type: 'DELETE', // replaced from put
			dataType: "JSON",
			data: {
				"id": parseInt(id_delete) // method and token not needed in data
			},
			beforeSend: function() {
					$('.spinner-grow').css('display','block');
			},
			error: function (err) {
				   $('.spinner-grow').css('display','none');
					
			},
			success: function (response)
			{
				$('.yajra-datatable').DataTable().ajax.reload(null, false );
				$('.closeDelMdl').trigger('click');
				$('.spinner-grow').css('display','none');
			},
			error: function(xhr) {
			 console.log(xhr.responseText); // this line will save you tons of hours while debugging
			// do something here because of error
		   }
		});

    }
	
	function getData () {
		$.ajax(
		{  
		    headers: {
				'Content-Type':'text/plain',
			    'Access-Control-Allow-Origin':'*'
			},
			url: "https://zenquotes.io/api/quotes?callback=jQuery19108468325307367264_1622966578619&_=1622966578620",
			method: 'GET', // replaced from put
			crossDomain: true,
		    dataType: 'jsonp',
			success: function (response)
			{
				console.log(JSON.parse(response));
			}
		});

    }
	getData();
</script>

@stop

@section('css')
    
@stop

@section('js')
    
@stop