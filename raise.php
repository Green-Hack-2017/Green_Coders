<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=&key=AIzaSyDg4kddVaGQNI5O5Cx5eOpGBO0X8ODTL-U"></script> 
    <script src="bootstrap/js/geoPosition.js" type="text/javascript" charset="utf-8"></script>
    <script src="bootstrap/js/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>


 <script type="text/javascript"> 

  var geocoder;


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    alert("Geocoder failed");
}

  function initialize() {
    geocoder = new google.maps.Geocoder();



  }

  function codeLatLng(lat, lng) {

    alert(lat+" "+lng)

    var latlng = new google.maps.LatLng(lat, lng);
    alert(latlng)

    geocoder.geocode({'latLng': latlng}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         alert(results[0].formatted_address)
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        alert(city.short_name + " " + city.long_name)
     
         document.getElementById('latitude').value =  lat;
         document.getElementById('longitude').value = lng;
         document.getElementById('state').value=city.short_name;
         document.getElementById('exactloc').value=results[0].formatted_address;

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script> 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="initialize()">

    <div class="maindiv">
      <div class="insidediv3">&nbsp;</div>
      <div class="insidediv1"><b>Send Complaint</b></div>
      <hr class="custhr">
   
     
      <form class="userform" action="success.php" method="POST">
        <div class="form-group">
          <label for="exampleInputFile"><u>Upload Image/Video</u></label>
          <input type="file" class="form-control-file" id="exampleInputFile" name="mediafile" aria-describedby="fileHelp">
        </div>
        <div class="form-group">
          <!-- <label for="exampleTextarea"><u>Your Message</u></label> -->
          <textarea class="form-control" name="message" id="exampleTextarea" rows="3" placeholder="Your Message"></textarea>
        </div>
        <input type="hidden" name="latitude" id="latitude" />
        <input type="hidden" name="longitude" id="longitude" />
        <input type="hidden" name="state" id="state"/>
        <input type="hidden" name="exactloc" id="exactloc"/>
        <input type="submit" class="btn btn-success" name="submit" value="Send Complaint"></input>
      </form>

      <div class="insidediv3">&nbsp;</div>
      
    </div>

   
  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>