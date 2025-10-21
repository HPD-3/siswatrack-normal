<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Contact Book') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind CSS via CDN (for DataTables Tailwind theme) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DataTables Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.css">
    
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 min-h-screen flex font-sans text-black">

<!-- Main -->
<div class="flex-1 flex flex-col md:ml-64 transition-all">
    
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Topbar -->
    <x-topbar />

    <!-- Content -->
    <main class="flex-1 p-6 relative z-0">

        <div class="bg-blue-800/30 backdrop-blur-lg rounded-2xl shadow-xl p-6 
                    overflow-visible border border-blue-700/40 
                    hover:shadow-2xl hover:border-blue-500/50 transition-all duration-300">
            @yield('content')
        </div>
    </main>
</div>

<script>
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenuDropdown = document.getElementById('userMenuDropdown');

    // Toggle sidebar mobile pakai toggle
    mobileMenuBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // Tombol close (khusus di sidebar header)
    closeSidebar?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
    });

    // Toggle dropdown user menu
    userMenuBtn?.addEventListener('click', (e) => {
        e.stopPropagation(); // biar gak langsung ketutup
        userMenuDropdown.classList.toggle('hidden');
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', (e) => {
        if (!userMenuBtn.contains(e.target) && !userMenuDropdown.contains(e.target)) {
            userMenuDropdown.classList.add('hidden');
        }
    });
</script>

<!-- jQuery (full version) -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!-- DataTables core JS -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<!-- DataTables Tailwind CSS integration -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.tailwindcss.js"></script>

<script type="text/javascript">
    // Inisialisasi DataTable dengan tema Tailwind
    document.addEventListener('DOMContentLoaded', function() {
        new DataTable('#myTable', {
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ditemukan data yang cocok",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
            // DataTables Tailwind theme will handle the DOM/layout
        });
    });
</script>
</body>
</html>



