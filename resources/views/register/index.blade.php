@extends('layouts.app')

@section('content')

 <ol class="breadcrumb">
    <li class="breadcrumb-item">
      	register
    </li>
    <li class="breadcrumb-item active">
      	<a href="{{route('register.create')}}">create</a>
    </li>
 </ol>

@endsection