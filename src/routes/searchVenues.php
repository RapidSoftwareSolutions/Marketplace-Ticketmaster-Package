<?php
$app->post('/api/Ticketmaster/searchVenues', function ($request, $response, $args) {
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
    $query_str = $settings['api_url'] . 'discovery/v2/venues.json';
    $body = array();
    $body['apikey'] = $post_data['args']['apiKey'];

    $body['sort'] = $post_data['args']['sort'];

    $body['countryCode'] = $post_data['args']['countryCode'];
    $body['stateCode'] = $post_data['args']['stateCode'];

    $body['keyword'] = $post_data['args']['keyword'];

    $body['id'] = $post_data['args']['venueId'];
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