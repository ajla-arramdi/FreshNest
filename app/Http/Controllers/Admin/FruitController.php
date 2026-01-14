<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FruitController extends Controller
{
    public function index()
    {
        $fruits = Fruit::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.fruits.index', compact('fruits'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.fruits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:fruits,name',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'unit'        => ['required', Rule::in(['kg', 'pcs'])],
            'stock'       => 'required|numeric|min:0',
            'avg_weight'  => 'nullable|numeric|min:0.1',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika unit = kg, kosongkan avg_weight
        if ($request->unit === 'kg') {
            $data['avg_weight'] = null;
        }

        // Jika unit = pcs, avg_weight WAJIB
        if ($request->unit === 'pcs' && empty($request->avg_weight)) {
            return back()
                ->withErrors(['avg_weight' => 'Berat rata-rata wajib diisi untuk buah per buah.'])
                ->withInput();
        }

        // Upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/fruits'), $imageName);
            $data['image'] = $imageName;
        }

        Fruit::create($data);

        return redirect()->route('admin.fruits.index')
            ->with('success', 'Buah berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $fruit = Fruit::with('category')->findOrFail($id);
        return view('admin.fruits.show', compact('fruit'));
    }

    public function edit(string $id)
    {
        $fruit = Fruit::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.fruits.edit', compact('fruit', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $fruit = Fruit::findOrFail($id);

        $request->validate([
            'name'        => ['required', 'string', 'max:255', Rule::unique('fruits')->ignore($fruit->id)],
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'unit'        => ['required', Rule::in(['kg', 'pcs'])],
            'stock'       => 'required|numeric|min:0',
            'avg_weight'  => 'nullable|numeric|min:0.1',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika unit = kg, hapus avg_weight
        if ($request->unit === 'kg') {
            $data['avg_weight'] = null;
        }

        // Jika unit = pcs, avg_weight wajib
        if ($request->unit === 'pcs' && empty($request->avg_weight)) {
            return back()
                ->withErrors(['avg_weight' => 'Berat rata-rata wajib diisi untuk buah per buah.'])
                ->withInput();
        }

        // Upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($fruit->image && file_exists(public_path('images/fruits/' . $fruit->image))) {
                unlink(public_path('images/fruits/' . $fruit->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/fruits'), $imageName);
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $fruit->update($data);

        return redirect()->route('admin.fruits.index')
            ->with('success', 'Buah berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $fruit = Fruit::findOrFail($id);

        if ($fruit->image && file_exists(public_path('images/fruits/' . $fruit->image))) {
            unlink(public_path('images/fruits/' . $fruit->image));
        }

        $fruit->delete();

        return redirect()->route('admin.fruits.index')
            ->with('success', 'Buah berhasil dihapus.');
    }
}
