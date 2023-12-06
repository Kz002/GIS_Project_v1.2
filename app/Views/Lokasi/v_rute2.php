<div class="row">
    <!-- Kolom untuk form dan tombol -->
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Jarak (*Meter)</label>
            <input class="form-control" name="jarak" id="Jarak">
        </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="autoZoomCheckbox" checked>
            <label class="form-check-label" for="autoZoomCheckbox">
                Matikan Mode Fokus
            </label>
        </div>
    </div>
</div>
<!-- Button untuk menyembunyikan/menampilkan tab rute efektif -->
<button class="btn btn-primary" onclick="toggleRuteEfektifSidebar()">
    <i id="arrowIcon" class="fas fa-arrow-right"></i>
    Rute Efektif
</button><br>
<div class="row">
    <!-- Kolom untuk peta -->
    <div class="col-sm-8" id="map-column">
        <div id="map" style="width: 100%; height: 100vh;" class="leaflet-map-pane"></div>
    </div>
    <!-- Kolom untuk tab rute efektif -->
    <div class="col-sm-4" id="ruteSidebar">
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

    /* CSS untuk membuat tab content menjadi scrollable */
    #ruteList {
        max-height: 600px; /* Sesuaikan tinggi maksimum yang diinginkan */
        overflow-y: auto; /* Membuat area menjadi scrollable */
    }
    /* CSS untuk animasi slide dari kanan */
#ruteSidebar {
    transition: transform 0.3s ease-in-out;
    position: fixed;
    top: 0%;
    right: -300px; /* Memulai dari posisi di luar layar sebelah kanan */
    width: 300px;
    height: 100vh;
    background-color: #fff;
    z-index: 1000;
    overflow-y: auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar-visible {
    transform: translateX(-300px); /* Geser ke arah kiri untuk menampilkan */
}

.sidebar-hidden {
    transform: translateX(0); /* Kembali ke posisi sembunyi saat di luar layar */
    pointer-events: none;
}
  /* CSS untuk membuat peta menjadi fleksibel */
  #map-column {
        transition: width 0.3s ease-in-out; /* Tambahkan efek transisi saat lebar peta berubah */
        width: calc(100% - 300px); /* Set lebar peta saat tab rute efektif ditampilkan */
    }

    .sidebar-visible #map-column {
        width: 100%; /* Set lebar peta saat tab rute efektif ditutup */
    }
    #arrowIcon {
    transition: transform 0.3s ease-in-out;
}

.sidebar-visible #arrowIcon {
    transform: rotate(0deg); /* Ubah derajat rotasi sesuai kebutuhan */
}

.sidebar-hidden #arrowIcon {
    transform: rotate(180deg); /* Ubah derajat rotasi sesuai kebutuhan */
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

let autoZoomEnabled = true; // Tambahkan variabel untuk menyimpan status zoom otomatis
// Tambahkan event listener untuk checkbox atau tombol zoom otomatis
const autoZoomCheckbox = document.getElementById('autoZoomCheckbox');
autoZoomCheckbox.addEventListener('change', function() {
    autoZoomEnabled = this.checked; // Ubah status zoom otomatis berdasarkan checkbox
});
// Tentukan lokasi berikutnya rute
let nextLocationIndex = 0; // Variabel untuk menyimpan indeks lokasi berikutnya dalam rute
let lokasiDatabase = <?php echo json_encode($lokasi); ?>; // Data lokasi dari database
let centerMap = true;
function showPosition(position) {
    console.log('Route Sekarang',position.coords.latitude, position.coords.longitude)
    $("[name=latNow]").val(position.coords.latitude);
    $("[name=lngNow]").val(position.coords.longitude);
    let userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
    let latLng=[position.coords.latitude, position.coords.longitude];
        routingControl.spliceWaypoints(0, 1, latLng);
        if (!autoZoomEnabled) {
        map.panTo(latLng);
        centerMap = false;
        }
        showUserLocation(position.coords.latitude, position.coords.longitude);

    // Pastikan masih ada lokasi berikutnya dalam rute
    if (nextLocationIndex < lokasiDatabase.length) {
        var nextLocation = lokasiDatabase[nextLocationIndex];
        var targetLatLng = L.latLng(nextLocation.latitude, nextLocation.longitude);
        var distance = userLatLng.distanceTo(targetLatLng);

        if (distance <= 50) { // Jarak dalam meter ketika notifikasi muncul
            if (confirm('Anda telah mencapai tujuan ini. Lanjutkan ke tujuan berikutnya?')) {
                // Update lokasi berikutnya untuk navigasi ke rute selanjutnya
                nextLocationIndex++;

                if (nextLocationIndex < lokasiDatabase.length) {
                    // Dapatkan koordinat lokasi berikutnya
                    var newLocation = lokasiDatabase[nextLocationIndex];
                    targetLocation = L.latLng(newLocation.latitude, newLocation.longitude);

                    // Update waypoints dengan lokasi berikutnya
                    var waypoints = routingControl.getWaypoints();
                    waypoints.splice(waypoints.length - 1, 1, targetLocation);

                    // Update rute pada peta
                    routingControl.setWaypoints(waypoints);
                    
                    // Tampilkan informasi baru atau navigasi ke titik selanjutnya
                    L.popup()
                    .setLatLng(targetLocation)
                    .setContent('Anda sekarang menuju ke: ' + newLocation.nama_lokasi)
                    .openOn(map);
                } else {
                    alert('Anda telah mencapai tujuan akhir.');
                    routingControl.setWaypoints([]);
                    // Tambahkan logika atau aksi yang sesuai jika sudah mencapai tujuan akhir
                }
            } else {
                // Jika pengguna memilih untuk tidak melanjutkan
                // Tambahkan logika atau aksi yang sesuai di sini
            }
        }
    }
}

    routingControl.on('routesfound', function(e) {
    var routes = e.routes;
    var summary = routes[0].summary;
    var totalDistance = summary.totalDistance;
    //kirim nilai jarak ke input
    document.getElementById('Jarak').value = totalDistance;
    // animasiCar(routes[0]);
    if (autoZoomEnabled) {
        map.fitBounds(e.routes[0].bounds); // Fokus ke batas rute yang ditemukan
    }
    });
});
} else {
  alert('Geolocation is not supported by this browser.');
}

