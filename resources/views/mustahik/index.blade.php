@extends('layouts.app')
@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div id="map" style="width: 100%; height: 500px; margin-bottom: 20px;"></div>

    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 p-8 animate-fade-in">
        <div class="filters grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Filter Program -->
            <div class="filter-group">
                <label for="filter-program" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Program
                </label>
                <div class="relative group">
                    <select id="filter-program"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 appearance-none cursor-pointer hover:border-blue-300 group-hover:shadow-md">
                        <option value="">Semua Program</option>
                        @foreach ($programs as $p)
                            <option value="{{ $p->program }}">{{ $p->program }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Kecamatan -->
            <div class="filter-group">
                <label for="filter-kecamatan" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    Kecamatan
                </label>
                <div class="relative group">
                    <select id="filter-kecamatan"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 appearance-none cursor-pointer hover:border-green-300 group-hover:shadow-md">
                        <option value="">Semua Kecamatan</option>
                        @foreach ($kecamatan as $k)
                            <option value="{{ $k->kecamatan }}">{{ $k->kecamatan }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Kelurahan -->
            <div class="filter-group">
                <label for="filter-kelurahan" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                    Kelurahan
                </label>
                <div class="relative group">
                    <select id="filter-kelurahan"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-300 appearance-none cursor-pointer hover:border-purple-300 group-hover:shadow-md">
                        <option value="">Semua Kelurahan</option>
                        @foreach ($kelurahan as $k)
                            <option value="{{ $k->kelurahan }}">{{ $k->kelurahan }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition-colors duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto mt-8">
            <table id="mustahik-table" class="w-full">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Program</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Kecamatan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Kelurahan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $a)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">AH</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $a->nama }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $a->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $a->program }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $a->alamat }}
                            </td>
                            <td class="px-6 py-4">{{ $a->kecamatan }}</td>
                            <td class="px-6 py-4">{{ $a->kelurahan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div>
                        Menampilkan 1-5 dari {{ $data->total() }} data
                    </div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>

        <script>
            const map = L.map('map', {
                maxBounds: [
                    [-90, -180],
                    [90, 180]
                ], // membatasi agar tidak bisa scroll tak terbatas
                maxBoundsViscosity: 1.0, // efek bounce saat sampai batas
                worldCopyJump: false, // mencegah pengulangan globe
                minZoom: 5 // cegah zoom out terlalu jauh
            }).setView([0.481, 101.431], 13); // Fokus ke Limbungan, Pekanbaru


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

            }).addTo(map);

            let allMarkers = [];

            fetch('/mustahik/data')
                .then(res => res.json())
                .then(data => {
                    allMarkers = data.map(m => {
                        const marker = L.marker([m.latitude, m.longitude]);

                        const statusClass = m.status === 'sudah_dibantu' ?
                            'bg-green-500 text-white' :
                            'bg-red-500 text-white';

                        const popupContent = `
                <div class="font-sans text-sm text-gray-700 space-y-1">
                    <div class="font-bold text-base text-gray-900">${m.nama}</div>
                    <div class="text-gray-600">${m.program}</div>
                    <div>${m.alamat}</div>
                    <div class="inline-block px-2 py-0.5 text-xs rounded ${statusClass}">
                        ${m.status === 'sudah_dibantu' ? '✔ Sudah Dibantu' : '❌ Belum Dibantu'}
                    </div>
                    <div class="pt-2 space-y-1">
                        <a href="https://www.google.com/maps?q=${m.latitude},${m.longitude}" 
                           target="_blank" 
                           class="block text-blue-600 hover:underline">
                            📍 Lihat di Google Maps
                        </a>
                        <a href="https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${m.latitude},${m.longitude}" 
                           target="_blank" 
                           class="block text-green-600 hover:underline">
                            👁️ Lihat Street View
                        </a>
                    </div>
                </div>
            `;

                        marker.bindPopup(popupContent);
                        marker.data = m; // simpan data asli untuk filtering

                        return marker;
                    });

                    renderMarkers(); // tampilkan awal semua marker
                });

            function renderMarkers(filter = {}) {
                map.eachLayer(layer => {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                allMarkers.forEach(marker => {
                    const d = marker.data;

                    const matchProgram = !filter.program || d.program === filter.program;
                    const matchKecamatan = !filter.kecamatan || d.kecamatan === filter.kecamatan;
                    const matchKelurahan = !filter.kelurahan || d.kelurahan === filter.kelurahan;

                    if (matchProgram && matchKecamatan && matchKelurahan) {
                        marker.addTo(map);
                    }
                });
            }


            document.getElementById('filter-program').addEventListener('change', function() {
                const program = this.value;
                const kecamatan = document.getElementById('filter-kecamatan').value;
                const kelurahan = document.getElementById('filter-kelurahan').value;
                renderMarkers({
                    program,
                    kecamatan,
                    kelurahan
                });
            });

            document.getElementById('filter-kecamatan').addEventListener('change', function() {
                const program = document.getElementById('filter-program').value;
                const kecamatan = this.value;
                const kelurahan = document.getElementById('filter-kelurahan').value;
                renderMarkers({
                    program,
                    kecamatan,
                    kelurahan
                });
            });

            document.getElementById('filter-kelurahan').addEventListener('change', function() {
                const program = document.getElementById('filter-program').value;
                const kecamatan = document.getElementById('filter-kecamatan').value;
                const kelurahan = this.value;
                renderMarkers({
                    program,
                    kecamatan,
                    kelurahan
                });
            });
        </script>
    @endsection
