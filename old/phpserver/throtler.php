<?php

require_once('php-amqplib/PhpAmqpLib/Connection/AMQPConnection.php');
require_once('php-amqplib/PhpAmqpLib/Message/AMQPMessage.php');

class Queue
{
    //amqp queue
    public $host;
	public $port;
	public $user;
	public $pass;
	public $vhost;
	//queue
	public $q_name;// $queue
    public $q_passive = false;
    public $q_durable = true; // the queue will survive server restarts
    public $q_exclusive = false; // the queue can be accessed in other channels
    public $q_auto_delete = false; //the queue won't be deleted once the channel is closed.
	//exchange
	public $x_name;// $exchange
    public $x_type = 'direct';
    public $x_passive = false;
    public $x_durable = true; // the exchange will survive server restarts
    public $x_auto_delete = false; //the exchange won't be deleted once the channel is closed.
	
	public $conn;
	public $ch;
	public $queue;

    // method declaration
    public function getMessages($count) {
		$ret = array();
		for ($i = 0; $i < $count; $i++) {
			$msg=$this->ch->basic_get($this->q_name, false, null);
			if ($msg==null) break;
			$ret[] = array(	
			'meta' => array( 'body' => json_decode($msg->body), 'delivery_info' => $msg->delivery_info ),
			'body' => json_decode($msg->body));
		}
		return $ret;
    }
	public function putMessage($message, $message_id="", $properties = array('content_type' => 'text/plain', 'delivery_mode' => 2)){
		if($message_id!=""){
			$properties["message_id"] = $message_id;
		}
		$msg = new AMQPMessage($message, $properties);
		$this->ch->basic_publish($msg, $this->x_name);
		
	}
	public function init($queue, $exchange)
	{
		$this->q_name = $queue;
		$this->x_name = $exchange;

		$this->ch = $this->conn->channel();
		$this->queue = $this->ch->queue_declare($this->q_name, $this->q_passive, $this->q_durable, $this->q_exclusive,  $this->q_auto_delete);

		$this->ch->exchange_declare($this->x_name, $this->x_type, $this->x_passive, $this->x_durable, $this->x_auto_delete);

		$this->ch->queue_bind($this->q_name, $this->x_name);
	}
	public function ack($message_id) {
		$msg = null;
		do {
		    $msg=$this->ch->basic_get($this->q_name, false, null);
		    if ($msg==null) break;
		} while ($msg->properties["message_id"] <> $message_id);
		
		$this->ch->basic_ack($msg->delivery_info["delivery_tag"]);
		return $msg!=null;
	}
	public function __construct($host, $port, $user, $pass, $vhost){
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->pass = $pass;
		$this->vhost = $vhost;
		$this->conn = new AMQPConnection($this->host, $this->port, $this->user, $this->pass, $this->vhost);
	}
}
?>