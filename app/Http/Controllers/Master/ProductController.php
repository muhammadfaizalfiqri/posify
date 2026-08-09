<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with('category');

    // Search
    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_produk', 'like', '%' . $request->search . '%')
            ->orWhere('nama_produk', 'like', '%' . $request->search . '%');

        });

    }

    // Filter kategori
    if ($request->filled('category_id')) {

        $query->where('category_id', $request->category_id);

    }

    // Filter status
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    // Filter stok menipis
    if ($request->filter == 'stok-menipis') {

        $query->where('stok', '<=', 10);

    }

    $products = $query
        ->orderBy('id','desc')
        ->paginate(8)
        ->withQueryString();

    $products = $query->orderBy('id', 'desc')->paginate(8);

    // agar query tetap terbawa saat pindah halaman
    $products->appends($request->all());

    $categories = Category::where('status', 1)->get();

    $jumlahkategori = Category::count();

    $stokMenipis = Product::where('stok', '<=', 10)->count();

    $totalProduk = Product::count();

    $jumlahSupplier = Supplier::count();

    return view('product.index', compact(
        'products',
        'categories',
        'jumlahkategori',
        'stokMenipis',
        'totalProduk',
        'jumlahSupplier',
    ));
}
    public function export(Request $request)
{
    $products = Product::with('category')
        ->when($request->search, function ($query) use ($request) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_produk', 'like', '%' . $request->search . '%');
        })
        ->when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
        ->when($request->status != '', function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->get();

    $response = new StreamedResponse(function () use ($products) {

        $handle = fopen('php://output', 'w');

        // Header CSV
        fputcsv($handle, [
            'Kode Produk',
            'Nama Produk',
            'Kategori',
            'Harga',
            'Stok',
            'Status'
        ]);

        foreach ($products as $product) {

            fputcsv($handle, [

                $product->kode_produk,
                $product->nama_produk,
                $product->category->nama_kategori,
                $product->harga,
                $product->stok,
                $product->status ? 'Aktif' : 'Tidak Aktif',

            ]);

        }

        fclose($handle);

    });

    $response->headers->set(
        'Content-Type',
        'text/csv'
    );

    $response->headers->set(
        'Content-Disposition',
        'attachment; filename="produk.csv"'
    );

    return $response;
}

    public function create()
{
    $categories = Category::where('status', true)->get();

    $jumlahkategori = Category::count();

    return view('product.create', compact(
        'categories',
        'jumlahkategori'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);
        $jumlahkategori = Category::count();

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }
    public function edit(Product $product)
{
    $categories = Category::where('status', true)->get();

    $jumlahkategori = Category::count();

    return view('product.edit', compact(
        'product',
        'categories',
        'jumlahkategori'
    ));
}
    public function update(Request $request, Product $product)
{
    $request->validate([
        'kode_produk' => 'required|unique:products,kode_produk,' . $product->id,
        'nama_produk' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
        'status'      => 'required|boolean',
    ]);

    $product->update([
        'kode_produk' => $request->kode_produk,
        'nama_produk' => $request->nama_produk,
        'category_id' => $request->category_id,
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
