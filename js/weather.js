//let latitude,longitude,posit;
   /*navigator.geolocation.getCurrentPosition(function(position){
        latitude=position.coords.latitude;
        longitude=position.coords.longitude;
        posit=position.coords.latitude+','+ position.coords.longitude;
        //alert(posit);
        loadWeather(posit);*/
//function geytUpdate(){
//    loadWeather(posit);
//}




  /*  getUpdate();
   }else{
    ;
}

*/

$(function(){
    (("geolocation" in navigator) ? getUpdate() : loadWeather("Local ,IN ",""));
   // alert("hi");
    
     setInterval(getUpdate,10000);
});


function loadWeather(location,woeid){
    //alert("You are going good");
    $.simpleWeather({
        location:location,
        woeid:woeid,
        unit:'c',
        success:function(weather){
            //alert("hkdkkdi");
            country=weather.country;
            city=weather.city;
            low=weather.low;
            high=weather.high;
            temp=weather.temp+'&deg;';
            wcode='<img class="wheathericon" src="images/weathericons/'+weather.code+'.svg">';
            wind= '<p>' + weather.wind.speed + '</p> <p>'+weather.units.speed + '</p>';
            //alert(wind);
            humidity=weather.humidity+"%";
            $('.location').text(city);
            $('.temperature').html(temp);
            $('.climate_bg').html(wcode);
            $('.windspeed').html(wind);
            $('.humidity').text(humidity); 
            
            $('#city').text(city+',');
            $('#cntr').html(' '+country);
            $("#wecode").html(wcode);
            $('#temp').html(temp+'C');
            $('#wind').html( weather.wind.speed);
            $('#humid').html(humidity);
          
            
        },
        
        error:function(error){
            $('.error').html('<p>'+error+'</p>');
        }
        
        
    });
}

function getUpdate(){
    navigator.geolocation.getCurrentPosition(function(position){
        loadWeather(position.coords.latitude+','+ position.coords.longitude);
    });
    
}

