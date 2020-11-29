

<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'pickmypack';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

 	$coordinates = array();
 	$latitudes = array();
	$longitudes = array();
	$description = array();

	// Select all the rows in the markers table
	$query = "SELECT  `lat`, `lng`, `description` FROM `shopping_pins` ";
	$result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);

 	while ($row = mysqli_fetch_array($result)) {

		$latitudes[] = $row['lat'];
		$longitudes[] = $row['lng'];
		$description[] = $row['description'];
		$coordinates[] = 'new google.maps.LatLng(' . $row['lat'] .','. $row['lng'] .'),';
	}

	//remove the comaa ',' from last coordinate
	$lastcount = count($coordinates)-1;
	$coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	

	if(isset($_POST['but_logout'])){
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Map | View</title>
		<style>
		.logout_btn{
			float: right;
		}
		</style>
	</head>

	<body>
	    <nav>  
			<ul> 
				<li class="active"><a href="#"><img src="img/map.png"></a></li>
				<li style="background-color:#fff"><a href=""><img style="width:40px" src="logo.png"  alt=""></a></li>
				<span style="font-family: 'Yellowtail', cursive; font-size: 22px; ">PickMyPack</span>
				<form method='post' action="">
				<input class = "logout_btn"type="submit" value="Logout" name="but_logout">
				</form>
			</ul> 
		</nav>

		 <div class="outer-scontainer">
	        <div class="row">
	            <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
	            	<div class="form-area">	      
    					<button type="submit" id="submit" name="import" class="btn-submit">RELOAD DATA</button><br />
					</div>
	            </form>
	        </div>

		<div id="map" style="width: 100%; height: 80vh;"></div>

		<script>
	
			function initMap() {
			  var mapOptions = {
			    zoom: 12,
			    center: {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>}, //{lat: --- , lng: ....}
			    mapTypeId: google.maps.MapTypeId.SATELITE
			  };
			  
			  var map = new google.maps.Map(document.getElementById('map'),mapOptions);

			  mark = 'img/mark.png';

			 var i = 0;
			 var lats =<?php echo json_encode($latitudes );?>;
			 var lngs =<?php echo json_encode($longitudes );?>;
			 var des =<?php echo json_encode($description);?>;
			 
			  for(i=0;i<lats.length;i++){
					var Point = {'lat': parseFloat(lats[i]) , 'lng' :parseFloat(lngs[i])};
					console.log(Point);
					console.log(des[i]);
					var marker = new google.maps.Marker({
						position: Point,
						map: map,
						title: des[i],
					});
				}

			}

			google.maps.event.addDomListener(window, 'load', initialize);
    	</script>

    	<!--remenber to put your google map key-->
	    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChWF8q0OAl9knzP3s-4r9KkdLAGccQt4g&callback=initMap"></script>

	</body>
</html>