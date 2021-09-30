
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-11">

  </div>
  <div class="col">
    <a href="/logout" style="font-size:400%"><i class="fas fa-sign-out-alt text-danger"></i></a>
  </div>
</div>


<div class="row mt-5">
    <div class="col-6 mx-auto">
    <div class="card bg-dark">
  <div class="card-body">
    <h2 class="card-title text-center">{{$userData[0]->name}}</h2>
    <h4 class="card-text">User id: {{$userData[0]->id}}</h4>
    <h4 class="card-text">Email: {{$userData[0]->email}}</h4>
    <h4 class="card-text">Phone: {{$userData[0]->phone}}</h4>
    <h4 class="card-text">Role: {{$userData[0]->role}}</h4>

  </div>
</div>
    </div>
</div>

@endsection