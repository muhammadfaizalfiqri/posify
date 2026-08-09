<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
{
    $query = Supplier::query();

    // Search
    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_supplier', 'like', '%' . $request->search . '%')
              ->orWhere('nama_supplier', 'like', '%' . $request->search . '%');

        });

    }

    // Filter Status
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    $suppliers = $query->latest()
                        ->paginate(8)
                        ->withQueryString();

    // ================= CARD =================

    $totalSupplier = Supplier::count();

    $supplierAktif = Supplier::where('status', 1)->count();

    $supplierNonaktif = Supplier::where('status', 0)->count();

    $supplierTerbaru = Supplier::latest()->first();

    return view('supplier.index', compact(
        'suppliers',
        'totalSupplier',
        'supplierAktif',
        'supplierNonaktif',
        'supplierTerbaru'
    ));
}

    public function create()
{
    $lastSupplier = Supplier::latest()->first();

    if ($lastSupplier) {
        $number = (int) substr($lastSupplier->kode_supplier, 3) + 1;
    } else {
        $number = 1;
    }

    $kode_supplier = 'SUP' . str_pad($number, 3, '0', STR_PAD_LEFT);

    return view('supplier.create', compact('kode_supplier'));
}

    public function store(Request $request)
{
    $request->validate([
        'kode_supplier' => 'required|unique:suppliers',
        'nama_supplier' => 'required',
        'kontak' => 'required',
        'email' => 'nullable|email',
        'alamat' => 'required',
        'status' => 'required|boolean',
    ]);

    Supplier::create($request->all());

    return redirect()
        ->route('suppliers.index')
        ->with('success', 'Supplier berhasil ditambahkan.');
}

    public function show(Supplier $supplier)
{
    return view('supplier.show', compact('supplier'));
}

    public function edit(Supplier $supplier)
{
    return view('supplier.edit', compact('supplier'));
}

    public function update(Request $request, Supplier $supplier)
{
    $request->validate([
        'kode_supplier' => 'required|unique:suppliers,kode_supplier,' . $supplier->id,
        'nama_supplier' => 'required|string|max:255',
        'kontak'       => 'required|string|max:20',
        'email'         => 'nullable|email',
        'alamat'        => 'required',
        'status'        => 'required|boolean',
    ]);

    $supplier->update([
        'kode_supplier' => $request->kode_supplier,
        'nama_supplier' => $request->nama_supplier,
        'kontak'       => $request->kontak,
        'email'         => $request->email,
        'alamat'        => $request->alamat,
        'status'        => $request->status,
    ]);

    return redirect()
        ->route('suppliers.index')
        ->with('success','Supplier berhasil diperbarui.');
}

    public function destroy(Supplier $supplier)
{
    $supplier->delete();

    return redirect()
        ->route('suppliers.index')
        ->with('success', 'Supplier berhasil dihapus.');
}

public function export()
{
    $fileName = 'suppliers_' . date('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$fileName}",
    ];

    $callback = function () {

        $file = fopen('php://output', 'w');

        // Header CSV
        fputcsv($file, [
            'Kode Supplier',
            'Nama Supplier',
            'Kontak',
            'Email',
            'Alamat',
            'Status'
        ]);

        // Data
        $suppliers = Supplier::orderBy('id')->get();

        foreach ($suppliers as $supplier) {

            fputcsv($file, [

                $supplier->kode_supplier,
                $supplier->nama_supplier,
                $supplier->kontak,
                $supplier->email,
                $supplier->alamat,
                $supplier->status ? 'Aktif' : 'Tidak Aktif',

            ]);

        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}