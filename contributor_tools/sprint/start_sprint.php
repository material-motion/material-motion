<?php

date_default_timezone_set('America/New_York');

$repo = $argv[1];
$token = $argv[2];

include 'common.php';

echo "Creating sprint...\n";
$ch = createDataRequest("repos/$repo/projects", array(
  'name' => "Current sprint",
  'body' => "Sprint start date: ".date('Y-n-d')
));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  exit(1);
}
$project = json_decode($server_output, TRUE);

$project_number = $project['number'];

function createColumn($name) {
  global $repo;
  global $project_number;
  echo "Creating column $name...\n";
  $ch = createDataRequest("repos/$repo/projects/$project_number/columns", array(
    'name' => $name
  ));
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    exit(1);
  }
}

createColumn('Backlog');
createColumn('Ready');
createColumn('In Progress');
createColumn('In Review');
createColumn('Done');

