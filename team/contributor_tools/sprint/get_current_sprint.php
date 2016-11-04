<?php

$repo = $argv[1];
$token = $argv[2];

include 'common.php';

// MAIN script logic

// Get teams
$ch = createCurlRequest("repos/$repo/projects");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  return;
}

$projects = json_decode($server_output, TRUE);

foreach ($projects as $project) {
  if ($project['name'] == 'Current sprint') {
    echo str_replace("https://api.github.com/projects/", "", $project['url'])."\n";
    exit(0);
  }
}

exit(1);

