<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class DosenController extends Controller
{
    public function index()  //fungsi  menarik data
    {
        $response = Http::get(url: 'http://localhost:8080/dosen');
        if ($response->successful()) {
            $dosen = $response->json();
            return view(view: 'data_dosen', data: ['dosen' => $dosen]);
        }
        return view(view: 'data_dosen', data: ['dosen' => [], 'error' =>'Gagal mengambil data dosen']);
    }

    public function create() //untuk menampilkan form tambah
    {
        $response = Http::get('http://localhost:8080/dosen'); // Sesuaikan endpoint API user
    
        if ($response->successful()) {
            $dosen = $response->json();
            return view('tambah_dosen', compact('dosen'));
        }
    
        return view('tambah_dosen', ['dosen' => []])->withErrors(['msg' => 'Gagal mengambil data dosen']);
    }
    public function store(Request $request) { //menyimpan hasil data tambah
    // Validasi data input dulu (optional tapi direkomendasikan)
    $request->validate([
        'nama' => 'required|string',
        'nidn' => 'required|string',
        'email' => 'required|email',
        'prodi' => 'required|string',
    ]);

    // Kirim data ke backend CodeIgniter dengan POST JSON (tanpa asForm())
    $response = Http::post('http://localhost:8080/dosen', [
        'nama' => $request->nama,
        'nidn' => $request->nidn,
        'email' => $request->email,
        'prodi' => $request->prodi,
    ]);

    if ($response->successful()) {
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    // Jika gagal, ambil pesan error dari backend (jika ada)
    $error = $response->json('messages.error') ?? 'Gagal menambahkan dosen';
    return back()->withErrors(['msg' => $error])->withInput();
}
public function edit($nidn) //untuk membuka form edit
{
    // Ambil data dosen berdasarkan NIDN
    $response = Http::get("http://localhost:8080/dosen/{$nidn}");

    // Periksa apakah berhasil
    if ($response->successful()) {
        $dosen = $response->json();
        return view('edit_dosen', compact('dosen'));
    }

    return redirect()->route('dosen.index')
        ->withErrors(['msg' => 'Gagal mengambil data dosen']);
}

public function update(Request $request, $nidn) //fungsi dari edit data agar terupdate
{
    // Validasi form
    $request->validate([
        'nama' => 'required|string|max:255',
        'nidn' => 'required|numeric',
        'email' => 'required|email',
        'prodi' => 'required|string|max:255',
    ]);

    // Kirim data ke backend API
    $response = Http::put("http://localhost:8080/dosen/{$nidn}", [
        'nama' => $request->nama,
        'nidn' => $request->nidn,
        'email' => $request->email,
        'prodi' => $request->prodi,
    ]);

    // Cek hasil update
    if ($response->successful()) {
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    // Jika gagal
    return back()->withErrors(['msg' => 'Gagal memperbarui data dosen'])->withInput();
}
public function destroy($nidn) //fungsi delete
    {
        $response = Http::delete("http://localhost:8080/dosen/{$nidn}");
        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
        }

        return redirect()->route('dosen.index')->withErrors(['msg' => 'Gagal menghapus dosen']);
    }
}
