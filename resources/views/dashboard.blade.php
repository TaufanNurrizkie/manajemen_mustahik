<div id="map" style="height: 500px;"></div>
<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: { lat: -0.507067, lng: 101.447777 } // Contoh: Pekanbaru
    });

    // Ambil data dari backend via AJAX
    fetch('/api/mustahik')
    .then(res => res.json())
    .then(data => {
        data.forEach(m => {
            new google.maps.Marker({
                position: { lat: parseFloat(m.latitude), lng: parseFloat(m.longitude) },
                map: map,
                title: m.nama,
                icon: {
                    url: getMarkerIconByProgram(m.program) // ikon warna per program
                }
            });
        });
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>

