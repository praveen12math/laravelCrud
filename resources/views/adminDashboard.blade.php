@if(Session::get('userRole') == 'user')
{{redirect("/user")}}
@endif

@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-11">

  </div>
  <div class="col">
    <a href="/logout" style="font-size:400%"><i class="fas fa-sign-out-alt text-danger"></i></a>
  </div>

  <!-- @foreach($allUser as $user)
    <h3>{{$user->name}}</h3>
    @endforeach -->
</div>


<!-- DONE All User List Section -->
<div class="row text-white">
  <div class="col-10 mx-auto">
    <h2><span class="badge bg-success">All Users</span></h2>
    <hr>
    <table class="table text-white fs-5">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($allUser as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->phone}}</td>
          <!-- {{$user->role==1?"User":"Admin"}} -->
          <td><span class="badge bg-info text-dark">
              @foreach($allRole as $role)
              @if($role->id == $user->role)
              {{$role->role}}
              @break
              @endif
              @endforeach
            </span></td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">

             <a href="{{'showUser/'.$user->id}}"><button type="button" class="btn btn-success me-2">
            <i class="fas fa-eye"></i></button> </a>

              <a href="{{'update/'.$user->id}}"> <button type="button" class="btn btn-warning me-2">
                  <i class="fas fa-user-edit"></i></button></a>

              <a href="{{'deleteUser/'.$user->id}}"> <button type="button" class="btn btn-danger">
                  <i class="fas fa-trash"></i> </button> </a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>




<!-- DONE All User Role List Section -->
<div class="row text-white mt-5">
  <div class="col-10 mx-auto">

    <h2><span class="badge bg-success">All Role</span></h2>
    <hr>

    @if(Session::has('successDeleteRole'))
      <div class="alert alert-success">{{Session::get('successDeleteRole')}}</div>
      @endif
      @if(Session::has('failDeleteRole'))
      <div class="alert alert-danger">{{Session::get('failDeleteRole')}}</div>
      @endif

      @if(Session::has('successUpdateRole'))
      <div class="alert alert-success">{{Session::get('successUpdateRole')}}</div>
      @endif
      @if(Session::has('failUpdateRole'))
      <div class="alert alert-danger">{{Session::get('failUpdateRole')}}</div>
      @endif
      
    <table class="table text-white fs-5">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($allRole as $role)
        <tr>
          <td>{{$role->id}}</td>
          <td>{{$role->role}}</td>

          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{'seeRole/'.$role->id}}"> <button type="button" class="btn btn-success me-2">
            <i class="fas fa-eye"></i></button></a>
            
              <a href="{{'showRole/'.$role->id}}"> <button type="button" class="btn btn-warning me-2">
                  <i class="fas fa-user-edit"></i></button></a>

              <a href="{{'deleteRole/'.$role->id}}"> <button type="button" class="btn btn-danger">
                  <i class="fas fa-trash"></i> </button> </a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>


<!-- DONE Add User Section -->
<div class="row text-white mt-5">
  <div class="col-10 mx-auto fs-5">
    <h2><span class="badge bg-success">Add User</span></h2>
    <hr>

    <form action="/addUser" method="POST" class="mx-auto col-8">

      @if(Session::has('successAddUser'))
      <div class="alert alert-success">{{Session::get('successAddUser')}}</div>
      @endif
      @if(Session::has('failAddUser'))
      <div class="alert alert-danger">{{Session::get('failAddUser')}}</div>
      @endif

      @csrf


      <div class="row mb-4">
        <div class="col">
          <input type="text" name="name" id="" class="form-control" placeholder="Name" value="{{old('name')}}">
          <span class="text-warning">@error('name') {{$message}} @enderror </span>
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
          <span class="text-warning">@error('email') {{$message}} @enderror </span>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col">
          <input type="text" name="phone" id="" class="form-control" placeholder="Phone" value="{{old('phone')}}">
          <span class="text-warning">@error('phone') {{$message}} @enderror </span>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col">
          <input type="password" name="password" id="" class="form-control" placeholder="Password" value="{{old('password')}}">
          <span class="text-warning">@error('password') {{$message}} @enderror </span>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col">
          <select class="form-control" name="role" value="{{old('role')}}">
            <option selected>Select Role</option>
            @foreach($allRole as $role)
            <option value={{$role->id}}>{{$role->role}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="text-center mt-5">
        <button type="submit" class="btn btn-info text-white">Add</button>
      </div>
    </form>

  </div>
</div>




<!-- DONE Add Role Section -->
<div class="row text-white mt-5">
  <div class="col-10 mx-auto fs-5">
    <h2><span class="badge bg-success">Add Role</span></h2>
    <hr>

    <form action="/addRole" method="POST" class="mx-auto col-8">
      @if(Session::has('successAddRole'))
      <div class="alert alert-success">{{Session::get('successAddRole')}}</div>
      @endif
      @if(Session::has('failAddRole'))
      <div class="alert alert-danger">{{Session::get('failAddRole')}}</div>
      @endif

      @csrf

      <input type="text" name="role" class="form-control" placeholder="Role" value="{{old('role')}}">
      <span class="text-warning">@error('role') {{$message}} @enderror </span>

      <div class="text-center mt-5">
        <button type="submit" class="btn btn-info text-white">Add</button>
      </div>
    </form>

  </div>
</div>



@endsection