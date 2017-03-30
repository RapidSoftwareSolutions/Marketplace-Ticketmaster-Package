<?php
$app->post('/api/Ticketmaster/createEvents', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    //forming request to vendor API
    $query_str = $settings['api_url'] . 'publish/v2/events?apikey=' . $post_data['args']['accessToken'];


    $body = array();

    $body['active'] = $post_data['args']['active'];
    $body['additionalInfos'] = $post_data['args']['additionalInfos'];
    $body['attractions'] = $post_data['args']['attractions'];
    $body['classifications'] = $post_data['args']['classifications'];
    $body['dates']['start'] = $post_data['args']['startDate'];
    $body['dates']['access'] = $post_data['args']['accessDate'];
    $body['dates']['end'] = $post_data['args']['endDate'];
    $body['dates']['timezone'] = $post_data['args']['timezoneDate'];
    $body['descriptions'] = $post_data['args']['descriptions'];
    $body['infos'] = $post_data['args']['infos'];
    $body['images'] = $post_data['args']['images'];
    $body['names'] = $post_data['args']['names'];
    $body['place']['names'] = $post_data['args']['placeNames'];
    $body['place']['address']['line1s'] = $post_data['args']['placeAddressLine1'];
    $body['place']['address']['line2s'] = $post_data['args']['placeAddressLine2'];
    $body['place']['area']['names'] = $post_data['args']['placeAreaNames'];
    $body['place']['city']['names'] = $post_data['args']['placeCityNames'];
    $body['place']['country']['countryCode'] = $post_data['args']['placeCountryCode'];
    $body['place']['country']['names'] = $post_data['args']['placeCountryNames'];
    $body['place']['location']['latitude'] = $post_data['args']['placeLatitude'];
    $body['place']['location']['longitude'] = $post_data['args']['placeLongitude'];
    $body['place']['postlcode'] = $post_data['args']['placePostalcode'];
    $body['place']['state']['names'] = $post_data['args']['placeStateNames'];
    $body['place']['state']['stateCode'] = $post_data['args']['placeStateCode'];
    $body['pleaseNotes'] = $post_data['args']['pleaseNotes'];
    $body['priceRanges']['type'] = $post_data['args']['priceRangesType'];
    $body['priceRanges']['currency'] = $post_data['args']['priceRangesCurrency'];
    $body['priceRanges']['min'] = $post_data['args']['priceRangesMin'];
    $body['priceRanges']['max'] = $post_data['args']['priceRangesMax'];
    $body['promoter']['id'] = $post_data['args']['promoterId'];
    $body['promoter']['names'] = $post_data['args']['promoterNames'];
    $body['promoter']['descriptions'] = $post_data['args']['promoterDescriptions'];
    $body['publicVisibility']['startDateTime'] = $post_data['args']['publicVisibilityStart'];
    $body['publicVisibility']['endDateTime'] = $post_data['args']['publicVisibilityEnd'];
    $body['publicVisibility']['visible'] = $post_data['args']['publicVisibilityState'];
    $body['sales']['public']['endDateTime'] = $post_data['args']['publicSalesEnd'];
    $body['sales']['public']['startDateTime'] = $post_data['args']['publicSalesStart'];
    $body['sales']['public']['startTBD'] = $post_data['args']['publicSalesTBD'];
    $body['source']['id'] = $post_data['args']['sourceId'];
    $body['source']['name'] = $post_data['args']['sourceName'];
    $body['test'] = $post_data['args']['test'];
    $body['url'] = $post_data['args']['url'];
    $body['venue'] = $post_data['args']['venue'];
    $body['version'] = $post_data['args']['version'];

    //requesting remote API
    $client = new GuzzleHttp\Client();

//    var_dump( $resp = $client->request('POST', $query_str, [
//        'debug'=>true,
//        'json' => $body
//    ]));
//    exit();
    try {

        $resp = $client->request('POST', $query_str, [
            'json' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());
        $all_data[] = $rawBody;

        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});