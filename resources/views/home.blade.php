@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<h1>Hi There</h1>
@stop

@section('content')
<p>Hello {{ $user }}, welcome to Admin Panel</p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop