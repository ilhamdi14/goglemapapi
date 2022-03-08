<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Cover</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/halPeta">Peta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/history">History</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
      <div class="container mt-5">
  <div class="card">
  <div class="card-header">Set Lokasi GPS</div>
  <div class="card-body">
  <form method="post" id="form" action="/history/simpan">
    <?= csrf_field(); ?>
    <div class="mb-3 col-6">
      
      <label for="exampleFormControlInput1" class="form-label">Titik Awal</label>
      
      <input type="text" class="form-control" id="awal" name="awal" placeholder="Titik Awal"  />
      
      
    </div>
    <div class="mb-3 col-6">
      <label for="exampleFormControlInput1" class="form-label">Titik Tujuan</label>
      <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Titik Tujuan" />
    </div>
    <div class="mb-3 col-6" >
      <label for="exampleFormControlInput1" class="form-label">Radius (pilih radius lalu gerakkan marker)</label>
      <select id="range" name="radius" class="form-control" >
        <option value="1">100 meter</option>
        <option value="5">500 meter</option>
        <option value="10">1 km</option>
        <option value="15">1,5 km</option>
        <option value="20">2 km</option>
        <option value="25">2,5 km</option>
        <option value="50">5 km</option>
      </select>
    </div>
    <!-- <div class="mb-3 col-2">
      <label for="exampleFormControlInput1" class="form-label">Jarak</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control"  aria-label="Recipient's username" aria-describedby="button-addon2" name="jarak" id="jarak">
        <button class="btn btn-outline-secondary" onclick="myFunction()" type="button" id="jarak_Btn">Hitung </button>
      </div>
    </div> -->
    

    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" id="simpan">Simpan</button>
    </div>

    </form>
    

    <div class="card">
      <div class="card-header">Map </div>
      <div class="card-body">
      <div id="map" style="height:400px; width:100%;"></div>
      </div>
    </div>



  </div>
</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
      // $(document).ready(function(){
      //       $("#simpan").click(function(){
      //           var data = $('#form').serialize();
      //           $.ajax({
      //               type	: 'POST',
      //               url	: "<?php //echo base_url(); ?>/history/simpan",
      //               data: data,
      //               cache	: false,
      //               success	: function(data){
      //                   alert("Sukses");
      //               }
      //           });
      //       });
      //   });

    </script>

