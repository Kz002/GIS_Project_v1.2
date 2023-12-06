function ruteKeSemuaLokasi() {
    // Menyimpan semua lokasi dari database dalam sebuah array
    var lokasiDatabase = <?php echo json_encode($lokasi); ?>;

    // Menghapus rute sebelumnya jika ada
    if (routingControl) {
        map.removeControl(routingControl);
    }

    // Mendefinisikan array untuk waypoints
    var waypoints = [];

    // Menambahkan lokasi dari database sebagai waypoints
    lokasiDatabase.forEach(function(lokasi) {
        waypoints.push(L.latLng(lokasi.latitude, lokasi.longitude));
    });

    // Menambahkan lokasi user sebagai waypoint pertama
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            userWaypoint = L.latLng(position.coords.latitude, position.coords.longitude);

            var waypoints = lokasiDatabase.map(function(lokasi) {
                return L.latLng(lokasi.latitude, lokasi.longitude);
            });

            waypoints.unshift(userWaypoint);

            routingControl = L.Routing.control({
                waypoints: waypoints,
                geocoder: L.Control.Geocoder.nominatim(),
                routeWhileDragging: true,
                reverseWaypoints: true,
                showAlternatives: true,
                altLineOptions: {
                    styles: [
                        { color: 'black', opacity: 0.15, weight: 9 },
                        { color: 'white', opacity: 0.8, weight: 6 },
                        { color: 'blue', opacity: 0.5, weight: 2 }
                    ]
                },
                createMarker: function(i, waypoint, number) {
                    return null;
                }
            }).addTo(map);

            var ruteList = document.getElementById('ruteList');
            ruteList.innerHTML = '';

            lokasiDatabase.forEach(function(lokasi) {
                var lokasiLatLng = L.latLng(lokasi.latitude, lokasi.longitude);
                var distance = userWaypoint.distanceTo(lokasiLatLng).toFixed(2);
                var listItem = document.createElement('div');
                listItem.innerHTML = '<p><strong>' + lokasi.nama_lokasi + '</strong> - Jarak: ' + distance + ' meter</p>';
                ruteList.appendChild(listItem);
            });

            routingControl.setWaypoints(waypoints);
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    // Mendapatkan lokasi pengguna
    navigator.geolocation.getCurrentPosition(function(position) {
        var userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

        // Mendapatkan semua lokasi dari database
        var lokasiDatabase = <?php echo json_encode($lokasi); ?>;
        
        // Menghitung jarak antara lokasi pengguna dan semua lokasi dari database
        lokasiDatabase.forEach(function(lokasi) {
            var lokasiLatLng = L.latLng(lokasi.latitude, lokasi.longitude);
            lokasi.jarakDariUser = userLatLng.distanceTo(lokasiLatLng); // Menambahkan jarak ke setiap objek lokasi
        });

        // Mengurutkan lokasi berdasarkan jarak dari lokasi pengguna (dari terdekat ke terjauh)
        lokasiDatabase.sort(function(a, b) {
            return a.jarakDariUser - b.jarakDariUser;
        });

        // Membuat array waypoints berdasarkan urutan terurut
        var waypoints = [userLatLng];
        lokasiDatabase.forEach(function(lokasi) {
            waypoints.push(L.latLng(lokasi.latitude, lokasi.longitude));
        });

        // Membuat rute menggunakan waypoints yang telah diurutkan
        routingControl.setWaypoints(waypoints).addTo(map);
    });
    // Menampilkan jarak dari lokasi pengguna ke setiap lokasi di tab rute
    var ruteList = document.getElementById('ruteList');
        ruteList.innerHTML = ''; // Membersihkan isi sebelumnya

        lokasiDatabase.forEach(function(lokasi) {
            var lokasiLatLng = L.latLng(lokasi.latitude, lokasi.longitude);
            var distance = userLatLng.distanceTo(lokasiLatLng).toFixed(2); // Menghitung jarak
            var listItem = document.createElement('div');
            listItem.innerHTML = '<p><strong>' + lokasi.nama_lokasi + '</strong> - Jarak: ' + distance + ' meter</p>';
            ruteList.appendChild(listItem);
        });

        // Menyimpan rute yang dibuat ke dalam kontrol rute
        routingControl.setWaypoints(waypoints);
}