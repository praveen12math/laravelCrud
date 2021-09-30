@extends('layouts.app')

@section('content')

<form action="{{route('login-user')}}" method="post" class="col-8 mx-auto">

  @if(Session::has('fail'))
  <div class="alert alert-danger">{{Session::get('fail')}}</div>
  @endif

  @csrf

  <div class="mb-3 mt-5">
    <label class="form-label">Email/Username</label>
    <input type="email" name="email" class="form-control" placeholder="name@example.com">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
  </div>

  <a href="register" class="text-white" style="text-decoration:none">Don't have account? Click here</a>

  <button class="btn btn-success float-end">Login</button>


</form>

@endsection