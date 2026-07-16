<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category','product_images'])->latest()->paginate(10);

        $categories = Category::all();

        return view('admin.pages.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'front_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'back_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Product save karo
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Front Images save karo
        if ($request->hasFile('front_images')) {
            foreach ($request->file('front_images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'type' => 'front',
                ]);
            }
        }

        // Back Images save karo
        if ($request->hasFile('back_images')) {
            foreach ($request->file('back_images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'type' => 'back',
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
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
    public function edit(Product $product)
    {
         return response()->json([
        'success' => true,
        'product' => $product->load(['category', 'product_images'])
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'front_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'back_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Basic info update karo
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description ?? '',
            'price' => $request->price,
        ]);

        // Agar new images upload hui hain
        if ($request->hasFile('front_images')) {

            // Purani front images delete
            foreach ($product->product_images()->where('type', 'front')->get() as $image) {

                $path = public_path('storage/'.$image->image);

                if (file_exists($path)) {
                    unlink($path);
                }

                $image->delete();
            }

            // Nayi images save
            foreach ($request->file('front_images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'type' => 'front',
                ]);
            }
        }

        // Agar new back images upload hui hain
        if ($request->hasFile('back_images')) {

            // Purani back images delete karo
            foreach ($product->product_images()->where('type', 'back')->get() as $image) {

                $path = public_path('storage/'.$image->image);

                if (file_exists($path)) {
                    unlink($path);
                }

                // Database se record delete
                $image->delete();
            }

            // Nayi back images save karo
            foreach ($request->file('back_images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'type' => 'back',
                ]);
            }
        }

       return response()->json([
    'success' => true,
    'message' => 'Product updated successfully!',
    'product' => $product->load(['category', 'product_images']), 
]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->product_images as $image) {
            $img_path = public_path('storage/').$image->image;
            if (file_exists($img_path)) {
                @unlink($img_path);
            }
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
