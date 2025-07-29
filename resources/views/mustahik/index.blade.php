@extends('layouts.app')
@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div id="map" style="width: 100%; height: 500px; margin-bottom: 20px;"></div>

    <div class="filters">
        <select id="filter-program">
            <option value="">Semua Program</option>
            @foreach ($programs as $p)
                <option value="{{ $p->program }}">{{ $p->program }}</option>
            @endforeach
        </select>

        <select id="filter-kecamatan">
            <option value="">Semua Kecamatan</option>
            @foreach ($kecamatan as $k)
                <option value="{{ $k->kecamatan }}">{{ $k->kecamatan }}</option>
            @endforeach
        </select>

        <select id="filter-kelurahan">
            <option value="">Semua Kelurahan</option>
            @foreach ($kelurahan as $k)
                <option value="{{ $k->kelurahan }}">{{ $k->kelurahan }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto mt-8">
        <table id="mustahik-table" class="w-full">
            <thead class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Program</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Alamat</th>
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
