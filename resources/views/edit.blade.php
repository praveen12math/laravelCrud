@extends('layouts.app')


@section('content')
<div class="col-10 mb-5">
    <a href="/admin"> <button class="btn btn-danger float-end">Close</button> </a>
</div>

<form action="/update" method="POST" class="mx-auto col-8">
    @csrf

    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="text" name="name" id="" class="form-control mb-4" value="{{$data->name}}">
    <input type="text" name="email" id="" class="form-control mb-4" value="{{$data->email}}">
    <input type="text" name="phone" id="" class="form-control mb-4" value="{{$data->phone}}">
    <input type="text" name="role" id="" class="form-control" value="{{$data->role}}">

    <div class="text-center mt-5">
        <button type="submit" class="btn btn-info">Save Changes</button>
    </div>
</form>

@endsection