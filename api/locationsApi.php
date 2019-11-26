<?php

session_start();
require "api.php";

/**
 * class to invoke the api base class and then call the accuweather api
 */
class locationsApi extends api {
    
    public function autoComplete( $search )
    {
        
        $url = "http://dataservice.accuweather.com/locations/v1/cities/autocomplete";
        
        $url .= "?apikey=" . parent::apiKey;
        $url .= "&q=" . urlencode($search);
        $url .= "&language=" . urlencode("en-us");
        
        header('Content-Type: application/json');
        return $this->get($url);
        
    }
    
    public function getWeatherData( $key )
    {
        
        // if they weather data is found stored in the session cache, we'll use that rather than looking it up
        if(isset($_SESSION['weatherData'][$key]))
        {
            header('Content-Type: application/json');
            return $_SESSION['weatherData'][$key];
        }
        
        $url = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/" . urlencode($key);
        $url .= "?apikey=" . parent::apiKey;
        
        // get the weather data
        $weatherData = $this->get($url);
        
        // store the weather data for later use
        $_SESSION['weatherData'][$key] = $weatherData;
        
        header('Content-Type: application/json');
        return $weatherData;
        
    }
    
}

