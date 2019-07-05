# Firebase clould FCM API using
1. Go to [Google API Console](https://console.developers.google.com/) -> Crenedtials. In Service account keys block forward link Service Account Management/Manage service accounts.
2. Find your service and create key. Don’t forget to choose your project at top:
  ![alt text](doc1.png)
3. Create key for your service, choose json type.
4. You will need your downloaded conf file in PHP google api client in function setAuthConfig.
5. Install [Google API Client](https://github.com/googleapis/google-api-php-client).

### PHP code:
  ```
  $client = new Google_Client();
  $client->setAuthConfig('client_secrets.json');
  $client->setAccessType("offline");        // offline access
  $client->setIncludeGrantedScopes(true);   // incremental auth
  $client->addScope(array(
     "https://www.googleapis.com/auth/cloud-platform",
     "https://www.googleapis.com/auth/firebase.messaging")); // our scopes to use Firebase notifications api
  $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/index.php'); // redirect if need
  print_r($client->fetchAccessTokenWithAssertion()); // print access token or get to variable
```
1. Next we need to send post request to google api fcm. Docs here in tab recent.
2. Make curl request:
```
$url = 'https://fcm.googleapis.com/v1/projects/test-notifications-a0093/messages:send'; //test-notifications-a0093 it’s your app id in firebase project settings
$fields = [
    'message' => [
        'notification' => [
            'title' => 'test title 123123',
            'body' => 'test body asdasd',
        ],
        'data' => [
            'tab' => "2",
        ],
        'android' => [
            'collapse_key' => 'test',
            'priority' => 'high',
            'notification' => [
                'sound' => "default",
                'tag' => "new_messages",
            ],
        ],
        'topic' => 'all',
    ],
];
$fields = json_encode ( $fields );

$headers = array (
    'Authorization: Bearer ya29.c.ElzLBrmFbcZh7OZdlMvsHIg2ZhqZMjgD9NQ_..',// Baerer {token that you got from google clinet}
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
```
