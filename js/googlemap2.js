// function myMap() {//
//     // var mapProp= {
//     //     center:new google.maps.LatLng(51.508742,-0.120850),
//     //
//     //     zoom:5,
//     // };
//     //var myLatLng = new google.maps.LatLng(parseFloat(24.532),parseFloat(80.777));
//     var myLatLng = new google.maps.LatLng(parseFloat('40.712784'), parseFloat('-74.005941'));
//     var map = new google.maps.Map(document.getElementById("googleMap"), {
//         center: myLatLng,
//         zoom: 8
//     });
//
//     var marker = new google.maps.Marker({
//        position: myLatLng,
//        map: map,
//        title: 'Hello world!'
//     });
//
//     var request = {
//         location: myLatLng,
//         radius: '1500',
//         types: ['school']
//     }
//
//     service = new google.maps.places.PlacesService(map);
//     service.nearbySearch(request, callback);
//
//     function callback(results, status) {
//         //console.log(results);
//         if(status == google.maps.places.PlacesServiceStatus.OK) {
//             for (var i = 0; i < results.length; i++) {
//                 var place = results[i];
//                 createMarker(results[i]);
//             }
//         }
//     }
//
//     function createMarker(position) {
//
//         new google.maps.Marker({
//             position: position,
//             map: map
//         });
//     }
//
// }
// google it
var map;
//function initMap() {
$(document).ready(function () {
    geoLocationInit();
    var myLatLng = {lat: -33.8665, lng: 151.1957};

    function geoLocationInit() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail)
        } else {
            alert("Browser not supported");
        }
    }

    function success(position) {
        console.log(position);
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;

        var myLatLng = new google.maps.LatLng(latval, lngval); //{lat: -33.8665, lng: 151.1957};
        createMap(myLatLng);
        nearbySearch(myLatLng, "school");
    }

    function fail() {
        alert("it fails");
    }
   

    function createMap(myLatLng) {
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: myLatLng,
            zoom: 8
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }
    function createMarker(position, icn) {
        // var marker = new google.maps.Marker({
        //     position: position,
        //     map: map,
        //     icon: icn,
        //     title: 'Hello world!'
        // });
        var infowindow = new google.maps.InfoWindow({
            content: '<a href="/businesses/' +33 + '">' + 'dsad' + '</a><br/>' + 'Phone: ',
            position: position,
            map: map
        });
    }
    
    function nearbySearch(myLatLng, type) {
        var request = {
            location: myLatLng,
            radius: '2500',
            types: [type]
        }

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        function callback(results, status) {
            console.log(results);
            if(status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    var place = results[i];
                    position = place.geometry.location;
                    icn = "https://maps.gstatic.com/mapfiles/place_api/icons/generic_business-71.png";
                    createMarker(position, icn);
                }
            }
        }
    }

});



// function createMarker(position) {
    //
    //     new google.maps.Marker({
    //         position: position,
    //         map: map
    //     });
    // }
//}