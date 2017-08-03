<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/1/2017
 * Time: 7:58 PM
 */

namespace vector\Geocoder;


class Geocoder
{
    const API_ENDPOINT = "https://maps.googleapis.com/maps/api/geocode/json";

    /**
     * @param $address
     * @return ResultAdapter[]
     */
    function search( $address ){
        $required = [
            'address' => strval($address),
            'key' => $this->api_key
        ];
        try {
            $googleData = self::getGoogleData($required);
        } catch (\HttpException $e) {
            return false;
        }

        $results = [];
        foreach ( $googleData['results'] as $result ){
            $results[] = new ResultAdapter( $result );
        }
        return $results;
    }

    function firstResult( $address ){
        $results = $this->search( $address );
        if( count( $results ) > 0 ){
            return $results[0];
        }
        return false;
    }

    /**
     * @param $queryArr array
     * @return bool|array
     */
    private static function getGoogleData ( $queryArr ) {
        $url = self::API_ENDPOINT . "?" . http_build_query($queryArr);
        $json = file_get_contents($url);
        return json_decode($json, true);
    }

    private $api_key;
    function __construct( $api_key )
    {
        $this->api_key = $api_key;
    }
}