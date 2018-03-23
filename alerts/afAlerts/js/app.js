/***************************************************************************
   Copyright 2015 OSIsoft, LLC.
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at
       http://www.apache.org/licenses/LICENSE-2.0
   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 ***************************************************************************/

var map;
var marker;
var panorama;
var geocoder;
var baseServiceUrl = "https://piapi.ethosicon.info/piwebapi";
var recordStarted = false;

var updatePanoramaDOM = function () {
    $("#latitude").text(panorama.position.lat());
    $("#longitude").text(panorama.position.lng());
    $("#heading").text(panorama.pov.heading);
    $("#pitch").text(panorama.pov.pitch);
    $("#zoom").text(panorama.pov.zoom);
    marker.setPosition(panorama.position);

    if (recordStarted) {
        piwebapi.SendValues(panorama);
    }
    
};

var authSuccessCallBack = function (data, statusMessage, statusObj) {
    if (statusObj.status == 200) {
        $("#auth-view-mode").hide();
        $("#map-view-mode").show();

        var osisoftloc = { lat: 37.72229173, lng: -122.1628293 };

        map = new google.maps.Map(document.getElementById('map'), {
            center: osisoftloc,
            zoom: 16,
            streetViewControl: false
        });

        marker = new google.maps.Marker({
            position: osisoftloc,
            map: map
        });

        panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), {
            position: osisoftloc,
            pov: {
                heading: 0,
                pitch: 0,
                zoom: 1
            }
        });

        geocoder = new google.maps.Geocoder();

        panorama.addListener('pano_changed', function () {
            updatePanoramaDOM();
        });
        panorama.addListener('links_changed', function () {
            updatePanoramaDOM();
        });
        panorama.addListener('position_changed', function () {
            updatePanoramaDOM();
        });
        panorama.addListener('pov_changed', function () {
            updatePanoramaDOM();
        });

        $("#stop-btn").prop('disabled', true);
    }
};

var authErrorCallBack = function (data) {
    if (data.status == 401) {
        alert("Invalid username and password.");
    }
    else {
        alert("Error during validation.");
    }
};

$("#go-to-map-btn").click(function () {
    var username = $("#username").val();
    var password = $("#password").val();

    piwebapi.SetBaseUrl(baseServiceUrl);
    piwebapi.SetCredentials(username, password);
    piwebapi.Authorize(authSuccessCallBack, authErrorCallBack);
 
});

$("#back-btn").click(function () {
    $("#username").val('');
    $("#password").val('');

    $("#map-view-mode").hide();
    $("#auth-view-mode").show();

    piwebapi.Reset();
});

$("#search-address-btn").click(function () {
    var address = document.getElementById("address").value;

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            panorama.setPosition(results[0].geometry.location);
            panorama.setPov({
                heading: 0,
                pitch: 0,
                zoom: 1
            });
        } else {
            alert("Geocode was not successful for the following reasons: " + status);
        }
    });
});

$("#start-btn").click(function () {
    piwebapi.CreateEventFrame();
    $("#start-btn").prop('disabled', true);
    $("#stop-btn").prop('disabled', false);
    recordStarted = true;
});

$("#stop-btn").click(function () {
    piwebapi.CloseEventFrame();
    $("#start-btn").prop('disabled', false);
    $("#stop-btn").prop('disabled', true);
    recordStarted = false;
});