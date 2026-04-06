<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.sub_categories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                })
            ]
        ]);

        SubCategory::create($validated);

        return redirect()->route('admin.sub-categories.index')
            ->with('success', 'Sub Category berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();

        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')
                    ->where(fn ($q) => $q->where('category_id', $request->category_id))
                    ->ignore($subCategory->id)
            ]
        ]);

        $subCategory->update($validated);

        return redirect()->route('admin.sub-categories.index')
            ->with('success', 'Sub Category berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        // 🔥 cegah hapus kalau masih dipakai
        if ($subCategory->products()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Sub Category tidak bisa dihapus karena masih memiliki produk.');
        }

        $subCategory->delete();

        return redirect()->route('admin.sub-categories.index')
            ->with('success', 'Sub Category berhasil dihapus.');
    }
}