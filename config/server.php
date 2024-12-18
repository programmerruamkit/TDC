<?php
require dirname(__DIR__) . '/vendor/autoload.php';  // โหลด Composer autoload

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

// สร้าง WebSocket server
class MyWebSocket implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message from {$from->resourceId}: {$msg}\n";
        $from->send('Hello, client!');
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

// WebSocket server ที่รันที่พอร์ต 5500
$server = IoServer::factory(
    new WsServer(
        new MyWebSocket()
    ),
    5500,  // พอร์ตที่ WebSocket server จะรัน
    '0.0.0.0'  // รับการเชื่อมต่อจากทุกๆ IP
);

echo "WebSocket server started at ws://192.168.5.214:5500\n";
$server->run();  // รัน WebSocket server
