<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(15);

        return view('admin.pages.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|unique:suppliers,email',
            'contact' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);
        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('suppliers.index')->with('success',
            'supplier created successfully');
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
   public function edit(Supplier $supplier)
{
    return response()->json([
        'success'  => true,
        'supplier' => $supplier
    ]);
}

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Supplier $supplier)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'nullable|email|unique:suppliers,email,' . $supplier->id,
        'contact' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'status'  => 'nullable|in:0,1',
    ]);

    $supplier->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'contact' => $request->contact,
        'address' => $request->address,
        'status'  => $request->status ?? 1,
    ]);

    return response()->json([
        'success'  => true,
        'message'  => 'Supplier updated successfully!',
        'supplier' => $supplier,
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'supplier deleted successfully!');
    }
}
