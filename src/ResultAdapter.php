<?php

namespace vector\Geocoder;


class ResultAdapter {

    /**
     * @return Coordinate
     */
    public function getCoordinate() {
        return $this->coordinate;
    }

    /**
     * @param $component string
     */
    public function getAddressComponents($search) {
        $results = [];
        foreach ($this->addressComponents as $component) {
            $types = $component['types'];
            if (in_array($search, $types)) {
                $results[] = $component;
            }
        }
        return $results;
    }

    /**
     * @return string
     */
    public function getFormattedAddress() {
        return $this->formattedAddress;
    }

    public function getPlaceID() {
        return $this->placeID;
    }

    /**
     * @return bool|string
     */
    public function getStreetNumber() {
        $results = $this->getAddressComponents('street_number');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getStreet() {
        $results = $this->getAddressComponents('route');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getCity() {
        $results = $this->getAddressComponents('locality');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getCounty() {
        $results = $this->getAddressComponents('administrative_area_level_2');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getState() {
        $results = $this->getAddressComponents('administrative_area_level_1');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getCountry() {
        $results = $this->getAddressComponents('country');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public function getZipCode() {
        $results = $this->getAddressComponents('postal_code');
        if (count($results) === 0) {
            return false;
        }
        return self::getShortName($results[0]);
    }

    /**
     * @return bool|string
     */
    public static function getShortName($addressComponent) {
        return $addressComponent['short_name'];
    }

    protected $googleResult;
    private $addressComponents;
    private $formattedAddress;
    private $placeID;
    private $coordinate;

    function __construct($googleResult) {
        // Depends on..
        // Google Geocoder API: https://developers.google.com/maps/documentation/geocoding/start
        $this->googleResult = $googleResult;
        $this->formattedAddress = $googleResult['formatted_address'];
        $this->placeID = $googleResult['place_id'];
        $this->addressComponents = $googleResult['address_components'];
        $lat = $googleResult['geometry']['location']['lat'];
        $lng = $googleResult['geometry']['location']['lng'];
        $this->coordinate = new Coordinate($lat, $lng);
    }
}
