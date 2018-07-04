function getLocation() {
    var interval = setInterval(function () {
        if ($('.lat').val() == "")
            alert('Hmmm Detection is taking too long. Try enterning the location manually');
        clearInterval(interval);
    }, 10000);
    if (navigator.geolocation) {
        var x = navigator.geolocation.getCurrentPosition(showPosition);
    } else {
         alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    $('.lat').val(position.coords.latitude);
    $('.lng').val(position.coords.longitude);

    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var geocoder = new google.maps.Geocoder;
    geocoder.geocode({
        'latLng': latlng
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            $('#address').val(results[0].formatted_address);
            $('#formatedAddress').val(results[0].formatted_address);
        }
    });
    if ($('.lat').val() != "") {
        $('.medicineForm').show();
    }
}


function addressToCoOrdinates() {
    var geocoder = new google.maps.Geocoder();
    var address = jQuery('#address').val();
    $('#formatedAddress').val($('#address').val());
    geocoder.geocode({
        'address': address
    }, function (results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $('#lat').val(latitude);
            $('#lng').val(longitude);
            if ($('#lat').val() != "") {
                $('.medicineForm').show();
            }
        }
    });
}