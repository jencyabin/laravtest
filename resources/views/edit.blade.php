@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" id="content">
                        <div id="left">
                            <div id="object1">
                                <strong>{{ __('Update User') }}</strong>
                            </div>
                            </div>
                            <div id="right">
                            <div id="object3">  <a href="{{ url('/list') }}" class="nav-link" id="addbtn">
                                {{ __('List Users') }}
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

                    <form method="POST"  action="{{ route('update_user') }}"  id="editUser_form" >

                        @csrf
                        @method('PUT')                     


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                            <input type="email" name="email"  value="{{$users->email}}" maxlength="50" class="form-control"  >
                            <input type="hidden" name="userid" id="userid" value="{{$users->id}}" class="form-control mb-2"/>    

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-3">
                                <input type="text" name="first_name" value="{{$fname}}" maxlength="30" class="form-control mb-2"/>    

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="last_name" value="{{$lname }}"  maxlength="30" class="form-control mb-2"/>    

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-3">


                                @if($users->gender == "male")
                                    <input type="radio"  id="option1" name="gender" value="male" checked  >  Male
                                @else
                                    <input type="radio"  id="option1" name="gender" value="male"   >  Male

                                @endif

                                @if($users->gender == "female")
                                    <input type="radio"  id="option2" name="gender" value="female" checked > Female
                                @else
                                    <input type="radio"  id="option2" name="gender" value="female"  > Female

                                @endif

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                            <div class="col-md-6">

                                    <select  class="form-select"  name="country" value="{{old('company_type')}}" id="country" >
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country) 
                                                    <option value="{{$country->id}}" {{$users->country_id == $country->id  ? 'selected' : ''}}> {{$country->name}} </option>
                                                    @endforeach 
                                        </select>  


                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                           
                        </div>                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
