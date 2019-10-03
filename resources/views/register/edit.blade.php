@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card border-left-primary">
    <div class="card-header">
      <div class="row">
        <div class="ml-1">
          <h3 class="display-4"><i class="fa fa-user-circle"></i> Edit Information</h3>
        </div>
        <div class="ml-auto mr-md-1">
          <a class="btn btn-default" href="{{route('register.index')}}"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
      </div>
    </div>
  	<div class="card-body">
  			<form id="editForm">
  				@method('PATCH')
  				@csrf

  				@include('partials.form')
  			</form>
  	</div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    $('#editForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'PUT',
            url: '{{url()->full()}}',
            data: $('#editForm').data,
        });
    });



});
</script>
@endsection