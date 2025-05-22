<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get(url: 'http://localhost:8080/mahasiswa');
        if ($response->successful()) {
            $mahasiswa = $response->json();
            return view(view: 'data_mahasiswa', data: ['mahasiswa' => $mahasiswa]);
        }
        return view(view: 'data_mahasiswa', data: ['mahasiswa' => [], 'error' =>'Gagal mengambil data mahasiswa']);
    }
    
    public function create() //untuk menampilkan form tambah
    {
        $response = Http::get('http://localhost:8080/mahasiswa'); // Sesuaikan endpoint API user
    
        if ($response->successful()) {
            $mahasiswa = $response->json();
            return view('tambah_mahasiswa', compact('mahasiswa'));
        }
    
        return view('tambah_mahasiswa', ['mahasiswa' => []])->withErrors(['msg' => 'Gagal mengambil data mahasiswa']);
    }
    public function store(Request $request) {
    // Validasi data input dulu (optional tapi direkomendasikan)
    $request->validate([
        'nama' => 'required|string',
        'nim' => 'required|string',
        'email' => 'required|email',
        'prodi' => 'required|string',
    ]);

    // Kirim data ke backend CodeIgniter dengan POST JSON (tanpa asForm())
    $response = Http::post('http://localhost:8080/mahasiswa', [
        'nama' => $request->nama,
        'nim' => $request->nim,
        'email' => $request->email,
        'prodi' => $request->prodi,
    ]);

    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Jika gagal, ambil pesan error dari backend (jika ada)
    $error = $response->json('messages.error') ?? 'Gagal menambahkan mahasiswa';
    return back()->withErrors(['msg' => $error])->withInput();
}
public function edit($nim)
{
    // Ambil data mahasiswa berdasarkan NIM
    $response = Http::get("http://localhost:8080/mahasiswa/{$nim}");

    // Periksa apakah berhasil
    if ($response->successful()) {
        $mahasiswa = $response->json();
        return view('edit_mahasiswa', compact('mahasiswa'));
    }

    return redirect()->route('mahasiswa.index')
        ->withErrors(['msg' => 'Gagal mengambil data mahasiswa']);
}
public function update(Request $request, $nim)
{
    // Validasi form
    $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|numeric',
        'email' => 'required|email',
        'prodi' => 'required|string|max:255',
    ]);

    // Kirim data ke backend API
    $response = Http::put("http://localhost:8080/mahasiswa/{$nim}", [
        'nama' => $request->nama,
        'nim' => $request->nim,
        'email' => $request->email,
        'prodi' => $request->prodi,
    ]);

    // Cek hasil update
    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    // Jika gagal
    return back()->withErrors(['msg' => 'Gagal memperbarui data mahasiswa'])->withInput();
}
public function destroy($nim)
    {
        $response = Http::delete("http://localhost:8080/mahasiswa/{$nim}");
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Dosen berhasil dihapus');
        }

        return redirect()->route('mahasiswa.index')->withErrors(['msg' => 'Gagal menghapus dosen']);
    }
}
