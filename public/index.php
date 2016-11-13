<?php

if (stripos($_SERVER['HTTP_USER_AGENT'], 'curl') !== false
    || stripos($_SERVER['HTTP_USER_AGENT'], 'HTTPie') !== false
    || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && stripos($_SERVER['HTTP_X_REQUESTED_WITH'], 'XMLHttpRequest') !== false)
    ) {
    // No HTML in Xdebug's var_dump for curl, httpie or XMLHttpRequest
    ini_set("html_errors", 0);
}


// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
 
    ],
];
$app = new \Slim\App($config);

$app->get("/", function ($request, $response, $args) {

    $response->write("Hello World.");

    return $response;
});

// Run!
$app->run();
