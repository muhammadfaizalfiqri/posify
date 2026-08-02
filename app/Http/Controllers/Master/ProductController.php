<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::orderBy("id","desc")->paginate(8);

    return view('product.index', compact('products'));
}

    public function create()
    {
        return view('product.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }
    public function edit(Product $product)
{
    return view('product.edit', compact('product'));
}
    public function update(Request $request, Product $product)
{
    $request->validate([
        'kode_produk' => 'required|unique:products,kode_produk,' . $product->id,
        'nama_produk' => 'required|string|max:255',
        'kategori'    => 'required|string|max:255',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
        'status'      => 'required|boolean',
    ]);

    $product->update([
        'kode_produk' => $request->kode_produk,
        'nama_produk' => $request->nama_produk,
        'kategori'    => $request->kategori,
        'harga'       => $request->harga,
        'stok'        => $request->stok,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}
public function destroy(Product $product)
{
    $product->delete();

    return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
}
public function show(Product $product)
{
    return view('product.show', compact('product'));
}
}
