<?php

namespace App\Http\Controllers;
use App\Author;
use File;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin');
    }
	
	function seoUrl($string) {

		$string = trim($string); // Trim String

		$string = strtolower($string); //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )

		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);  //Strip any unwanted characters

		$string = preg_replace("/[\s-]+/", " ", $string); // Clean multiple dashes or whitespaces

		$string = preg_replace("/[\s_]/", "-", $string); //Convert whitespaces and underscore to dash

		return $string;

	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $authors = Author::oldest()->paginate(5);

        return view('authors.index',compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
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
            'address' => 'required',
			'phone' => 'required',
        ]);
		
		$data['seourl'] = $this->seoUrl($request->name);
        Author::create($data);
        return redirect()->route('authors.index')
                        ->with('success','one item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //return view('authors.show',compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Author $author)
    {
		$data = $request->all();
		
        request()->validate([
            'name' => 'required',
            'address' => 'required',
			'phone' => 'required',
        ]);
		$data['seourl'] = $this->seoUrl($request->name);
        $author->update($data);
		
		return redirect()->route('authors.index')
                         ->with('success','Product updated successfully');
    }
   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
		$author->update(['author_status'=>0]);
        return redirect()->route('authors.index')
                        ->with('success','Product deleted successfully');   
    }
}
