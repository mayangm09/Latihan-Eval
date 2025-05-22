<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Data Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-gray-100 shadow-lg flex flex-col">
      <a href="{{ route('homepage') }}" class="p-5 text-2xl font-semibold border-b border-gray-700 hover:bg-gray-700 transition">Home Page</a>
      <nav class="flex-1 p-5">
        <ul class="space-y-3">
           <!-- Navigasi ke halaman Dashboard -->
        <li>
        <a href="{{ route('homepage') }}" class="flex items-center gap-2 px-4 py-3 rounded-md hover:bg-gray-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z" />
        </svg>
        Dashboard
        </a>
        </li>
          <li>
            <a href="{{ route('dosen.index')}}" class="flex items-center gap-2 px-4 py-3 rounded-md hover:bg-gray-700 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.17 0 4.168.646 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Data Dosen
            </a>
          </li>
          <li>
            <a href="{{ route('mahasiswa.index')}}" class="flex items-center gap-2 px-4 py-3 rounded-md hover:bg-gray-700 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0l-3.5-3.5M12 20l3.5-3.5" />
              </svg>
              Data Mahasiswa
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow p-5 flex items-center justify-center border-b border-gray-200">
        <h1 class="text-gray-800 text-2xl font-semibold tracking-wide">Sistem Pengelolaan Data</h1>
      </header>

      <main class="p-6">
        <!-- Form Tambah Mahasiswa -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
          <h2 class="text-2xl font-bold mb-6 text-gray-700">Tambah Data Mahasiswa</h2>
          <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
              <label class="block mb-1 font-medium text-gray-700">Nama</label>
              <input type="text" name="nama" placeholder="Contoh: Karina" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block mb-1 font-medium text-gray-700">NIM</label>
              <input type="text" name="nim" placeholder="Contoh: 12345678" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block mb-1 font-medium text-gray-700">Email</label>
              <input type="email" name="email" placeholder="Contoh: karina@kampus.ac.id" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block mb-1 font-medium text-gray-700">Prodi</label>
              <input type="text" name="prodi" placeholder="Contoh: Teknik Informatika" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="pt-4">
              <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </main>

  </div>
</div>
</body>
</html>
