<?php

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

require_once(__DIR__ . '/vendor/autoload.php');
include_once('header.php');

$job_id = 0;

while (true) {
    $jobArray = [
        'id' => $job_id++,
        'task' => 'sleep',
        'sleep_period' => rand(0, 3)
    ];

    $msg = new AMQPMessage(
        json_encode($jobArray, JSON_UNESCAPED_SLASHES),
        [
            'delivery_mode' => 2
        ]
    );

    $channel->basic_publish($msg, '', RABBITMQ_QUEUE_NAME);
    print 'Job created' . PHP_EOL;
    sleep(1);
}
