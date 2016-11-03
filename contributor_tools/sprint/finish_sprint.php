<?php

date_default_timezone_set('America/New_York');

$repo = $argv[1];
$token = $argv[2];
$sprint_project_id = $argv[3];

include 'common.php';

$ch = createCurlRequest("projects/$sprint_project_id/columns");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  return;
}
$columns = json_decode($server_output, TRUE);

// Map column names to ids
$column_name_to_id = array();
foreach ($columns as $column) {
  $column_name_to_id[$column['name']] = $column['id'];
}

echo "Moving any closed issues to the Done column...\n";
foreach ($columns as $column) {
  if ($column['name'] == 'Done') {
    continue;
  }
  // Fetch all cards in this column...
  $ch = createCurlRequest("projects/columns/".$column['id']."/cards");
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    return;
  }
  $cards = json_decode($server_output, TRUE);
  foreach ($cards as $card) {
    // Get the card's content object...
    $api_url = str_replace('https://api.github.com/', '', $card['content_url']);
    $ch = createCurlRequest($api_url);
    $server_output = curl_exec($ch);
    curl_close($ch);
    if (!checkCurlResponse($server_output)) {
      return;
    }
    $issue = json_decode($server_output, TRUE);

    if ($issue['state'] == 'closed') {
      echo "- Moving issue #".$issue['number']." to Done column...\n";
      $ch = createDataRequest("projects/columns/cards/".$card['id']."/moves", array(
        'position' => "top",
        'column_id' => $column_name_to_id['Done']
      ));
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      $server_output = curl_exec($ch);
      curl_close($ch);
      if (!checkCurlResponse($server_output)) {
        exit(1);
      }
    }
  }
}

$end_date = date('Y-m-d');
// TODO: Extract from Project description.
$start_date = date("Y-m-d", strtotime("-1 week"));

$archive_name = "sprint: $start_date to $end_date";

// Fetch existing projects...
$ch = createCurlRequest("repos/$repo/projects");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  return;
}
$projects = json_decode($server_output, TRUE);

$archive_project = null;
foreach ($projects as $project) {
  if ($project['name'] == $archive_name) {
    $archive_project = $project;
    break;
  }
}

// Couldn't find the archive project...
if (!$archive_project) {
  echo "Creating sprint archive...\n";
  $ch = createDataRequest("repos/$repo/projects", array(
    'name' => $archive_name
  ));
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    exit(1);
  }
  $archive_project = json_decode($server_output, TRUE);
}

echo "- Creating Done column...\n";
$ch = createDataRequest("projects/".$archive_project['id']."/columns", array(
  'name' => 'Done'
));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  exit(1);
}

// Get the archive project's columns...
$ch = createCurlRequest("projects/".$archive_project['id']."/columns");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  return;
}
$columns = json_decode($server_output, TRUE);

// We assume the archive project only has one column: "Done"
$done_column = $columns[0];

// Get all of the current sprint's Done cards...
$ch = createCurlRequest("projects/columns/".$column_name_to_id['Done']."/cards");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  return;
}
$cards = json_decode($server_output, TRUE);

// For every Done card...
foreach ($cards as $card) {
  // Get the card's content object...
  $api_url = str_replace('https://api.github.com/', '', $card['content_url']);
  $ch = createCurlRequest($api_url);
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    return;
  }
  $issue = json_decode($server_output, TRUE);

  echo "- Moving card for issue #".$issue['number']."...\n";
  $ch = createDataRequest("projects/columns/".$done_column['id']."/cards", array(
    'content_id' => intval($issue['id']),
    'content_type' => "Issue"
  ));
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    exit(1);
  }

  $ch = createCurlRequest("projects/columns/cards/".$card['id']);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  $server_output = curl_exec($ch);
  curl_close($ch);
  if (!checkCurlResponse($server_output)) {
    exit(1);
  }
}

echo "Updating project description...\n";
$ch = createDataRequest("projects/".$archive_project['id'], array(
  'name' => $archive_name,
  'body' => ((count($cards) == 1) ? "1 task completed" : count($cards)." tasks completed")
));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
$server_output = curl_exec($ch);
curl_close($ch);
if (!checkCurlResponse($server_output)) {
  exit(1);
}
