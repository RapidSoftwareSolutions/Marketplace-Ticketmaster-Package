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
    $body['latlong'] = $post_data['args']['latLong'];
    $body['radius'] = $post_data['args']['radius'];
    $body['startDateTime'] = $post_data['args']['startDateTime'];
    $body['endDateTime'] = $post_data['args']['endDateTime'];
    $body['onsaleStartDateTime'] = $post_data['args']['onsaleStartDateTime'];
    $body['onsaleEndDateTime'] = $post_data['args']['onsaleEndDateTime'];
    $body['countryCode'] = $post_data['args']['countryCode'];
    $body['stateCode'] = $post_data['args']['stateCode'];
    $body['venueId'] = $post_data['args']['venueId'];
    $body['attractionId'] = $post_data['args']['attractionId'];
    $body['segmentId'] = $post_data['args']['segmentId'];
    $body['segmentName'] = $post_data['args']['segmentName'];
    $body['classificationName'] = $post_data['args']['classificationName'];
    $body['classificationId'] = $post_data['args']['classificationId'];
    $body['marketId'] = $post_data['args']['marketId'];
    $body['promoterId'] = $post_data['args']['promoterId'];
    $body['dmaId'] = $post_data['args']['dmaId'];
    $body['includeTBA'] = $post_data['args']['includeTBA'];
    $body['includeTBD'] = $post_data['args']['includeTBD'];
    $body['clientVisibility'] = $post_data['args']['clientVisibility'];
    $body['keyword'] = $post_data['args']['keyword'];
    if (isset($post_data['args']['eventId']) && strlen($post_data['args']['eventId']) > 0) {
        $body['id'] = $post_data['args']['eventId'];
    }
    $body['source'] = $post_data['args']['source'];
    $body['includeTest'] = $post_data['args']['includeTest'];
    if (isset($post_data['args']['pageNumber']) && strlen($post_data['args']['pageNumber']) > 0) {
        $body['page'] = $post_data['args']['pageNumber'];
    }
    if (isset($post_data['args']['pageSize']) && strlen($post_data['args']['pageSize']) > 0) {
        $body['size'] = $post_data['args']['pageSize'];
    }
    $body['locale'] = $post_data['args']['locale'];

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