<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class Ticketmastertext extends BaseTestCase
{

    public function testListMetrics()
    {

        $routes = [
            'completeCartPurchase',
            'emptyCart',
            'getOptions',
            'getPayments',
            'addPaymentsToCart',
            'addDeliveriesToCart',
            'getDeliveries',
            'updateCartProducts',
            'createCart',
            'getSingleCart',
            'getEventOffers',
            'getSingleVenue',
            'searchVenues',
            'getSingleSubGenre',
            'getSingleSegment',
            'getSingleGenre',
            'getSingleClassification',
            'searchClassification',
            'getSingleAttraction',
            'searchAttractions',
            'getSingleEventImages',
            'getSingleEvent',
            'searchEvents',
            'createEvents',
            'refreshAccessToken',
            'getUser',
            'getAccessToken'

        ];

        foreach ($routes as $file) {
            $var = '{  
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/Ticketmaster/' . $file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in ' . $file . ' method');
        }
    }

}
