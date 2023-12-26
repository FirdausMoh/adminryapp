<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "form";
       // Mengambil data dari node 'pesanan'
    $forms = $this->connect()->getReference('formData')->getSnapshot()->getValue();



        return view('home', [
            'title' => $title,
        'forms' => $forms,
        ]);
    }
}
