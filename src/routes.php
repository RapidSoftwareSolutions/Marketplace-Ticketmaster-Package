       <?php
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
        'getAccessToken',
        'metadata'
       ];
       foreach ($routes as $file) {
           require __DIR__ . '/../src/routes/' . $file . '.php';
       }

