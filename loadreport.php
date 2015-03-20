#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Att\M2X\M2X;

function loadAvg() {
  $pattern = '/(\d+\.\d+),? (\d+\.\d+),? (\d+\.\d+)$/';
  preg_match($pattern, shell_exec('uptime'), $matches);
  array_shift($matches);
  return $matches;
}

echo "Starting loadreport.php run\r\n";

$deviceName = 'loadreport-heroku';
$apiKey = getenv('M2X_API_KEY');

try {
  if (!$apiKey) {
    throw new Exception('Missing M2X_API_KEY environment variable');
  }

  $client = new M2X($apiKey);

  //Search for the load report device
  $device = null;
  $devices = $client->devices(array('q' => $deviceName));
  foreach ($devices as $d) {
    if ($d->name == $deviceName) {
      $device = $d;
      break;
    }
  }

  //Create load report device if it was not found
  if (!$device) {
    $data = array(
      'name' => $deviceName,
      'description' => 'Heroku Load Report',
      'visibility' => 'private'
    );
    $device = $client->createDevice($data);
  }

  //Create streams if they did not exist
  $device->updateStream('load_1m');
  $device->updateStream('load_5m');
  $device->updateStream('load_15m');

  list($load_1m, $load_5m, $load_15m) = loadAvg();
  $now = date('c');

  $values = array(
    'load_1m'  => array(array('value' => $load_1m,  'timestamp' => $now)),
    'load_5m'  => array(array('value' => $load_5m,  'timestamp' => $now)),
    'load_15m' => array(array('value' => $load_15m, 'timestamp' => $now))
  );

  $device->postUpdates($values);

} catch (Exception $ex) {
  echo sprintf("Exception: %s\r\n", $ex->getMessage()); 
}

echo "Ending loadreport.php run\r\n";
