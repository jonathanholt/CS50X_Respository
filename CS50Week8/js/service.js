/**
 * service.js
 *
 * Computer Science 50
 * Problem Set 8
 *
 * Implements a shuttle service.
 */

//timervariables
var Timer;
var TotalSeconds;

// default height
var HEIGHT = 0.8;

// default latitude
var LATITUDE = 42.3745615030193;

// default longitude
var LONGITUDE = -71.11803936751632;

// default heading
var HEADING = 1.757197490907891;

// default number of seats
var SEATS = 10;

// default velocity
var VELOCITY = 50;

// global reference to shuttle's marker on 2D map
var bus = null;

// global reference to 3D Earth
var earth = null;

// global reference to 2D map
var map = null;

//how many free seats
var freeseats = 10;

// global reference to shuttle
var shuttle = null;

//points
var points = 0;

// load version 1 of the Google Earth API
google.load("earth", "1");

// load version 3 of the Google Maps API
google.load("maps", "3", {other_params: "sensor=false"});

// once the window has loaded
$(window).load(function() {

    // listen for keydown anywhere in body
    $(document.body).keydown(function(event) {
        return keystroke(event, true);
    });

    // listen for keyup anywhere in body
    $(document.body).keyup(function(event) {
        return keystroke(event, false);
    });

    // listen for click on Drop Off button
    $("#dropoff").click(function(event) {
        dropoff();
    });

    // listen for click on Pick Up button
    $("#pickup").click(function(event) {
        pickup();
    });

    // load application
    load();
});

// unload application
$(window).unload(function() {
    unload();
});

/**
 * Renders seating chart.
 */
function chart()
{
    var html = "<ol start='0'>";
    
    for (var i = 0; i < shuttle.seats.length; i++)
    {
        if (shuttle.seats[i] == null)
        {
            html += "<li>Free Seat </li>";
        }
        else
        {
            html += "<li>" + shuttle.seats[i] + " to " + shuttle.dropoff[i] + "</li>";
        }
    }
    html += "</ol>";
    $("#chart").html(html);
}

/**
 * Drops up passengers if their stop is nearby.
 */
function dropoff()
{
    for(var s in shuttle.seats)
    {
        if (shuttle.seats[s] != null)
        {
            var house = shuttle.dropoff[s];
            var lng = HOUSES[house].lng;
            var lat = HOUSES[house].lat;
            var distance = shuttle.distance(lat, lng);
           
            //if we have picked up everyone already, nothing else.
            if (points == PASSENGERS.length)
            {
                $('#announcements').html("All passengers dropped off!");
            }
            
            //if distance is less than 30,indicating a nearby building
            if(distance <= 30)
            {
                shuttle.seats[s] = null;
                shuttle.dropoff[s] = null;
                points ++;
                freeseats ++;
                $('#announcements').html("Passenger dropped off!"); 
            }
        }
    }
chart();
document.getElementById('points_div').innerHTML = points;
}

/**
 * Called if Google Earth fails to load.
 */
function failureCB(errorCode) 
{
    // report error unless plugin simply isn't installed
    if (errorCode != ERR_CREATE_PLUGIN)
    {
        alert(errorCode);
    }
}

/**
 * Handler for Earth's frameend event.
 */
function frameend() 
{
    shuttle.update();
}

/**
 * Called once Google Earth has loaded.
 */
function initCB(instance) 
{
    // retain reference to GEPlugin instance
    earth = instance;

    // specify the speed at which the camera moves
    earth.getOptions().setFlyToSpeed(100);

    // show buildings
    earth.getLayerRoot().enableLayerById(earth.LAYER_BUILDINGS, true);

    // disable terrain (so that Earth is flat)
    earth.getLayerRoot().enableLayerById(earth.LAYER_TERRAIN, false);

    // prevent mouse navigation in the plugin
    earth.getOptions().setMouseNavigationEnabled(false);

    // instantiate shuttle
    shuttle = new Shuttle({
        heading: HEADING,
        height: HEIGHT,
        latitude: LATITUDE,
        longitude: LONGITUDE,
        planet: earth,
        seats: SEATS,
        velocity: VELOCITY
    });


    // synchronize camera with Earth
    google.earth.addEventListener(earth, "frameend", frameend);

    // synchronize map with Earth
    google.earth.addEventListener(earth.getView(), "viewchange", viewchange);

    // update shuttle's camera
    shuttle.updateCamera();

    // show Earth
    earth.getWindow().setVisibility(true);

    // render seating chart
    chart();

    // populate Earth with passengers and houses
    populate();
    
    //start the timer
    CreateTimer("timer_div", 420);
    
}

