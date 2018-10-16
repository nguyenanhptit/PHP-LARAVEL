<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; 
//use Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Excel;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$categories= Category::all();
        $categories= Category::paginate(5);
        return view('category.index',compact('categories'));
        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->all()); 
       return back();
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
    public function update(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $category = Category::findOrFail($request->category_id);
        $category->delete($request->all());
        return back();
    }

     public function search(Request $request)
    {

        $categories= Category::all();
        $search = $request->get('search');
       
       $category= DB::table('categories')->where('title','like', "%{$search}%")->paginate(5);
    
      return view('category.index')->with('categories', $category);

    } 
    public function excel()
    {
     $categories = DB::table('categories')->get()->toArray();
     $categories_array[] = array('title', 'description');
     foreach($categories as $cat)
     {
      $categories_array[] = array(
       'title'  => $cat->title,
       'description'   => $cat->description,
       
      );
     }
     Excel::create('test', function($excel) use ($categories_array){
      $excel->setTitle('test');
      $excel->sheet('test', function($sheet) use ($categories_array){
       $sheet->fromArray($categories_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }
}

