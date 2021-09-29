<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelCategory;
use Illuminate\Support\Facades\DB;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = ModelCategory::paginate(10);
        $keywordName = $request->get('keywordName');
        if($keywordName){
            $category = ModelCategory::where("name", "like", "%$keywordName%")->paginate(10);
        }
        return view('category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.create');
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
        $nameCategory = $request->get('name');
        $createBy     = \Auth::id();
        $slug         = \Str::slug($nameCategory, '-'); 
        if($request->file('image')){
            $image_path = $request->file('image')->store('images/categorys', 'public');

            DB::table('category')->insert([
                'name'      => $nameCategory,
                'slug'      => $slug,
                'image'     => $image_path,
                'created_by' => $createBy,
                'created_at'=> date("Y-m-d H:i:s"),
                'updated_at'=> date("Y-m-d H:i:s"),
            ]);

            return redirect()->route('category.index')->with('status', 'sukses');
        }else{
            return redirect()->route('category.create')->with('status', 'gambar invalid');
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
        $category = ModelCategory::select('id', 'slug','name', 'image')->findOrFail($id)->first();

        return view('category.detail', compact('category'));
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
        $category = ModelCategory::select('id', 'slug','name', 'image')->findOrFail($id);

        return view('category.edit', compact('category'));
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
        $nameCategory = $request->get('name');
        $updateBy     = \Auth::id();
        $slug         = \Str::slug($nameCategory, '-'); 
        if($request->file('image')){
            $data_category = ModelCategory::findOrFail($id);
            if(file_exists(storage_path('app/public/' . $data_category->image))){
                \Storage::delete('public/'.$data_category->image);
            }
            $image_path = $request->file('image')->store('images/categorys', 'public');
            DB::table('category')->where('id', $id)->update([
                'name'      => $nameCategory,
                'slug'      => $slug,
                'image'     => $image_path,
                'updated_by'=> $updateBy,
                'updated_at'=> date("Y-m-d H:i:s"),
            ]);

            return redirect()->route('category.index')->with('status', 'sukses');
        }else{
            DB::table('category')->where('id', $id)->update([
                'name'      => $nameCategory,
                'slug'      => $slug,
                'updated_by'=> $updateBy,
                'updated_at'=> date("Y-m-d H:i:s"),
            ]);
            return redirect()->route('category.index')->with('status', 'sukses');
        }
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
        ModelCategory::where('id', $id)->update([
            'deleted_by'      => \Auth::id(),
        ]);
        $data_category = ModelCategory::findOrFail($id);

        $data_category->delete();

        return redirect()->route('category.index')->with('status', 'Berhasil Hapus');
    }

    public function trash(Request $request){
        $category = ModelCategory::onlyTrashed()->paginate(10);
        $keywordName = $request->get('keywordName');
        if($keywordName){
            $category = ModelCategory::where("name", "like", "%$keywordName%")->onlyTrashed()->paginate(10);    
        }

        return view('category.trash', compact('category'));
    }

    public function detailTrash($id){
        // $category = DB::table('category')->where('id', $id)->first();
        $category = ModelCategory::withTrashed()->findOrFail($id);
        // dd($category);
        return view('category.detailTrash', compact('category'));
    }
    
    public function removeTrash($id){
        
        $category = ModelCategory::withTrashed()->findOrFail($id);
        
        if(file_exists(storage_path('app/public/' . $category->image))){
            \Storage::delete('public/'.$category->image);
        }
        $category->forceDelete();
        
        return redirect()->route('category.index')->with('status', 'Category permanently deleted');

    }

    public function restoreTrash($id){
        $category = \App\Models\ModelCategory::withTrashed()->findOrFail($id);
        if($category->trashed()){
            ModelCategory::where('id', $id)->withTrashed()->update([
                'deleted_by'      => NULL,
            ]);
            $category->restore();
        } else {
            return redirect()->route('category.index')->with('status', 'Category is not in trash');
        }
        return redirect()->route('category.index')->with('status', 'Category successfully restored');

    }
}