<?php foreach ($lokasi as $key => $value) { ?>
    L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])
    .bindPopup('<img src="<?= base_url('foto/'. $value['foto_lokasi']) ?>" width="150px">' + 
        '<h4><?= $value['nama_lokasi'] ?></h4>' +
        'Alamat : <?= $value['alamat_lokasi'] ?><br>' +
        '<button class="btn btn-info" onclick="return keSini([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])">Tujuan</button>')
    .addTo(map);
<?php } ?>


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
        listItem.classList.add('rute-info'); // Tambahkan kelas untuk setiap informasi rute
        listItem.innerHTML = '<p><strong>' + lokasi.nama_lokasi + '</strong><br>Alamat: ' + lokasi.alamat_lokasi + '<br>Jarak: ' + distance + ' meter</p>' +
                             '<button class="btn btn-danger btn-sm close-btn">Close</button>'; // Tambahkan tombol Close

        // Buat div untuk tombol zoom
        var buttonDiv = document.createElement('div');
        buttonDiv.classList.add('text-right'); // Menambahkan kelas CSS untuk membuat tombol menjadi posisi kanan
        listItem.appendChild(buttonDiv); // Menambahkan div untuk tombol zoom ke dalam listItem

        var zoomButton = document.createElement('button');
        zoomButton.textContent = 'Zoom ke Lokasi';
        zoomButton.classList.add('btn', 'btn-success', 'mt-2');
        zoomButton.addEventListener('click', function () {
            map.setView(lokasiLatLng, 15); // Melakukan zoom ke lokasi dengan level zoom 15 (sesuaikan sesuai kebutuhan)
        });
        buttonDiv.appendChild(zoomButton); // Menambahkan tombol zoom ke div yang telah dibuat

        ruteList.appendChild(listItem);

        // Menambahkan event listener untuk tombol Close
        var closeBtn = listItem.querySelector('.close-btn');
        closeBtn.addEventListener('click', function() {
            listItem.style.display = 'none'; // Menyembunyikan informasi rute saat tombol Close diklik
        });
    });
        var waypoints = [userLatLng];
        lokasiDatabase.forEach(function(lokasi) {
            waypoints.push(L.latLng(lokasi.latitude, lokasi.longitude));
    });

        // ---- fungsi untuk menunjukkan rute semua lokasi map (tidak efektif)
        // if (routingControl) {
        //     routingControl.setWaypoints(waypoints);
        // } else {
        //     routingControl = L.Routing.control({
        //         waypoints: waypoints,
        //         geocoder: L.Control.Geocoder.nominatim(),
        //         routeWhileDragging: true,
        //         reverseWaypoints: true,
        //         showAlternatives: true,
        //         altLineOptions: {
        //             styles: [
        //                 { color: 'black', opacity: 0.15, weight: 9 },
        //                 { color: 'white', opacity: 0.8, weight: 6 },
        //                 { color: 'blue', opacity: 0.5, weight: 2 }
        //             ]
        //         },
        //         createMarker: function(i, waypoint, number) {
        //             return null;
        //         }
        //     }).addTo(map);
        // }
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
// Menempatkan tombol Urutkan Rute Efektif di dalam div bersama dengan judul tab
var ruteEfektifDiv = document.createElement('div');
ruteEfektifDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-3');
ruteEfektifDiv.appendChild(document.createElement('h5').appendChild(document.createTextNode('Rute Efektif')));
ruteEfektifDiv.appendChild(buttonUrutkanRute);

// Menghapus semua elemen di dalam tab-pane rute efektif
while (ruteEfektifTabContent.firstChild) {
    ruteEfektifTabContent.removeChild(ruteEfektifTabContent.firstChild);
}
// Menambahkan kembali elemen-elemen yang sudah disesuaikan
ruteEfektifTabContent.appendChild(ruteEfektifDiv);
var ruteListDiv = document.createElement('div');
ruteListDiv.id = 'ruteList';
ruteEfektifTabContent.appendChild(ruteListDiv);

function toggleRuteEfektifSidebar() {
    var ruteSidebar = document.getElementById('ruteSidebar');
    var mapColumn = document.getElementById('map-column');
    var ruteTabs = document.getElementById('ruteTabs');
    var arrowIcon = document.getElementById('arrowIcon');

    if (ruteSidebar.classList.contains('sidebar-visible')) {
        ruteSidebar.classList.remove('sidebar-visible');
        ruteSidebar.classList.add('sidebar-hidden');
        mapColumn.classList.remove('col-sm-4');
        mapColumn.classList.add('col-sm-12');
        ruteTabs.style.display = 'none';
        arrowIcon.style.transform = 'rotate(180deg)'; // Ubah rotasi panah saat sidebar disembunyikan
    } else {
        ruteSidebar.classList.remove('sidebar-hidden');
        ruteSidebar.classList.add('sidebar-visible');
        mapColumn.classList.remove('col-sm-12');
        mapColumn.classList.add('col-sm-8');
        ruteTabs.style.display = 'none';
        arrowIcon.style.transform = 'rotate(0deg)'; // Ubah rotasi panah saat sidebar ditampilkan
    }
}

</script>