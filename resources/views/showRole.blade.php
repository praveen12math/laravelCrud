
@extends('layouts.app')

@section('content')

<div class="row mt-5">
    <div class="col-6 mx-auto">
    <div class="card bg-dark">
  <div class="card-body">    
    <h4 class="card-text">Id: {{$data->id}}</h4>
    <h4 class="card-text">Role: {{$data->role}}</h4>

  </div>
</div>
    </div>
</div>

@endsection