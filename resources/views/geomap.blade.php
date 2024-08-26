<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeoMap Visualization</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .leaflet-tooltip.my-tooltip {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 8px;
        }
        .container {
            margin-top: 20px;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="title">
            <h2>GeoMap Visualization</h2>
        </div>
        <div id="map"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi peta
            var map = L.map('map').setView([0, 0], 2);

            // Tambahkan tile layer dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Ambil data GeoJSON dari endpoint
            $.getJSON('{{ route("api.geojson") }}', function(geojsonData) {
                // Tambahkan layer GeoJSON ke peta
                L.geoJSON(geojsonData, {
                    onEachFeature: function (feature, layer) {
                        // Tambahkan tooltip untuk setiap fitur GeoJSON
                        var description = feature.properties.description || 'No description available';
                        layer.bindTooltip(
                            `<div>
                                <strong>${feature.properties.name}</strong><br>
                                ${description}
                            </div>`,
                            { 
                                className: 'my-tooltip',
                                permanent: false,
                                direction: 'top'
                            }
                        );
                    }
                }).addTo(map);
            }).fail(function() {
                console.error('Error fetching GeoJSON data');
            });

            // Ambil data dari API menggunakan AJAX
            $.ajax({
                url: '{{ route("api.negara") }}', // API endpoint Laravel Anda
                method: 'GET',
                success: function(response) {
                    processData(response.data); // Ambil data dari response JSON
                },
                error: function(error) {
                    console.error('Error fetching data', error);
                }
            });

            function processData(data) {
                // Warna kawasan berdasarkan direktorat
                var colors = {
                    1: '#ff0000', // Direktori 1
                    2: '#00ff00', // Direktori 2
                    3: '#0000ff', // Direktori 3
                    // Tambahkan lebih banyak direktorat jika diperlukan
                };

                data.forEach(function(negara) {
                    var lat = negara.latitude;
                    var lng = negara.longitude;
                    var kawasan = negara.kawasan ? negara.kawasan.nama_kawasan : 'N/A';
                    var direktorat = negara.direktorat ? negara.direktorat.nama_direktorat : 'N/A';
                    var namaNegara = negara.nama_negara;
                    var flagUrl = `https://flagcdn.com/32x24/${negara.kode_negara.toLowerCase()}.png`; // URL untuk mendapatkan bendera negara

                    var marker = L.circleMarker([lat, lng], {
                        color: colors[negara.id_direktorat] || '#000', // Warna berdasarkan direktorat
                        radius: 10,
                        fillOpacity: 0.8
                    }).addTo(map);

                    marker.bindTooltip(
                        `<div>
                            <img src="${flagUrl}" alt="${namaNegara}" style="width: 32px; height: 24px;">
                            <strong>${namaNegara}</strong><br>
                            Kawasan: ${kawasan}<br>
                            Direktorat: ${direktorat}
                        </div>`,
                        { 
                            className: 'my-tooltip',
                            permanent: false,
                            direction: 'top'
                        }
                    );
                });
            }
        });
    </script>
</body>
</html>
