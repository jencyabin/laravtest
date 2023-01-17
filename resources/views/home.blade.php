@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" id="content">
                    <div id="left">
                      <div id="object1">
                        <strong>{{ __('Registered Users') }}</strong>
                      </div>
                    </div>
                    <div id="right">
                      <div id="object3">  <a href="{{ url('/') }}" class="nav-link" id="addbtn">
                              {{ __('Add New User') }}
                          </a>
                      </div>
                    </div>                     
                </div>
                  
                <div class="card-body">                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                  

                    <div class="card">                   
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped text-nowrap">
                              <thead>
                                <tr>
                                  <!-- <th>ID</th> -->
                                  <th class="color-black">Username</th> 
                                  <th class="color-black">Email</th>
                                  <th class="color-black">Gender</th>                                 
                                  <th class="color-black">Country</th> 
                                </tr>
                              </thead>
                              <tbody id="user_list"> 
                                  @if (!empty($users)  && $users->count())
                                      @foreach($users as $user)                                    
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->gender}}</td>
                                            <td>{{$user->country}}</td>
                                            <td>
                                                <a href="{{ route('edit_user',$user->id) }}">
                                                        <input type="image" class="edit_img" id="edituser"  src="{{asset('/image/edit.png')}}"  value="{{ $user->id }}"/>
                                                </a>
                                            </td> 
                                            <td>
                                                <input type="image" id="deleteuser"  class="edit_img"  src="{{asset('/image/delete.png')}}" value="{{ $user->id }}"/>
                                            </td>  
                                        </tr>
                                      @endforeach 
                                  @else
                                      <tr>
                                          <td>No Records Found </td>
                                      </tr>
                                  @endif                                      
                              </tbody>
                            </table> 
                            <div  style="height:50px;float: right;">
                                    {!! $users->links("pagination::bootstrap-4") !!}
                            </div>                                                 
                          </div>
                          <!-- /.card-body -->
                        </div>
                </div>
            </div>
        </div>
    </div>

 <!-- delete model -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content model-common-height">
      <div class="modal-header">
        <h5 class="modal-title">Delete User</h5>
        <!-- <button  type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <form action="" method="POST" id= "delete_form" class="d-inline-block">
      @csrf
      <div class="modal-body">
        <p id="confirm_message">Are you sure you want to delete this User?</p>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-success">Ok</button>
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end delete model -->
</div>
@endsection