<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subCategory')
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $subCategories = SubCategory::with('category')->get();

        return view('admin.products.create', compact('subCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')
                    ->where(fn ($q) => $q->where('sub_category_id', $request->sub_category_id))
            ],
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();

        return view('admin.products.edit', compact('product', 'subCategories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')
                    ->where(fn ($q) => $q->where('sub_category_id', $request->sub_category_id))
                    ->ignore($product->id)
            ],
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // 🔥 cegah hapus kalau masih ada item
        if ($product->items()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Product tidak bisa dihapus karena masih memiliki item.');
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil dihapus.');
    }
}