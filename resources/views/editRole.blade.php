@extends('layouts.app')


@section('content')
<div class="col-10 mb-5">
    <a href="/user"> <button class="btn btn-danger float-end">Close</button> </a>
</div>

<form action="/updateRole" method="POST" class="mx-auto col-8">
@if(Session::has('successUpdateRole'))
      <div class="alert alert-success">{{Session::get('successUpdateRole')}}</div>
      @endif
      @if(Session::has('failUpdateRole'))
      <div class="alert alert-danger">{{Session::get('failUpdateRole')}}</div>
      @endif
    @csrf

    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="text" name="role" id="" class="form-control mb-4" value="{{$data->role}}">

    <div class="text-center mt-5">
        <button type="submit" class="btn btn-info">Save Changes</button>
    </div>
</form>

@endsection