@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" >
            <div class="card">
                <div class="card-header" id="content">
                <div id="left">
                      <div id="object1">
                        <strong>{{ __('User Registration') }}</strong>
                      </div>
                    </div>
                    <div id="right">
                      <div id="object3">  <a href="{{ url('/list') }}" class="nav-link" id="addbtn">
                          {{ __('List Users') }}
                          </a>
                      </div>
                    </div> 
                
                </div>

                <div class="card-body"> <!-- status message displayed here-->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('store_user') }}" id="addUser_form" enctype="multipart/form-data"><!-- using namedd router in action  -->
                         @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                            <input type="email" name="email"  value="{{ old('email') }}" maxlength="50" class="form-control"  >
                            </div>
                        </div>                       

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> 
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control capsclass" id="password" />                                 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control mb-2"/>                                                                          
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                            <div class="col-md-3">
                                <input type="text" name="first_name" value="{{ old('first_name') }}" maxlength="30" class="form-control mb-2"/>    
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="last_name" value="{{ old('last_name') }}"  maxlength="30" class="form-control mb-2"/>   
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-3">
                                <input type="radio"  id="option1" name="gender" value="male" checked  >  Male
                            </div>
                            <div class="col-md-3">
                                <input type="radio"  id="option2" name="gender" value="female">  Female                                                                         
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                    <select  class="form-select" name="country" value="{{old('country')}}" id="country" >
                                            <option value="">Select Country</option>
                                                @foreach($countries as $country) 
                                                    <option value="{{$country->id}}"> {{$country->name}} </option>
                                                @endforeach  
                                    </select>
                            </div>                           
                        </div>
                        <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end"></label>
                            <div class="col-md-6">
                                <input type="checkbox" name="conditions"  id="termconditions" >
                                <label for="name" >I agree with terms and condition</label>
                            </div>                           
                        </div>

                        <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end"></label>
                            <div class="col-md-6">
                                <input type="checkbox" name="newsletter"  id="newsletter" >
                                <label for="name" >I want to receive the newsletter</label>
                            </div>                           
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-success btn-block" id="submit" value="Submit" disabled/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
