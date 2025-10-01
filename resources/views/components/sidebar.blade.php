<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64
           bg-gradient-to-b from-gray-900 via-blue-900 to-gray-800
           backdrop-blur-md border-r border-blue-800/60 text-blue-50
           transform -translate-x-full md:translate-x-0
           transition-transform ease-in-out duration-500 shadow-2xl z-40">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-blue-800/40">
        <span class="flex items-center gap-3">
            <!-- Logo SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" viewBox="0 0 32 32" fill="currentColor">
                <circle cx="16" cy="16" r="14" class="text-blue-800" fill="currentColor" opacity="0.2"/>
                <rect x="9" y="14" width="14" height="8" rx="2" class="text-blue-500" fill="currentColor" opacity="0.7"/>
                <circle cx="16" cy="12" r="4" class="text-yellow-400" fill="currentColor"/>
                <path d="M12 22c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.7"/>
            </svg>
            <span class="text-2xl font-extrabold tracking-wide text-white select-none">SiswaTrack</span>
        </span>
        <button id="closeSidebar"
            class="md:hidden text-gray-300 hover:text-yellow-400
                   transition-transform transform hover:scale-110 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Menu -->
    <nav class="px-6 py-8 space-y-2">
        <a href="{{ route('siswa.index') }}"
           class="block px-5 py-3 rounded-xl text-base font-semibold tracking-wide
                  transition-all duration-300
                  {{ request()->routeIs('siswa.index') 
                      ? 'bg-blue-800/90 shadow-lg text-white border-l-4 border-yellow-400'
                      : 'hover:bg-blue-700/40 hover:text-white hover:pl-7' }}">
            Beranda
        </a>
        <a href="{{ route('siswa.create') }}"
           class="block px-5 py-3 rounded-xl text-base font-semibold tracking-wide
                  transition-all duration-300
                  {{ request()->routeIs('siswa.create')
                      ? 'bg-blue-800/90 shadow-lg text-white border-l-4 border-yellow-400'
                      : 'hover:bg-blue-700/40 hover:text-white hover:pl-7' }}">
            Tambah Siswa
        </a>
    </nav>
</aside>
