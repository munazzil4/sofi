<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$roles = DB::table('user_roles')->pluck('name','id')->toArray();		
        $users = User::oldest()->paginate(5);
		//dd($roles,$users);
        return view('users.index',compact('users','roles'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = DB::table('user_roles')->pluck('name','id');
		//dd($roles);
		return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
        request()->validate([
           'name' => 'required|string|max:255',		   
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'user_role'=>'required'
        ]);
		
		$data = $request->all();
		
		$data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')
                        ->with('success','one item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
		$roles = DB::table('user_roles')->pluck('name','id');
         return view('users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
		
		 if(!empty($request->input('password')))
        {
            request()->validate([
			   'name' => 'required|string|max:255',			   
				'email' => 'sometimes|string|email|max:255|unique:users,email,'.$user->id,
				'password' => 'required|string|min:6|confirmed',
				'user_role'=>'required'
			]);
			$data = $request->all();
			
			$data['password'] = Hash::make($data['password']);
		
			$user->update($data);
			return redirect()->route('users.index')
                         ->with('success','Product updated successfully');
        }
		   request()->validate([
				'name' => 'required|string|max:255',
				'email' => 'sometimes|string|email|max:255|unique:users,email,'.$user->id,
				'user_role'=>'required'
			]);
			
			$data = $request->except('password','password_confirmation');			
			//dd($data);
			$user->update($data);
			//dd($data);
		   return redirect()->route('users.index')
							 ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
		$user->update(['user_status'=>0]);		        
        return redirect()->route('users.index')
                        ->with('success','Product deleted successfully');
    }

}
