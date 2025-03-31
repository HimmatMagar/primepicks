<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->where('user_id', Auth::id()) -> get();
        return view('main/sellProduct', compact('products'));
        // return $products;
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main/sellProduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
       try {
         # Upload image
        //  if($request -> hasFile('image')) {
            $img = $request -> file('image');
            $ext = $img -> getClientOriginalExtension();
            $image = time() . '.' . $ext;
            $img -> storeAs('uploads', $image, 'public');
        //  }
 
         #For category id
         $category_id = Category::where('category', $request->input('category'))->first();
         $id = optional($category_id)->id;

            // dd($request -> all());

         Product::create([
             'name' => $request->input('name'),
             'description' => $request->input('description'),
             'price' => $request->input('price'),
             'stock' => $request->input('stock'),
             'image' => $image,
             'user_id' => Auth::id(),
             'category_id' => $id,
         ]);

         return back() -> with('status', 'Add product successfully');
       } catch (\Throwable $th) {
            return back() -> withErrors($th -> getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('main.editProduct', compact('product'));
        // return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
{
    try {
        $product = Product::findOrFail($id);

        $category = $request->input('category');
        $category_id = Category::where('category', $category)->first();

        if ($category_id) {
            $product->category_id = $category_id->id;
        } else {
            return back()->withErrors(['category' => 'The selected category is invalid.']);
        }
        if ($request->hasFile('image')) {
            $imagePath = public_path('storage/uploads/') . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->storeAs('uploads', $imageName, 'public');
            $product->image = $imageName;
        }
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();

        return redirect()->route('product.index')->with('status', 'Update successfully');
    } catch (\Throwable $th) {
        return back()->withErrors(['error' => $th->getMessage()]);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $path = public_path('storage/uploads/') . $product->image;
        if(file_exists($path)) {
            unlink($path);
        }
        $product->delete();
        return redirect()->route('product.index') -> with('status', 'Delete successfully');
    }
}
