<?php
namespace App\Http\Controllers;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
         $permissions = Permission::oldest()->get();
        return view('permissions.index',compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->all();		
         request()->validate([
            'name' => 'required',           
        ]);
        Permission::create($data);
        return redirect()->route('permissions.index')
                        ->with('success','one item created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$permission = Permission::where('id',$id)->first();
        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {		
        $data = $request->all();		
        request()->validate([
            'name' => 'required',
            'display_name'=>'required'
        ]);		
        $permission->update($data);
		
		return redirect()->route('permissions.index')
                         ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission,$id)
    {
        $permission->destroy($id);
        return redirect()->route('permissions.index')
                        ->with('success','Product deleted successfully'); 
    }
}
