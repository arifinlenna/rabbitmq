<?php

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

require_once(__DIR__ . '/vendor/autoload.php');
include_once('header.php');

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function ($msg) {
    echo " [x] Received ", $msg->body, "\n";
    $job = json_decode($msg->body, $assocForm = true);
    sleep($job['sleep_period']);
    echo " [x] Done", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);

$channel->basic_consume(
    $queue = RABBITMQ_QUEUE_NAME,
    $consumer_tag = '',
    $no_local = false,
    $no_ack = false,
    $exclusive = false,
    $nowait = false,
    $callback
);
print_r($channel);
die;
while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();
