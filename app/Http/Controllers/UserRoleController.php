<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\Group;
class UserRoleController extends Controller

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
		$roles = DB::table('user_roles')->pluck('name','id')->toArray();		//dd($roles);		
        return view('roles.index',compact('roles'));     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {		
		return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/*//dd($request);
        $data = DB::table('user_roles')->pluck('name');
		//dd($data);
		$role=Role::create($data);		
        return redirect()->route('roles.index')
                         ->with('success','one role created successfully.');
    */
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('roles')
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
	   $role = Role::where('id',$id)->first();
	   $role->update(['name'=>$request->name]);	   
		return redirect()->route('roles.index')
                         ->with('success','Product updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$roles = DB::table('user_roles')->delete();
		return redirect()->route('roles.index')
                        ->with('success','Product deleted successfully');
    }
	
	public function getPermissions($role_id)
	{
		//dd($role_id);
		$permissions = Permission::oldest()->get();
		$ids=Group::where('role_id',$role_id)->pluck('permission_ids')->toArray();
		
		return view('roles.show',compact('permissions','ids'));				 
	}
	
	public function updatePermissions($id,Request $request)
	{			
		$permission_ids = $request->permission_ids;	
		
		$permissions = Group::where('role_id',$id)->pluck('permission_ids')->toArray();
		
		if($permission_ids == null or empty($permission_ids)) $permission_ids = [];
		
		$diff=array_diff($permissions,$permission_ids);
		//dd($diff);
		Group::whereIn('permission_ids',$diff)->where('role_id',$id)->delete();
		
		foreach($permission_ids as $per)
		{	
			$group = Group::where('role_id',$id)->where('permission_ids',$per)->first();
			
			if(!$group){
			$data['role_id']=$id;
			$data['permission_ids']=$per;			
			Group::create($data);					
			}			
		}
		return redirect('role/'.$id.'/permissions');
	}
}