<script>
	$(function() {
      
			var script = document.createElement('script');
				script.src = "https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAQ7Gh7Jg5JdzgPb5SRs1NQobCO168W4KI&sensor=false&callback=getLocation";
				document.body.appendChild(script);
        
			});

      
      
			
			function initialize(x,y) {

			var map;
      
        
			var bounds = new google.maps.LatLngBounds();
			var mapOptions = {
				mapTypeId: 'roadmap'
			};
				
			map = new google.maps.Map(document.getElementById("map"), mapOptions);
			map.setTilt(45);
							
			var infoWindow = new google.maps.InfoWindow(), marker, i;

      
      //Posisi Awal
      var circle1;
      var METERS = 100;

      var awal = new google.maps.LatLng(x, y);
			bounds.extend(awal);
      markerAwal = new google.maps.Marker({
					position: awal,
          center:awal,
					map: map,
          draggable: true,
					title: "Awal"
				});
        var infowindowAwal = new google.maps.InfoWindow({
          content:  "Awal" 
        });
        infowindowAwal.open(map,markerAwal);

        google.maps.event.addListener(markerAwal, 'dragend', (function(markerAwal, i){
          return function() {
						infoWindow.setContent("Awal");
						infoWindow.open(map, markerAwal);
            var valueAwal = $("#range").val();
            var posAwal = new google.maps.LatLng(markerAwal.getPosition().lat(), markerAwal.getPosition().lng());
            document.getElementById('awal').value =  markerAwal.getPosition().lat()+','+markerAwal.getPosition().lng();
            if (circle1 && circle1.setMap) circle1.setMap(null);
              circle1 = new google.maps.Circle({
              center: posAwal,
              strokeColor: "#c4c4c4",
              strokeOpacity: 0.35,
              strokeWeight: 0,
              fillColor: "yellow",
              fillOpacity: 0.35,
              radius: valueAwal * METERS,
              map: map
            });
            
					}
        })(markerAwal, i));
				map.fitBounds(bounds);

        //Posisi Tujuan
      var circle2;
      var METERS = 100;
      var tujuan = new google.maps.LatLng(3.5782656, 98.6742784);
			bounds.extend(tujuan);
      markerTujuan = new google.maps.Marker({
					position: tujuan,
					map: map,
          draggable: true,
					title: "Tujuan"
				});
        var infowindowTujuan = new google.maps.InfoWindow({
          content:  "Tujuan" 
        });
        infowindowTujuan.open(map,markerTujuan);

        google.maps.event.addListener(markerTujuan, 'dragend', (function(markerTujuan, i){
          return function() {
						infoWindow.setContent("Tujuan");
						infoWindow.open(map, markerTujuan);
            var valueTujuan = $("#range").val();
            var posTujuan = new google.maps.LatLng(markerTujuan.getPosition().lat(), markerTujuan.getPosition().lng());
            document.getElementById('tujuan').value =  markerTujuan.getPosition().lat()+','+markerTujuan.getPosition().lng();
            if (circle2 && circle2.setMap) circle2.setMap(null);
              circle2 = new google.maps.Circle({
              center: posTujuan,
              strokeColor: "#c4c4c4",
              strokeOpacity: 0.35,
              strokeWeight: 0,
              fillColor: "#ffffff",
              fillOpacity: 0.35,
              radius: valueTujuan * METERS,
              map: map
            });
            
					}
        })(markerTujuan, i));
				map.fitBounds(bounds);

			
			var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
				this.setZoom(15);
				google.maps.event.removeListener(boundsListener);
			});

	
	}

  
</script>
<script>
var x = document.getElementById("map");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;

  initialize(position.coords.latitude,position.coords.longitude);

}

</script>
<script>
      function myFunction() {
          var awal = $("#awal").val();
          var tujuan = $("#tujuan").val();

          var directionsDisplay;
          var directionsService = new google.maps.DirectionsService();
          var map;
          var routeBounds = false;

          var start = new google.maps.LatLng(awal);
          var end = new google.maps.LatLng(tujuan);

          var request = {
              origin: start,
              destination: end,
              travelMode: google.maps.DirectionsTravelMode.DRIVING
          };

          directionsDisplay = new google.maps.DirectionsRenderer({
              draggable: true
          });
                
          directionsService.route(request, function (response, status) {
            alert('ggg'+status);
            if (status == google.maps.DirectionsStatus.OK) {

                directionsDisplay.setDirections(response);

                // Define route bounds for use in offsetMap function
                routeBounds = response.routes[0].bounds;

                // Write directions steps
                writeDirectionsSteps(response.routes[0].legs[0].steps);

                // Wait for map to be idle before calling offsetMap function
                google.maps.event.addListener(map, 'idle', function () {

                    // Offset map
                    offsetMap();
                });

                // Listen for directions changes to update bounds and reapply offset
                google.maps.event.addListener(directionsDisplay, 'directions_changed', function () {

                    // Get the updated route directions response
                    var updatedResponse = directionsDisplay.getDirections();

                    // Update route bounds
                    routeBounds = updatedResponse.routes[0].bounds;

                    // Fit updated bounds
                    map.fitBounds(routeBounds);

                    // Write directions steps
                    writeDirectionsSteps(updatedResponse.routes[0].legs[0].steps);

                    // Offset map
                    offsetMap();
                });
            }
          });
          



        //document.getElementById("jarak").value = directionsService;
      }
      function writeDirectionsSteps(steps) {
      
        let jarak =0;
        for (var i = 0; i < steps.length; i++) {

             jarak = jarak + steps[i].distance;
        }
        document.getElementById("jarak").value = jarak;
      }
    </script>
    

    

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ7Gh7Jg5JdzgPb5SRs1NQobCO168W4KI&callback=myMap"></script> -->



    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
