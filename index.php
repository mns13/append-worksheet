<?php
require_once __DIR__. "/vendor/autoload.php";

$client = new Google_Client();
$client->setAuthConfig(__DIR__.'/credentials.json');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1FS5_xR8YqkBnQPBtL2-r5ieNik-QOVILke5GWnxHovM';
$params = [
  'includeGridData'=>true
];

$response = $service->spreadsheets->get($spreadsheetId, $params);

$rows = $response->getSheets()[0]->data[0]->rowData;

for ($i=2; $i < count($rows); $i = $i+3) {
  $values = array();

    $data = $rows[$i]->values;

    foreach($data as $row){

      $values[0][] = $row->formattedValue;

    }
    
  $requestBody = new Google_Service_Sheets_ValueRange(['values' => $values]);
  $options = array( 'valueInputOption' => 'RAW' );
  if($service->spreadsheets_values->append( $spreadsheetId, 'List2', $requestBody, $options )) echo 1;

  $values = array();

}