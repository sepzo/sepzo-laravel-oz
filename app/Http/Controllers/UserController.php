<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function getPaginatedUsers()
    {
        $users = User::paginate(10); 
        return response()->json($users);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');  
    }

     
    public function register(Request $request)
    {
         
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        
        $profile = new Profile([
             
            'user_id' => $user->id,  
            'bio' => 'This is a new user',  
             
        ]);

        
        $user->profile()->save($profile);

         
        return redirect()->route('user.profile', ['userId' => $user->id]);
    }

    public function login(Request $request)
    { 
        $credentials = $request->only('email', 'password');
 

        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            $request->session()->flash('success', 'Login successful');
            
            $request->session()->put('userId', $userId); 
            return redirect()->route('home');
            //return redirect()->route('user.profile', ['userId' => $userId]);
        } else { 
            
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->forget('userId');
        return redirect()->route('home');  
    }


    public function showUserProfile($userId)
    {
        
        $user = User::find($userId);

       
        if(!isset($user)) return redirect()->back()->with('error', 'User not found!');
        $profile = $user->profile;

         

        return view('user.profile', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = auth()->user(); 
        $profile = $user->profile;  

        return view('user.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user(); 
        $profile = $user->profile; 

        
        $user->update([
            'name' => $request->input('name')
        ]);

         
        $profile->update([
            'bio' => $request->input('bio'),
            'email' => $request->input('email')
        ]);

        if ($request->hasFile('profile_picture')) { 

           
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }
     
            $file = $request->file('profile_picture');

            
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/profile_pictures', $fileName);
     
            $profile->update([
                'profile_picture' => $fileName
            ]);
        }
    

        return redirect()->route('user.edit')->with('success', 'User Profile updated successfully');
    }

     
}