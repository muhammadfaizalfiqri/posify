<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($query) use ($request) {

            $query->where('kode_kategori', 'like', '%' . $request->search . '%')
                ->orWhere('nama_kategori', 'like', '%' . $request->search . '%');

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('kategori.index', compact('categories'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:categories',
            'nama_kategori' => 'required|max:255',
            'status' => 'required|boolean',
        ]);

        Category::create($request->all());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Detail kategori
     */
    public function show(Category $category)
    {
        return view('kategori.show', compact('category'));
    }

    /**
     * Form edit kategori
     */
    public function edit(Category $category)
    {
        return view('kategori.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:categories,kode_kategori,' . $category->id,
            'nama_kategori' => 'required|string|max:255',
            'status'        => 'required|boolean',
        ]);

        $category->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'status'        => $request->status,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}