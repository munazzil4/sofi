<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
	
    public function getBooks()
	{
		$path = url('images');
		//dd($path);
		 $book = Book::select('id','isbn','title','price','description','seourl',DB::raw("concat('$path','/',filename) as filename"))->get();
		 //dd($book);
		return response()->json(['data'=>$book]);
		//dd($data1);
		
	}
	public function viewBooks()
    {
        return view('bookings.index');
    }
	
	public function addBooks()
	
	{
        return view('bookings.form');
    }
	
	public function saveBook(Request $request)
    {		
		$book = $this->validate($request, [
            'isbn' => 'required',
            'title' => 'required',			
			'price' => 'required',
			'description' => 'required'			
        ]);
			
		Book::create($book);
		
		//return ('bookings.form');
    }
	
	
}
