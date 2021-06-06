@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <button type="button" onclick="window.location.reload();" data-toggle="modal" data-target="#ModalData" class="btn btn-primary btn-sm">
                 Reload Page</button>

@stop

@section('content')
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

?> 
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<table class="table table-bordered quote">
        <thead>
            <tr>
                <th>No</th>
				<th>Qoute</th>
            </tr>
        </thead>
        <tbody>
		@php 
		  $i=0;
		@endphp
		@if($jsonData)
		@foreach($jsonData as $v)
		
        <tr>
		    <td>{{ $i+1 }}</td>
            <td>{{ $jsonData[$i]['q'] }}</td>
        </tr>
		@php 
		  $i++;
		@endphp
    @endforeach
	@endif
        </tbody>
    </table>

@stop

@section('css')
    
@stop

@section('js')
    
@stop