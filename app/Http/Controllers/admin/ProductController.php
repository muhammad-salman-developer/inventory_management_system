<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $products = Product::with(['category', 'product_images'])

            // Search
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%'.$request->search.'%')
                        ->orWhere('description', 'LIKE', '%'.$request->search.'%');
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })

            ->latest()
            ->paginate(10);

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
    public function store(StoreProductRequest $request)
    {

        // Product saved
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Front Images saved
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

        // Back Images saved
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
            'product' => $product->load(['category', 'product_images']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        // Basic info update
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description ?? '',
            'price' => $request->price,
        ]);

        // if new images upload
        if ($request->hasFile('front_images')) {

            // old front images delete
            foreach ($product->product_images()->where('type', 'front')->get() as $image) {

                $path = public_path('storage/'.$image->image);

                if (file_exists($path)) {
                    unlink($path);
                }

                $image->delete();
            }

            // New images save
            foreach ($request->file('front_images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'type' => 'front',
                ]);
            }
        }

        // if new back images upload
        if ($request->hasFile('back_images')) {

            // old back images delete
            foreach ($product->product_images()->where('type', 'back')->get() as $image) {

                $path = public_path('storage/'.$image->image);

                if (file_exists($path)) {
                    unlink($path);
                }

                // Database  record deleted
                $image->delete();
            }

            // New back images save karo
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
