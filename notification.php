<?php

require __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->setAccessType("offline");        // offline access
$client->setIncludeGrantedScopes(true);   // incremental auth
$client->addScope(array("https://www.googleapis.com/auth/cloud-platform", "https://www.googleapis.com/auth/firebase.messaging"));
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/index.php');
print_r($client->fetchAccessTokenWithAssertion());





    $url = 'https://fcm.googleapis.com/v1/projects/test-notifications-a0093/messages:send';

    $fields = array (
        'message' => array(
            'token' => 'erU73MMtRfA:APA91bHQerXJ_933hpORmiQr9TZpT2s9lJvkImiXHeZCvG2XNzdiMNRI9R26CD8GaRA3PdVjwsfi29DZ0ifoPfvxwbFzJ4SiFkOf9LBQT_5-wkrRa4ST66g3toHimMyoEiibLWXCcruH',
            'notification' => array(
                'title' => 'test title',
                'body' => 'test body'
            ),
            'android' => array(
                'collapse_key' => 'test',
                'priority' => 'high',
                'notification' => array(
                    'sound' => "default"
                )

            ),
            //'topic' => 'all'
        )
    );

    $fields = json_encode ( $fields );

    $headers = array (
        'Authorization: Bearer ya29.c.ElzLBiOYW-UVL8LWHlFDtH0c9AWflz_saKRERz4kpQ4QtWJ6K_h2Bo9nHJ8duBmbgHtwid9eMYcNdYKecw7GEQ-lSc46hkNntNFWsnE1hs9tgEBjGPYxVieXMGif6w',
        'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    echo $result;
    curl_close ( $ch );

