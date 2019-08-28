<?php

$port = $argv[1];
$http = new Swoole\Http\Server("0.0.0.0", $port);

$http->on("start", function ($server) use($port) {
    echo "Swoole http server is started at " . $port . "\n";
});

$http->on("request", function ($request, $response) {
    $filename = '/data/logs/swoole/access.log';
    $log_cont = date('Y-m-d H:i:s') . ' ' . json_encode($request->server) . PHP_EOL;
    go (function () use ($filename, $log_cont) {
        file_put_contents($filename, $log_cont, FILE_APPEND);
    });

    $response->header("Content-Type", "text/plain");
    $response->end("Hello World\n");
});

$http->start();
