<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\customerExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Kreait\Firebase\Factory;
use PDF;


class CustomerController extends Controller
{
     public function connect()
    {
        $firebase = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }

    public function updateStatus(Request $request, string $id)
{
    $newStatus = $request->input('status'); // Ambil status baru dari form

    // Lakukan sesuai logika Anda, misalnya update ke database atau Firebase
    // Contoh menggunakan Firebase
    $this->connect()->getReference('formData/' . $id . '/Status')->set($newStatus);

    return back()->with('success', 'Status berhasil diperbarui');
}


    public function index()
    {
        $title = "customer";
        $customers = $this->connect()->getReference('formData')->getSnapshot()->getValue();
        // confirmDelete();

        // $productcategories = ProductCategory::all();

        return view('Customer.index', [
            'title' => $title,
            'customers' => $customers,
            // 'productcategories' => $productcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request)
    {

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
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->connect()->getReference('formData/' . $id)->remove();

        // Alert::success('Sukses Menghapus', 'Sukses Menghapus Pelanggan.');
        return back();

    }


    public function exportExcelCustomer()
    {
        return Excel::download(new customerExport, 'customer.xlsx',);

        // return Excel::download(new ProductExport, 'Product.xlsx');
    }

    public function exportPdfCustomer()
{
    $customer = Customer::all();

    $pdf = PDF::loadView('customer.export_pdf', compact('customer'));

    return $pdf->download('customer.pdf');
}


}
