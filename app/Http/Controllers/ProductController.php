<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\exports\ProductExport;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Response;
use Kreait\Firebase\Factory;
use Ramsey\Uuid\Uuid;
use PDF;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function connect()
    {
        $firebase = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }
    public function index()
{
    $pageTitle = 'Product';
    $products = $this->connect()->getReference('Product')->getSnapshot()->getValue();

    // Mendapatkan URL gambar dari Firebase Storage untuk setiap produk
    foreach ($products as $productId => $product) {
        $gambarName = $product['gambar'];

        // Mendapatkan referensi file gambar di Firebase Storage
        $firebaseStorage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();

        $bucket = $firebaseStorage->getBucket();
        $imageRef = $bucket->object("images/{$gambarName}.jpg");

        // Mendapatkan URL download untuk gambar tersebut
        $downloadUrl = $imageRef->signedUrl(new \DateTime('tomorrow'));

        // Menambahkan URL gambar ke dalam data produk
        $products[$productId]['gambar_url'] = $downloadUrl;
    }

    return view('Product.index', [
        'pageTitle' => $pageTitle,
        'products' => $products
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambahkan Product';
        // $categories = ProductCategory::all();
        $productCategories = $this->connect()->getReference('KategoriProduct')->getSnapshot()->getValue();

        return view('Product.create', [
            'pageTitle' => $pageTitle,
            // 'categories' => $categories
            'productCategories' => $productCategories,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->only(['product_code', 'kategoriproduct','namaproduct', 'harga', 'deskripsiproduct']);
        $productId = Uuid::uuid4()->toString();
        $productCategory = $this->connect()->getReference('KategoriProduct')->getChild($data['kategoriproduct'])->getValue();

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/products');
            $gambarName = pathinfo($gambarPath, PATHINFO_FILENAME);

            $firebaseStorage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();

        $bucket = $firebaseStorage->getBucket();
        $bucket->upload(file_get_contents(storage_path("app/{$gambarPath}")), [
            'name' => "images/{$gambarName}.jpg", // Sesuaikan dengan struktur penyimpanan Anda
        ]);


        // Simpan data kategori produk ke Firebase Realtime Database
        $this->connect()->getReference('Product/' . $productId)->set([
            'id' => $productId,
            'gambar' => $gambarName,
            'product_code' => $data['product_code'],
            'kategoriproduct' => $productCategory['namakategori'],
            'namaproduct' => $data['namaproduct'],
            'harga' => $data['harga'],
            'deskripsiproduct' => $data['deskripsiproduct'],

            // Add other fields you want to store
        ]);

        return redirect()->route('Product.index');

    }
    return redirect()->back()->with('error', 'Gambar tidak diunggah.');
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
        $this->connect()->getReference('Product/' . $id)->remove();
        return back();
    }

    public function getProduct(Request $request)
{

}





    public function exportExcel()
    {

    }


    }

