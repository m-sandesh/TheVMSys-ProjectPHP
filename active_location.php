<?php
require_once 'class/dbConnect.php';
require_once 'includes/header.php';
require_once 'includes/navbar_user.php';

session_start();

$vehicle = $_GET['vehicle'];

if ($vehicle == '2') {
    unset($_SESSION['selected_vehicle']);
    $_SESSION['selected_vehicle'] = "2";
}
if ($vehicle == '4') {
    unset($_SESSION['selected_vehicle']);
    $_SESSION['selected_vehicle'] = "4";
}

?>

<div class="location-container">
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    </head>

    <div id="map"></div>
    <script>
        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        var map, infoWindow, myLatLng;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 16
            });

            infoWindow = new google.maps.InfoWindow;

            //geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('You are here.');
                    infoWindow.open(map);
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesnt support geolocation.');
            infoWindow.open(map);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpLevKKjnE01si8iAjWkMH5oPCZIx8k&callback=initMap"></script>

    <div class="container" align="center">
        <br>
        <h4 align="center">Vehicle Workshops Nearby</h4>
        <hr>
        <?php
        $query = "SELECT * FROM workshop WHERE center_type=" . $_SESSION['selected_vehicle'];
        $run = mysqli_query($db, $query);
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_assoc($run)) { ?>
                <br>
                <div class="card w-75" align="left">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['centername'] ?></h5>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas ex eligendi adipisci a dolores quaerat voluptatibus, eaque sequi sunt velit ipsam quia porro delectus, ab explicabo, dolorum nisi doloremque voluptatum!</p>
                        <a href="vehicle_details.php?shopid=<?= $row['workshopId'] ?>" class="btn btn-primary">Choose</a>
                    </div>
                </div>
            <?php
            }
        } else { ?>
            <h6>No workshops nearby.</h6>
        <?php
        }
        ?>
    </div>
</div>

<?php
// require_once 'includes/footer.php';
?>