/**
 * Handles keystrokes.
 */
function keystroke(event, state)
{
    // ensure we have event
    if (!event)
    {
        event = window.event;
    }

    // left arrow
    if (event.keyCode == 37)
    {
        shuttle.states.turningLeftward = state;
        return false;
    }

    // up arrow
    else if (event.keyCode == 38)
    {
        shuttle.states.tiltingUpward = state;
        return false;
    }

    // right arrow
    else if (event.keyCode == 39)
    {
        shuttle.states.turningRightward = state;
        return false;
    }

    // down arrow
    else if (event.keyCode == 40)
    {
        shuttle.states.tiltingDownward = state;
        return false;
    }

    // A, a
    else if (event.keyCode == 65 || event.keyCode == 97)
    {
        shuttle.states.slidingLeftward = state;
        return false;
    }

    // D, d
    else if (event.keyCode == 68 || event.keyCode == 100)
    {
        shuttle.states.slidingRightward = state;
        return false;
    }
  
    // S, s
    else if (event.keyCode == 83 || event.keyCode == 115)
    {
        shuttle.states.movingBackward = state;     
        return false;
    }

    // W, w
    else if (event.keyCode == 87 || event.keyCode == 119)
    {
        shuttle.states.movingForward = state;    
        return false;
    }
    
    //Q, q
    else if (event.keyCode == 81 || event.keyCode == 113)
    {
        VELOCITY = VELOCITY * 1.1;
        shuttle.velocity = VELOCITY;    
        return false;
    }
    
    //R, r
    else if (event.keyCode == 82 || event.keyCode == 114)
    {
        VELOCITY = VELOCITY - (VELOCITY * 1.1 - VELOCITY);
        shuttle.velocity = VELOCITY;
        return false;
    }
  
    return true;
}

/**
 * Loads application.
 */
function load()
{
    // embed 2D map in DOM
    var latlng = new google.maps.LatLng(LATITUDE, LONGITUDE);
    map = new google.maps.Map($("#map").get(0), {
        center: latlng,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        zoom: 17,
        zoomControl: true
    });

    // prepare shuttle's icon for map
    bus = new google.maps.Marker({
        icon: "https://maps.gstatic.com/intl/en_us/mapfiles/ms/micons/bus.png",
        map: map,
        title: "you are here"
    });

    // embed 3D Earth in DOM
    google.earth.createInstance("earth", initCB, failureCB);
}

/**
 * Picks up nearby passengers.
 */
function pickup()
{
    var features = earth.getFeatures();
    
    //iterate through all of the passengers
    for(var i in PASSENGERS)
    {
        //if the passengers placemark isn't null
        if (PASSENGERS[i].placemark != null)
        {
            //establish some useful local variablkes
            var lat = PASSENGERS[i].lat;
            var lng = PASSENGERS[i].lng;
            var m = PASSENGERS[i].marker;
            var placemark = PASSENGERS[i].placemark;
            var distance = shuttle.distance(lat, lng);
            //check is any passengers are nearby
            if(distance <= 15 && m !== null)
            {
                // ignore freshman
                if (PASSENGERS[i].house in HOUSES == false)
                {
                    $("#announcements").html("Sorry no freshman allowed.");
                    break;
                }
                
                //iterate through shuttle seats
                for(var s in shuttle.seats)
                {
                    //if we have an empty seat, add the passenger
                    if(shuttle.seats[s] == null && PASSENGERS[i].pickedup !== true)
                    {
                        PASSENGERS[i].pickedup = true;
                        shuttle.seats[s] = PASSENGERS[i].name
                        shuttle.dropoff[s] = PASSENGERS[i].house;
                        //remove marker
                        m.setMap(null);
                        //remove placemark
                        features.removeChild(placemark);
                        freeseats --;
                        $('#announcements').html("Passenger picked up!"); 
                    }
                    
                    else if (freeseats == 0)
                    {
                        $("#announcements").html("No free seats");
                    }
                }
            }
        }
    }
chart();
}

