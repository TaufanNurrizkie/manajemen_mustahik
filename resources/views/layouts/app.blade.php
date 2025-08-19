<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Area Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'slide-in': 'slideIn 0.3s ease-out',
                        'fade-in': 'fadeIn 0.2s ease-out',
                        'pulse-subtle': 'pulseSubtle 2s ease-in-out infinite',
                    },
                    keyframes: {
                        slideIn: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        pulseSubtle: {
                            '0%, 100%': {
                                transform: 'scale(1)'
                            },
                            '50%': {
                                transform: 'scale(1.02)'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link-hover:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-gradient {
            background: linear-gradient(135deg, #065f46 0%, #047857 25%, #059669 50%, #10b981 75%, #34d399 100%);
            position: relative;
        }

        .sidebar-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 50%, rgba(0, 0, 0, 0.05) 100%);
            pointer-events: none;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-600 via-green-700 to-emerald-800 shadow-lg fixed w-full z-40">
        <div class="h-16 flex items-center px-6">
            <!-- Tombol Hamburger -->
            <button id="sidebarToggle" class="text-white focus:outline-none mr-4">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Brand -->
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-green-800 font-bold text-sm">M</span>
                </div>
                <div class="text-2xl font-bold text-white tracking-tight">
                    Zyra
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar (overlay full screen) -->
    <div id="sidebar"
        class="fixed inset-0 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">

        <!-- Background overlay -->
        <div id="sidebarOverlay" class="absolute inset-0 bg-black/50"></div>

        <!-- Sidebar content -->
        <aside
            class="relative w-72 h-full bg-gradient-to-b from-green-600 via-green-700 to-emerald-800 text-white shadow-2xl flex flex-col">

            <!-- Header -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-amber-400 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-cogs text-green-800 text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Admin Panel</h1>
                        <p class="text-xs text-white/70">Management Mustahik</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 overflow-y-auto scrollbar-thin">
                <div class="space-y-6">
                    <h3 class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 px-3">
                        Manajemen
                    </h3>
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:bg-white/10 hover:text-white transition">
                            <i class="fas fa-map-marked-alt w-5 text-center"></i>
                            <span>Daftar Area</span>
                        </a>
                        <a href="{{ route('mustahik.data') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:bg-white/10 hover:text-white transition">
                            <i class="fas fa-calendar-alt w-5 text-center"></i>
                            <span>Data Mustahik</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-white/10 bg-white/5">
                <div class="flex items-center gap-3 mb-4 p-3 rounded-lg hover:bg-white/10 transition-colors">
                    <a href="index.php?action=profile" class="flex items-center gap-3 w-full text-white no-underline">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center font-bold text-sm shadow-lg">
                            A
                        </div>
                        <div class="flex-1">
                            <h6 class="text-sm font-semibold mb-0">Admin</h6>
                            <small class="text-xs text-white/70">Administrator</small>
                        </div>
                    </a>
                </div>

                <a href="index.php?action=logout"
                    class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    </div>

    <!-- Konten utama -->
    <main class="pt-20 p-6 flex-1 min-h-screen">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            // buka sidebar
            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
            });

            // klik overlay tutup sidebar
            sidebarOverlay.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
            });
        });
    </script>
</body>

</html>
