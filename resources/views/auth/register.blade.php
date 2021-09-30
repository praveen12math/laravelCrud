@extends('layouts.app')

@section('content')

<form action="{{route('register-user')}}" method="post" class="col-8 mx-auto">
@if(Session::has('success'))
  <div class="alert alert-success">{{Session::get('success')}}</div>
 @endif
@if(Session::has('fail'))
  <div class="alert alert-danger">{{Session::get('fail')}}</div>
 @endif

  @csrf

<div class="mb-3 mt-5">
  <label class="form-label">Name</label>
  <input type="text" class="form-control" placeholder="" name="name" value="{{old('name')}}">

  <span class="text-danger">@error('name') {{$message}} @enderror </span>
</div>

<div class="mb-3">
  <label class="form-label">Email address</label>
  <input type="email" class="form-control" placeholder="name@example.com" name="email" value="{{old('email')}}">

  <span class="text-danger">@error('email') {{$message}} @enderror </span>
</div>

<div class="mb-3">
  <label class="form-label">Phone</label>
  <input type="text" class="form-control" placeholder="1234567890" name="phone" value="{{old('phone')}}">
</div>

<div class="mb-3">
  <label class="form-label">Password</label>
  <input type="password" class="form-control" name="password" value="{{old('password')}}">

  <span class="text-danger">@error('password') {{$message}} @enderror </span>
</div>

<a href="login" class="text-white" style="text-decoration:none">Already have account? Click here</a>

<button class="btn btn-success float-end">Register</button>


</form>

@endsection