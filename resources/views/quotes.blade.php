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

<table class="table table-bordered">
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
	
	function getData () {
		$.ajax(
		{
			url: "https://zenquotes.io/api/quotes",
			type: 'DELETE', // replaced from put
			dataType: "JSON",
			success: function (response)
			{
				dd(response);
				$('.table > tbody').html();
			},	
			error: function(xhr) {
			 console.log(xhr.responseText); // this line will save you tons of hours while debugging
			// do something here because of error
		   }
		});

    }
</script>

@stop

@section('css')
    
@stop

@section('js')
    
@stop