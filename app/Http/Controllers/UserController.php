<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use Response;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Auth\LoginController;
use Auth;


class UserController extends Controller
{
     
    // public function __construct() // for authentication 
    // {
    //     $this->middleware('auth');
    // }  
    
    public function index(){  //listing users
        $users = User::join('countries', 'users.country_id', '=', 'countries.id')
                        ->where('users.id', '!=',1)
                        ->select(['users.*', 'countries.name as country'])
                        ->orderBy('updated_at','desc')
                        ->paginate(2); 
        return view('home',['users'=>$users]);
    }

    public function add()  // display the new user registraion page
    {     
        $countries          = Country::orderBy('name')->get();     
        return view('add', ['countries'=>$countries]);
    }


    public function store(Request $request) // store the values of registered user to db
    {
       // dd($request);
        $validatedData = $request->validate([
                                            'first_name'     =>'required|max:50',
                                            'last_name'      =>'required|max:50',
                                            'gender'         =>'required',
                                            'country'        =>'required',
                                            'email'          =>'required|max:100|unique:users,email',
                                            'password'       =>['required',
                                                                // 'confirmed',
                                                                Password::min(8)
                                                                // ->mixedCase()
                                                                ->letters()
                                                                ->numbers()
                                                                ->symbols(),
                                                                ],
                                            'confirmpassword' =>'required|same:password',
                                            ]);
        $user               = new User();
        $user->name         = ucfirst($request->post('first_name')). " ". ucfirst($request->post('last_name'));// first letter to uppercase
        $user->email        = $request->post('email');
        $user->gender       = $request->post('gender');
        $user->country_id   = $request->post('country');
        if($request->post('newsletter') =='on')    {
            $user->newsletter  = 1;
        } 
        else{
            $user->newsletter  = 0; 
        }
        $user->password     = Hash::make($request->post('password'));             
     
        $user->save();
        return redirect(route('list'))->with('status', 'User Added  Successfully');
    }

    public function edit($id)   //load the edit page
    {    
        $users              = User::join('countries', 'users.country_id', '=', 'countries.id')
                                    ->where('users.id', $id)
                                    ->select(['users.*', 'countries.name as country'])
                                    ->first();
        $name               = explode(" ", $users->name);
        $fname              = $name[0];
        $lname              = $name[1];
        $countries          = Country::orderBy('name')->get();   //list all countries from db   
        $data               = ['users'=>$users,'fname'=>$fname,'lname'=>$lname,'countries'=>$countries];
       // dd($data);
       
        return view('edit')->with($data);
    }

    public function update(Request $request) //update the user details
    {
       // dd($request);
        $id                 = $request->userid; //dd($id);
        $user               = User::find($id);
        $user->name         = $request->first_name. " ". $request->last_name;
        $user->name         = ucfirst($request->post('first_name')). " ". ucfirst($request->post('last_name'));
        $user->email        = $request->post('email');
        $user->gender       = $request->post('gender');
        $user->country_id   = $request->post('country');       
      
        $user->update();
        return redirect(route('list'))->with('status', 'User Details Updated  Successfully');
    }

    public function destroy(User $id) //deleting the user
    {   // dd($id); 
        $id->delete(); 
        return redirect(route('list'))->with('status', 'User Deleted  Successfully');
  
    }

    public function checkEmail(Request $request) // check whether email id already exists in db
    { 
        if($request->user_id){
            $userid     = $request->user_id;
            $user       = User::find($userid);
            $email      = $user->email;
            $data       = $request->all(); // This will get all the request data.
    
            if($email != $data['email']){
    
                $userCount = User::where('email', $data['email']);
    
                if ($userCount->count()) {
                    return Response::json(array('msg' => 'true'));
                } else { 
                    return Response::json(array('msg' => 'false'));
                }
           }
            return Response::json(array('msg' => 'false'));
        }
        else{
            $data       = $request->all(); // This will get all the request data.    
            $userCount  = User::where('email', $data['email']);    
            if ($userCount->count()) {
                return Response::json(array('msg' => 'true'));
            } else { 
                return Response::json(array('msg' => 'false'));
            }           
        }         
    }

}
