<?php

function httpHeader() {
  global $token;
  return array(
    "Authorization: token ".$token,
    "Accept: application/vnd.github.inertia-preview+json",
    "Content-Type: application/json"
  );
}

function createCurlRequest($query) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.github.com/$query");
  curl_setopt($ch, CURLOPT_USERAGENT, 'mdm-configurator');
  curl_setopt($ch, CURLOPT_HTTPHEADER, httpHeader());
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  return $ch;
}

function createDataRequest($query, $data) {
  $json = json_encode($data);
  $ch = createCurlRequest($query);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  return $ch;
}

function checkCurlResponse($server_output) {
  if (!$server_output) {
    return true;
  }
  $result = json_decode($server_output, TRUE);
  switch(json_last_error()) {
      case JSON_ERROR_NONE:
      break;
      default:
      return false;
  }
  if (array_key_exists('message', $result)) {
    echo "github: API request failed with message ".$result['message']."\n";
    print_r($result);
    return false;
  }
  return true;
}
