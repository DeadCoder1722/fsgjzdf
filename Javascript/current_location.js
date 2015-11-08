var zipcode;

$(document).ready(function() {
    var x = document.getElementById("latlong");

    //     var url = 'https://api.foursquare.com/v2/venues/search?client_id=Z5W2A0NSPYTKR4EG0BGTRZYTLGD2HNDI2MVCWH1YP012WVT0&client_secret=ZN20S5ROLWPFKK0XGF4BIXKSFPZ02UHIZPRBIPABFFJ2Q5HX&v=20130815&ll=17.416471,78.438247&query=coffee?callback=JSON_CALLBACK;'
    // debugger;
    // $http.jsonp(url)
    //     .success(function(data){
    //         debugger;
    //         console.log(data.found);
    //     });


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;

        $.ajax({
            method: "GET",
            url: "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&key=AIzaSyBWvv6rpKlX4vn_KoosiRYRPOegfydLcq8",
            success: function(results) {
                store(results)
    
            }
        });

        function store(results) {
            var jsontext = results;
           
            zipcode = jsontext.results[0].address_components[8].long_name;
            document.getElementById("zipcodearea").innerHTML = "Your Zipcode is: " + zipcode;
            getInfo(zipcode);
        }

        /*
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&key=AIzaSyBWvv6rpKlX4vn_KoosiRYRPOegfydLcq8", false); // false for synchronous request
                xmlHttp.send(null);
                xmlHttp.onreadystatechange = function() {
                        if (xmlHttp.readyState == 4 && xhttp.status == 200) {
                            var jsontext = xmlHttp.responseText;
                            var jsonobj = JSON.parse(jsontext);
                            zipcode = jsonobj.results[0].address_components[8].long_name;
                            document.getElementById("zipcodearea").innerHTML = "Your Zipcode is: " + zipcode;
                        }}
        */
        //console.log(jsontext);


    };

    getLocation();

});
