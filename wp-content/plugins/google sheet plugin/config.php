<?php
require "vendor/autoload.php";

$client = new Google_Client();
$client->setApplicationName("Google Sheet Plugin");
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType("offline");
$client->setAuthConfig(wp_upload_dir()['path'].'/credentials.json');

$service = new Google_Service_Sheets($client);



function highlight($spreadsheetId)
{
	echo "Done";
	$myRange = [
		'sheetId' => 0,
		'startRowIndex' => 1,
		'endRowIndex' => 11,
		'startColumnIndex' => 0,
		'endColumnIndex' => 4,
	];

	$requests = [
		new Google_Service_Sheets_Request([
			'addConditionalFormatRule' => [
				'rule' => [
					'ranges' => [$myRange],
					'booleanRule' => [
						'condition' => [
							'type' => 'CUSTOM_FORMULA',
							'values' => [['userEnteredValue' => '=GT($D2,median($D$2:$D$11))']]
						],
						'format' => [
							'textFormat' => ['foregroundColor' => ['red' => 0.8]]
						]
					]
				],
				'index' => 0
			]
		]),
		new Google_Service_Sheets_Request([
			'addConditionalFormatRule' => [
				'rule' => [
					'ranges' => [$myRange],
					'booleanRule' => [
						'condition' => [
							'type' => 'CUSTOM_FORMULA',
							'values' => [['userEnteredValue' => '=LT($D2,median($D$2:$D$11))']]
						],
						'format' => [
							'backgroundColor' => ['red' => 1, 'green' => 0.4, 'blue' => 0.4]
						]
					]
				],
				'index' => 0
			]
		])
	];

	$batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
		'requests' => $requests
	]);
	$response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
	printf("%d cells updated.", count($response->getReplies()));
	return $response;
}
