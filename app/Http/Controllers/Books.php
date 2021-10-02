<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBook;

class Books extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $book = ModelBook::with('ModelCategory')->paginate(1);
        return view('book.list', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $new_book = new \App\Models\ModelBook;
        $new_book->title        = $request->get('title');
        $new_book->description  = $request->get('description');
        $new_book->author       = $request->get('author');
        $new_book->publisher    = $request->get('publisher');
        $new_book->price        = $request->get('price');
        $new_book->stock        = $request->get('stock');
        $new_book->status       = $request->get('save_action');
        $cover                  = $request->file('cover');
        if($cover){
           $cover_path = $cover->store('images/book', 'public');
           $new_book->cover = $cover_path;
       }
       $new_book->slug          = \Str::slug($request->get('title'));
       $new_book->created_by    = \Auth::user()->id;
       $new_book->save();
       $new_book->ModelCategory()->attach($request->get('categories'));

       if($request->get('save_action') == 'PUBLISH'){
           return redirect()->route('book.create')->with('status', 'Book saved as publish');
        }else{
            return redirect()->route('book.create')->with('status', 'Book saved as draft');
        }
       

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxSearch(Request $request){
       $keyword = $request->get('q');
       $categories = \App\Models\ModelCategory::where("name", "LIKE", "%$keyword%")->get();
       return $categories;
   }
}
