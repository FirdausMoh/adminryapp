<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Kreait\Firebase\Factory;

class ProductCategoriesController extends Controller
{

    public function connect()
    {
        $firebase = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }

    public function index()
    {
        $title = "Product Categories";
        $productcategories = $this->connect()->getReference('KategoriProduct')->getSnapshot()->getValue();
        // confirmDelete();

        // $productcategories = ProductCategory::all();

        return view('ProductCategories.index', [
            'title' => $title,
            'productcategories' => $productcategories,
            // 'productcategories' => $productcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambahkan Kategori Product';
        return view('ProductCategories.create', ['pageTitle' => $pageTitle]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['namakategori']);

        // Simpan data kategori produk ke Firebase Realtime Database
        $this->connect()->getReference('KategoriProduct')->push([
            'namakategori' => $data['namakategori'],

        ]);


        // Alert::success('Sukses Menambahkan', 'Sukses Menambahkan Kategori Produk.');
        return redirect()->route('ProductCategories.index');
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
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $productcategories = ProductCategory::find($id);
        $this->connect()->getReference('KategoriProduct/' . $id)->remove();
        return back();
    }
}
