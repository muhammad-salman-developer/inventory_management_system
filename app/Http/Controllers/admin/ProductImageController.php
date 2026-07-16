<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

// class ProductImageController extends Controller
// {
//     public function store(Request $request)
//     {
//         $request->validate([
//             'product_id' => 'required|exists:products,id',
//             'front-image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//             'back-image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         ]);
//         if ($request->hasFile('front-image')) {
//             foreach ($request->file('front-image') as $img) {
//                 $path = $img->store('products', 'public');
//                 ProductImage::create([
//                     'product_id' => $request->product_id,
//                     'image' => $path,
//                     'type' => 'front',
//                 ]);
//             }
//         }
//           if ($request->hasFile('back_images')) {
//             foreach ($request->file('back_images') as $image) {
//                 $path = $image->store('products', 'public');
//                 ProductImage::create([
//                     'product_id' => $request->product_id,
//                     'image'      => $path,
//                     'type'       => 'back'
//                 ]);
//             }
//         }
//            return response()->json([
//             'success' => true,
//             'message' => 'Images uploaded successfully!'
//         ]);
//     }
//      public function destroy(ProductImage $productImage)
//     {
       
//         Storage::disk('public')->delete($productImage->image);

        
//         $productImage->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'Image deleted successfully!'
//         ]);
//     }
// }
 
