<?php

namespace App\Http\Controllers;
use App\Book;
use File;
use Illuminate\Http\Request;
class BookController extends Controller
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
        $books = Book::oldest()->paginate(5);

        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
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
            'isbn' => 'required',
            'title' => 'required',			
			'price' => 'required',
			'description' => 'required',			
        ]);
		
		if($request->hasfile('filename'))
         {
			 $image = $request->file('filename');
			  $name =$image->getClientOriginalName();
              $image->move(public_path().'/images/', $name);
			$data['filename'] = $name;			
         }		 
		 $data['seourl'] = $this->seoUrl($request->title);
		 Book::create($data);
		
		//dd($data);
        return redirect()->route('books.index')
                         ->with('success','one item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Book $book)
    {
		$data = $request->all();
		
        request()->validate([
			'isbn' => 'required',
            'title' => 'required',
			'price' => 'required',
			'description' => 'required'
			
        ]);
		if($request->hasfile('filename'))
         {
			$path = public_path().'/images/'.$book->filename;

			File::delete($path);
			$image = $request->file('filename');
			$name =$image->getClientOriginalName();

            $image->move(public_path().'/images/', $name);
			$data['filename'] = $name;
			
         }
		$data['seourl'] = $this->seoUrl($request->title);
        $book->update($data);
		return redirect()->route('books.index')
                         ->with('success','Product updated successfully');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
		$path = public_path().'/images/'.$book->filename;
		File::delete($path);
		$book->delete();
		
        return redirect()->route('books.index')
                        ->with('success','Product deleted successfully');
					
    }

}