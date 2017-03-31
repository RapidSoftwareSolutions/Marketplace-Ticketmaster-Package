<?php
$app->post('/api/Ticketmaster/searchEvents', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    //forming request to vendor API
    $query_str = $settings['api_url'] . 'discovery/v2/events.json';
    $body = array();
    $body['apikey'] = $post_data['args']['apiKey'];
    if (isset($post_data['args']['sort']) && strlen($post_data['args']['sort']) > 0) {
        $body['sort'] = $post_data['args']['sort'];
    }
    if (isset($post_data['args']['latLong']) && strlen($post_data['args']['latLong']) > 0) {
        $body['latlong'] = $post_data['args']['latLong'];
    }
    if (isset($post_data['args']['radius']) && strlen($post_data['args']['radius']) > 0) {
        $body['radius'] = $post_data['args']['radius'];
    }
    if (isset($post_data['args']['startDateTime']) && strlen($post_data['args']['startDateTime']) > 0) {
        $body['startDateTime'] = $post_data['args']['startDateTime'];
    }
    if (isset($post_data['args']['endDateTime']) && strlen($post_data['args']['endDateTime']) > 0) {
        $body['endDateTime'] = $post_data['args']['endDateTime'];
    }
    if (isset($post_data['args']['onsaleStartDateTime']) && strlen($post_data['args']['onsaleStartDateTime']) > 0) {
        $body['onsaleStartDateTime'] = $post_data['args']['onsaleStartDateTime'];
    }
    if (isset($post_data['args']['onsaleEndDateTime']) && strlen($post_data['args']['onsaleEndDateTime']) > 0) {
        $body['onsaleEndDateTime'] = $post_data['args']['onsaleEndDateTime'];
    }
    if (isset($post_data['args']['countryCode']) && strlen($post_data['args']['countryCode']) > 0) {
        $body['countryCode'] = $post_data['args']['countryCode'];
    }
    if (isset($post_data['args']['stateCode']) && strlen($post_data['args']['stateCode']) > 0) {
        $body['stateCode'] = $post_data['args']['stateCode'];
    }
    if (isset($post_data['args']['venueId']) && strlen($post_data['args']['venueId']) > 0) {
        $body['venueId'] = $post_data['args']['venueId'];
    }
    if (isset($post_data['args']['attractionId']) && strlen($post_data['args']['attractionId']) > 0) {
        $body['attractionId'] = $post_data['args']['attractionId'];
    }
    if (isset($post_data['args']['segmentId']) && strlen($post_data['args']['segmentId']) > 0) {
        $body['segmentId'] = $post_data['args']['segmentId'];
    }
    if (isset($post_data['args']['segmentName']) && strlen($post_data['args']['segmentName']) > 0) {
        $body['segmentName'] = $post_data['args']['segmentName'];
    }
    if (isset($post_data['args']['classificationName']) && strlen($post_data['args']['classificationName']) > 0) {
        $body['classificationName'] = $post_data['args']['classificationName'];
    }
    if (isset($post_data['args']['classificationId']) && strlen($post_data['args']['classificationId']) > 0) {
        $body['classificationId'] = $post_data['args']['classificationId'];
    }
    if (isset($post_data['args']['marketId']) && strlen($post_data['args']['marketId']) > 0) {
        $body['marketId'] = $post_data['args']['marketId'];
    }
    if (isset($post_data['args']['promoterId']) && strlen($post_data['args']['promoterId']) > 0) {
        $body['promoterId'] = $post_data['args']['promoterId'];
    }
    if (isset($post_data['args']['dmaId']) && strlen($post_data['args']['dmaId']) > 0) {
        $body['dmaId'] = $post_data['args']['dmaId'];
    }
    if (isset($post_data['args']['includeTBA']) && strlen($post_data['args']['includeTBA']) > 0) {
        $body['includeTBA'] = $post_data['args']['includeTBA'];
    }
    if (isset($post_data['args']['includeTBD']) && strlen($post_data['args']['includeTBD']) > 0) {
        $body['includeTBD'] = $post_data['args']['includeTBD'];
    }
    if (isset($post_data['args']['clientVisibility']) && strlen($post_data['args']['clientVisibility']) > 0) {
        $body['clientVisibility'] = $post_data['args']['clientVisibility'];
    }
    if (isset($post_data['args']['keyword']) && strlen($post_data['args']['keyword']) > 0) {
        $body['keyword'] = $post_data['args']['keyword'];
    }
    if (isset($post_data['args']['eventId']) && strlen($post_data['args']['eventId']) > 0) {
        $body['id'] = $post_data['args']['eventId'];
    }
    if (isset($post_data['args']['source']) && strlen($post_data['args']['source']) > 0) {
        $body['source'] = $post_data['args']['source'];
    }
    if (isset($post_data['args']['includeTest']) && strlen($post_data['args']['includeTest']) > 0) {
        $body['includeTest'] = $post_data['args']['includeTest'];
    }
    if (isset($post_data['args']['pageNumber']) && strlen($post_data['args']['pageNumber']) > 0) {
        $body['page'] = $post_data['args']['pageNumber'];
    }
    if (isset($post_data['args']['pageSize']) && strlen($post_data['args']['pageSize']) > 0) {
        $body['size'] = $post_data['args']['pageSize'];
    }
    if (isset($post_data['args']['locale']) && strlen($post_data['args']['locale']) > 0) {
        $body['locale'] = $post_data['args']['locale'];
    }

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('GET', $query_str, [
            'query' => $body
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