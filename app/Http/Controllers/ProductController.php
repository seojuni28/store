<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE Illuminate\Support\Str;
use App\Product;
use App\Category;
use File;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'descryption' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'image|mimes:jpg,png,jpeg'
        ]);

            $photo = null;

            if($request->hasFile('photo')){
                
                $photo = $this->saveFile($request->name,$request->file('photo'));
            }

            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'descryption' => $request->descryption,
                'stock' => $request->stock,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
                ]);

            return redirect()->route('product.index')->with('alert','' .$product->name.' Created Successfully');

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
        $categories = Category::all();
        $product = Product::findOrfail($id);
        return view('product.edit',compact('categories','product'));
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
        $this->validate($request,[
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'descryption' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'image|mimes:jpg,png,jpeg'
        ]);

        $product = Product::findOrfail($id);    

            if($request->hasFile('photo')){
                
                $photo = $this->saveFile($request->name,$request->file('photo'));

                $product->update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'descryption' => $request->descryption,
                    'stock' => $request->stock,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'photo' => $photo
                ]);
    
            }else{
                $product->update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'descryption' => $request->descryption,
                    'stock' => $request->stock,
                    'price' => $request->price,
                    'category_id' => $request->category_id
                ]);
    
            }            
            
        return redirect()->route('product.index')->with('alert','' .$product->name.' Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrfail($id);

        File::delete('img/products/'.$product->photo);

        $product->delete();

        return redirect()->back()->with('alert',''.$product->name.' Successfully deleted');

    }

    public function saveFile($name, $photo){
        $images = Str::slug($name) . time() . '.' .$photo->getClientOriginalExtension();
        $path = public_path('img/products');

        if(!File::isDirectory($path)){
            File::makeDirectoryPath($path, 0777, true, true);
        }

        Image::make($photo)->save($path.'/'.$images);

        return $images;
    }
}
