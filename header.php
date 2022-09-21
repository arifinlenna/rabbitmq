<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;


define("RABBITMQ_HOST", 'rabbitmq');
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USERNAME", 'guest');
define("RABBITMQ_PASSWORD", 'guest');
define("RABBITMQ_QUEUE_NAME", 'task_queue');

$connection = new AMQPStreamConnection(
    RABBITMQ_HOST,
    RABBITMQ_PORT,
    RABBITMQ_USERNAME,
    RABBITMQ_PASSWORD,
);

$channel = $connection->channel();

$channel->queue_declare(
    $queue = RABBITMQ_QUEUE_NAME,
    $passive = false,
    $durable = true,
    $exclusive = false,
    $auto_delete = false,
    $nowait = false,
    $arguments = null,
    $ticket = null
);
