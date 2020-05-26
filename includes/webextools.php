<?php

/*
DESCRIPTION: Calls to the Webex Teams REST API
*/

# Get all the information about a particular message on Webex Teams
function get_message($access_token, $message_id){
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ciscospark.com/v1/messages/{$message_id}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer {$access_token}"
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  $message_data = json_decode($response);
  return $message_data;
}


# Send a custom message in markdown format to a particular room
function send_answer($access_token, $room_id, $answer){
  $curl = curl_init();

  $body = '{"roomId": "'.$room_id.'", "markdown": "'.$answer.'"}';
  echo $body;

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ciscospark.com/v1/messages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
      "Authorization: Bearer {$access_token}",
      "Content-Type: text/plain"
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
}

?>
