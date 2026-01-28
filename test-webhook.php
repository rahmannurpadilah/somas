<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Sample Apify webhook payload
$payload = [
    'resource' => [
        'defaultDatasetId' => 'e2C0Dq7wv4vI9LBar' // Dataset dari Apify run terakhir
    ]
];

$request = \Illuminate\Http\Request::create(
    '/api/webhook/apify?source_id=15',
    'POST',
    [],
    [],
    [],
    [],
    json_encode($payload)
);

$request->headers->set('Content-Type', 'application/json');

try {
    $response = $kernel->handle($request);
    echo "Response: " . $response->getContent() . "\n";
    echo "Status: " . $response->getStatusCode() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

$kernel->terminate($request, $response);