/**
 * Populates Earth with passengers and houses.
 */
function populate()
{
    // mark houses
    for (var house in HOUSES)
    {
        // plant house on map
        new google.maps.Marker({
            icon: "https://google-maps-icons.googlecode.com/files/home.png",
            map: map,
            position: new google.maps.LatLng(HOUSES[house].lat, HOUSES[house].lng),
            title: house
        });
    }

    // get current URL, sans any filename
    var url = window.location.href.substring(0, (window.location.href.lastIndexOf("/")) + 1);

    // scatter passengers
    for (var i = 0; i < PASSENGERS.length; i++)
    {
        // pick a random building
        var building = BUILDINGS[Math.floor(Math.random() * BUILDINGS.length)];

        // prepare placemark
        var placemark = earth.createPlacemark("");
        placemark.setName(PASSENGERS[i].name + " to " + PASSENGERS[i].house);

        // prepare icon
        var icon = earth.createIcon("");
        icon.setHref(url + "/img/" + PASSENGERS[i].username + ".jpg");

        // prepare style
        var style = earth.createStyle("");
        style.getIconStyle().setIcon(icon);
        style.getIconStyle().setScale(4.0);

        // prepare stylemap
        var styleMap = earth.createStyleMap("");
        styleMap.setNormalStyle(style);
        styleMap.setHighlightStyle(style);

        // associate stylemap with placemark
        placemark.setStyleSelector(styleMap);

        // prepare point
        var point = earth.createPoint("");
        point.setAltitudeMode(earth.ALTITUDE_RELATIVE_TO_GROUND);
        point.setLatitude(building.lat);
        point.setLongitude(building.lng);
        point.setAltitude(0.0);

        // associate placemark with point
        placemark.setGeometry(point);

        // add placemark to Earth
        earth.getFeatures().appendChild(placemark);

        // add marker to map
        var marker = new google.maps.Marker({
            icon: "https://maps.gstatic.com/intl/en_us/mapfiles/ms/micons/man.png",
            map: map,
            position: new google.maps.LatLng(building.lat, building.lng),
            title: PASSENGERS[i].name + " at " + building.name
        });

        // remember passenger's placemark and marker for pick-up's sake
        PASSENGERS[i].lat = building.lat;
        PASSENGERS[i].lng = building.lng;
        PASSENGERS[i].marker = marker;
        PASSENGERS[i].placemark = placemark;
        PASSENGERS[i].pickedup = false;
    }
}

/**
 * Handler for Earth's viewchange event.
 */
function viewchange() 
{
    // keep map centered on shuttle's marker
    var latlng = new google.maps.LatLng(shuttle.position.latitude, shuttle.position.longitude);
    map.setCenter(latlng);
    bus.setPosition(latlng);
}

/**
 * Unloads Earth.
 */
function unload()
{
    google.earth.removeEventListener(earth.getView(), "viewchange", viewchange);
    google.earth.removeEventListener(earth, "frameend", frameend);
}

/**
*TIMER
The four functions here create the time, ensure the timer counts down, updates the timer in the HTML and finally 
ensures the timer formats correctly with leading zeros. I used Google to help me a great deal with these
functions.
*/

function CreateTimer(TIMERID, Time) 
{
    Timer = document.getElementById(TIMERID);
    TotalSeconds = Time;

    UpdateTimer()
    window.setTimeout("timer()", 1000);
}

function timer() {
    if (TotalSeconds <= 0) 
    {
        alert("Time's up!")
        return;
    }
    TotalSeconds -= 1;
    UpdateTimer()
    window.setTimeout("timer()", 1000);
}



function UpdateTimer() 
{
    var Seconds = TotalSeconds;

    var Days = Math.floor(Seconds / 86400);
    Seconds -= Days * 86400;

    var Hours = Math.floor(Seconds / 3600);
    Seconds -= Hours * (3600);

    var Minutes = Math.floor(Seconds / 60);
    Seconds -= Minutes * (60);


    var TimeStr = ((Days > 0) ? Days + " days " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" + LeadingZero(Seconds)


    Timer.innerHTML = TimeStr;
}


function LeadingZero(Time) {

    return (Time < 10) ? "0" + Time : + Time;

}
