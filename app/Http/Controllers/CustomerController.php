<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('kode_customer', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_customer', 'like', '%' . $request->search . '%')
                  ->orWhere('telepon', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');

            });

        }

        $customers = $query->latest()->paginate(8);

        $totalCustomer = Customer::count();

        $customerTerbaru = Customer::latest()->first();

        $customerBulanIni = Customer::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count();

        return view('customer.index', compact(
            'customers',
            'totalCustomer',
            'customerTerbaru',
            'customerBulanIni'
        ));
    }

    public function create()
{
    return view('customer.create');
}

public function store(Request $request)
{
    $request->validate([
        'kode_customer' => 'required|unique:customers,kode_customer',
        'nama_customer' => 'required|string|max:255',
        'telepon'       => 'required|string|max:20',
        'email'         => 'nullable|email|max:255',
        'alamat'        => 'nullable|string',
    ]);

    Customer::create([
        'kode_customer' => $request->kode_customer,
        'nama_customer' => $request->nama_customer,
        'telepon'       => $request->telepon,
        'email'         => $request->email,
        'alamat'        => $request->alamat,
    ]);

    return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan.');
}

public function edit(Customer $customer)
{
    return view('customer.edit', compact('customer'));
}

public function update(Request $request, Customer $customer)
{
    $request->validate([
        'kode_customer' => 'required|unique:customers,kode_customer,' . $customer->id,
        'nama_customer' => 'required|string|max:255',
        'telepon'       => 'required|string|max:20',
        'email'         => 'nullable|email|max:255',
        'alamat'        => 'nullable|string',
    ]);

    $customer->update([
        'kode_customer' => $request->kode_customer,
        'nama_customer' => $request->nama_customer,
        'telepon'       => $request->telepon,
        'email'         => $request->email,
        'alamat'        => $request->alamat,
    ]);

    return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diperbarui.');
}

public function show(Customer $customer)
{
    return view('customer.show', compact('customer'));
}

public function destroy(Customer $customer)
{
    $customer->delete();

    return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus.');
}

public function export()
{
    $fileName = 'customers_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type'        => 'text/csv',
        'Content-Disposition' => "attachment; filename={$fileName}",
    ];

    $callback = function () {

        $file = fopen('php://output', 'w');

        // Header CSV
        fputcsv($file, [
            'Kode Customer',
            'Nama Customer',
            'Telepon',
            'Email',
            'Alamat',
            'Tanggal Dibuat'
        ]);

        // Data Customer
        Customer::orderBy('id')->chunk(100, function ($customers) use ($file) {

            foreach ($customers as $customer) {

                fputcsv($file, [
                    $customer->kode_customer,
                    $customer->nama_customer,
                    $customer->telepon,
                    $customer->email,
                    $customer->alamat,
                    $customer->created_at->format('d-m-Y H:i'),
                ]);

            }

        });

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}