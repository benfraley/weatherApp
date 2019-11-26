<?php

include "locationsApi.php";

/**
 * This is the page I'm using to make http requests to and then invoking the api
 * given more time I would lock this down a little more
 */
$api = new locationsApi();

// search for city using autocomplete
if(isset($_GET['search']))
{
    echo $api->autoComplete($_GET['search']);
}
elseif(isset($_GET['cityCode'])) // get the forecast data for the city selected
{
    echo $api->getWeatherData($_GET['cityCode']);
}