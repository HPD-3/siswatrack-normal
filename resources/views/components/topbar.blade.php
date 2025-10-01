<header class="relative z-50 flex items-center justify-between 
               bg-gradient-to-r from-gray-900 via-blue-900 to-gray-800 
               backdrop-blur-md shadow-lg p-4 rounded-b-2xl border-b border-gray-700">
    
    <!-- Tombol toggle untuk mobile -->
    <button class="md:hidden text-blue-100 text-2xl hover:text-yellow-400 
                   transition-transform transform hover:scale-110 flex items-center justify-center" 
            id="mobileMenuBtn" aria-label="Buka Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <rect x="4" y="6" width="16" height="2" rx="1" fill="currentColor" />
            <rect x="4" y="11" width="16" height="2" rx="1" fill="currentColor" />
            <rect x="4" y="16" width="16" height="2" rx="1" fill="currentColor" />
        </svg>
    </button>

    <!-- Search -->
    <form method="GET" action="{{ route('siswa.index') }}" class="flex-1 max-w-md mx-4">
        <div class="relative">
            <input type="search" name="search" value="{{ request('search') }}"
                   placeholder="Cari siswa..."
                   class="w-full rounded-lg bg-gray-800/70 border border-gray-600 px-4 py-2 pl-10
                          text-blue-100 placeholder-gray-400 
                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-300 
                          transition-all duration-300 hover:bg-gray-700/80 shadow-inner">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" fill="none"/>
                    <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
        </div>
    </form>

    <!-- User Menu -->
    <div class="relative z-50">
        <button id="userMenuBtn" 
                class="flex items-center gap-2 bg-blue-800/80 hover:bg-blue-700 text-white px-4 py-2 
                       rounded-xl font-semibold shadow-lg 
                       transition transform hover:scale-105 border border-gray-600 focus:outline-none"
                aria-haspopup="true" aria-expanded="false">
            <span class="inline-flex items-center justify-center rounded-full bg-blue-700/80 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="currentColor" class="text-blue-900" opacity="0.2"/>
                    <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    <path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="currentColor" stroke-width="1.5" fill="none"/>
                </svg>
            </span>
            <span class="ml-1">{{ Auth::user()->name ?? 'Guest' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-blue-200" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div id="userMenuDropdown" 
             class="hidden absolute right-0 mt-2 w-56 
                    bg-gradient-to-b from-gray-900 via-blue-900 to-gray-800 
                    text-blue-100 rounded-xl shadow-2xl overflow-hidden 
                    border border-gray-700 animate-fadeIn">
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center gap-2 px-5 py-3 hover:bg-blue-800 hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    <path d="M15.5 8.5a3 3 0 1 0-4.24 4.24l4.24-4.24z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                </svg>
                <span>Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="flex items-center gap-2 w-full text-left px-5 py-3 hover:bg-blue-800 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M16 17l-4 4m0 0l-4-4m4 4V3" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</header>
