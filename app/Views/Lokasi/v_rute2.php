<div class="row">
    <!-- Kolom untuk form dan tombol -->
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Jarak (*Meter)</label>
            <input class="form-control" name="jarak" id="Jarak">
        </div>
    </div>
</div>
<br>
<div class="row">
    <!-- Kolom untuk peta -->
    <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 100vh;" class="leaflet-map-pane"></div>
    </div>
    <!-- Kolom untuk tab rute efektif -->
    <div class="col-sm-4">
        <ul class="nav nav-tabs" id="ruteTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="rute-tab" data-toggle="tab" href="#rute" role="tab" aria-controls="rute" aria-selected="true">Rute Efektif</a>
            </li>
        </ul>
        <div class="tab-content" id="ruteTabContent">
            <div class="tab-pane fade show active" id="rute" role="tabpanel" aria-labelledby="rute-tab">
                <div id="ruteList"></div>
            </div>
        </div>
    </div>
</div>

<style>
  .leaflet-popup-content button {
    display: block;
    width: 100%;
    margin-bottom: 5px;
    padding: 8px;
    text-align: center;
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
  }
</style>

<!-- default leaflet -->
<script>
function keSini(latLng){
    var latLng=L.latLng(latLng);
    routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, latLng);
} 

const cities = L.layerGroup();
// const mLittleton = L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.').addTo(cities);
// const mDenver = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities);
// const mAurora = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities);
// const mGolden = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
});

const map = L.map('map', {
	center: [-0.48070455395120976, 100.6379071623626],
	zoom: 10,
	layers: [osm, cities]
});

const openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
});

const baseLayers = {
	'OpenStreetMap': osm,
	'OpenStreetMap.HOT': osmHOT,
    'Topo Map' : openTopoMap
};

const overlays = {
	'Cities': cities
};

const layerControl = L.control.layers(baseLayers,null,{collapsed:false})
.addTo(map);

let userMarker;
let userIcon;
function showUserLocation(latitude, longitude) {
    if (!userIcon) {
        //custom marker
        userIcon = L.icon({
        iconUrl: '<?= base_url('marker/1.png') ?>', // Ganti dengan URL gambar ikon untuk lokasi pengguna
        iconSize: [42, 44], // Sesuaikan ukuran ikon
        iconAnchor: [21, 43], // Sesuaikan posisi ikon
        popupAnchor: [0, -32] // Sesuaikan posisi pop-up ikon
        });
    }
    if (userMarker) {
        map.removeLayer(userMarker);
        userMarker = L.marker([latitude, longitude], { icon: userIcon }).addTo(map);
    } else {
        userMarker = L.marker([latitude, longitude], { icon: userIcon }).addTo(map);
    }
}

let routingControl;
//geolocation
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    routingControl = L.Routing.control({
        waypoints: [
        L.latLng(position.coords.latitude, position.coords.longitude),  //lokasi user
        // L.latLng(-0.9468796322548746, 100.41744287223345) //tujuan
  ],
  geocoder: L.Control.Geocoder.nominatim(),
    routeWhileDragging: true,
    reverseWaypoints: true,
    showAlternatives: true,
    altLineOptions: {
        styles: [
            {color: 'black', opacity: 0.15, weight: 9},
            {color: 'white', opacity: 0.8, weight: 6},
            {color: 'blue', opacity: 0.5, weight: 2}
        ]
    },
    createMarker: function(i, waypoint, number) {
        // Return null to prevent default marker creation
        return null;
    }
})
routingControl.addTo(map);

//pemetaan lokasi dipanggil dari database


// $(document).on("click",".keSini",function() {
//     let latLng=[$(this).data('lat'),$(this).data('lng')];
//     control.spliceWaypoints(control.getWaypoints().length -1, 1, latLng)
// })

getLocation();
setInterval(() => {
    getLocation();
}, 3000);

function getLocation() {
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "gk support bg";
    }
}

let centerMap = false;
function showPosition(position) {
    console.log('Route Sekarang',position.coords.latitude, position.coords.longitude)
    $("[name=latNow]").val(position.coords.latitude);
    $("[name=lngNow]").val(position.coords.longitude);
    let latLng=[position.coords.latitude, position.coords.longitude];
        routingControl.spliceWaypoints(0, 1, latLng);
        if (centerMap==false)
        {
            map.panTo(latLng);
            centerMap = true;
        }
        showUserLocation(position.coords.latitude, position.coords.longitude);
}

    routingControl.on('routesfound', function(e) {
    var routes = e.routes;
    var summary = routes[0].summary;
    var totalDistance = summary.totalDistance;
    //kirim nilai jarak ke input
    document.getElementById('Jarak').value = totalDistance;
    // animasiCar(routes[0]);
    });
});
} else {
  alert('Geolocation is not supported by this browser.');
}

<?php foreach ($lokasi as $key => $value) { ?>
    L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])
    .bindPopup('<img src="<?= base_url('foto/'. $value['foto_lokasi']) ?>" width="250px">' + 
        '<h4><?= $value['nama_lokasi'] ?></h4>' +
        'Alamat : <?= $value['alamat_lokasi'] ?><br>' +
        '<button class="btn btn-info" onclick="return keSini([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])">Tujuan</button>')
    .addTo(map);
<?php } ?>

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
function urutkanRuteEfektif() {
    if (!navigator.geolocation) {
        alert('Geolocation is not supported by this browser.');
        return;
    }

    navigator.geolocation.getCurrentPosition(function(position) {
        var userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
        var lokasiDatabase = <?php echo json_encode($lokasi); ?>;

        lokasiDatabase.forEach(function(lokasi) {
            var lokasiLatLng = L.latLng(lokasi.latitude, lokasi.longitude);
            lokasi.jarakDariUser = userLatLng.distanceTo(lokasiLatLng);
        });

        lokasiDatabase.sort(function(a, b) {
            return a.jarakDariUser - b.jarakDariUser;
        });

        var ruteList = document.getElementById('ruteList');
        ruteList.innerHTML = '';

        lokasiDatabase.forEach(function(lokasi) {
            var lokasiLatLng = L.latLng(lokasi.latitude, lokasi.longitude);
            var distance = userLatLng.distanceTo(lokasiLatLng).toFixed(2);
            var listItem = document.createElement('div');
            listItem.innerHTML = '<p><strong>' + lokasi.nama_lokasi + '</strong><br>Alamat: ' + lokasi.alamat_lokasi + '<br>Jarak: ' + distance + ' meter</p>';
            ruteList.appendChild(listItem);
        });

        var waypoints = [userLatLng];
        lokasiDatabase.forEach(function(lokasi) {
            waypoints.push(L.latLng(lokasi.latitude, lokasi.longitude));
        });

        if (routingControl) {
            routingControl.setWaypoints(waypoints);
        } else {
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
        }
    });
}

// Di dalam tab-pane rute efektif, tambahkan button untuk memanggil fungsi urutkanRuteEfektif()
var ruteEfektifTabContent = document.getElementById('rute');
var buttonUrutkanRute = document.createElement('button');
buttonUrutkanRute.textContent = 'Urutkan Rute Efektif';
buttonUrutkanRute.classList.add('btn', 'btn-primary', 'mt-2');
buttonUrutkanRute.addEventListener('click', function() {
    urutkanRuteEfektif();
});
ruteEfektifTabContent.appendChild(buttonUrutkanRute);

</script>