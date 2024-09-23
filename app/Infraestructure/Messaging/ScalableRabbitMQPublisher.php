<?php 
namespace App\Infrastructure\Messaging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;

class ScalableRabbitMQPublisher
{
    protected $connection;
    protected $channel;
    protected $rabbitEnabled;

    public function __construct()
    {
        // Check if RabbitMQ is enabled from environment config
        $this->rabbitEnabled = env('RABBITMQ_ENABLED', false);

        if ($this->rabbitEnabled) {
            $this->connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST'),
                env('RABBITMQ_PORT'),
                env('RABBITMQ_USER'),
                env('RABBITMQ_PASSWORD')
            );

            $this->channel = $this->connection->channel();
            $this->channel->queue_declare('order_queue', false, true, false, false);
            $this->channel->confirm_select();
        }
    }

    public function publish($event)
    {
        if (!$this->rabbitEnabled) {
            Log::info('RabbitMQ is disabled. Skipping event publishing.');
            return;
        }

        try {
            $data = json_encode($event);
            $msg = new AMQPMessage($data, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);

            $this->channel->basic_publish($msg, '', 'order_queue');
            $this->channel->wait_for_pending_acks();
        } catch (\Exception $e) {
            Log::error('Failed to publish message to RabbitMQ: ' . $e->getMessage());
        }
    }
}
