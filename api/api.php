<?php

/**
 * base class for api usage
 * in a larger application this would have more functions (post, delete, etc),
 * but for the purposes of this project it just has a get function
 */
class api {
    
    public const apiKey = "";
    
    public function get ( $url )
    {
        
        $curl = curl_init( $url );
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
        
    }
    
}

