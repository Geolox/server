<?php
include('config.php');
class reportDao
{
	//amqp queue
	private $mongo_conn;
	private $db;
	private $collection;
	public function __construct(){
			$this->mongo_conn = new Mongo(MONGOCONN);
			$this->db = $this->mongo_conn->streetreports; //database pointer
			$this->collection = $this->db->reports2012; //collection in db pointer
	}
    public function save($report) {
	    try{
			$obj = array(
			'reportid' => $report->reportid,
			'catid' => $report->catid,
			'catname' => $report->catname,
			'subcatid' => $report->subcatid,
			'subcatname' => $report->subcatname,
			'reportd' => new MongoDate(strtotime($report->reportd)), 
			'workd' => new MongoDate(),
			'due' => new MongoDate(),
			'closed' => new MongoDate(),
			'desc' => $report->desc,
			'img1' => $report->img1,
			'img2' => $report->img2,
			'img3' => $report->img3,
			'img1thumb' => $report->img1thumb,
			'mapphone' => $report->mapphone,
			'mapthumb' => $report->mapthumb,
			'mapmonitor' => $report->mapmonitor,
			'user'=> $report->user,
			'loc' => (object)array( 'lon' => $report->lon, 'lat' => $report->lat));
			$this->collection->insert($obj);
		} 
		catch (MongoException $e) 
		{
			return false;
		}
		catch (Exception $e) 
		{
			return false;
		}
		return true;
   	}
    public function find($catid) {
	    try{
	    	$obj = array();
	    	if($catid!=0){
	    		$obj = array('catid' => $catid);
	    	}
			$result = $this->collection->find($obj);
		} 
		catch (MongoException $e) 
		{
			return null;
		}
		catch (Exception $e) 
		{
			return null;
		}
		return $result;
   	}
	public function removeAll() {
	    try{
	    	$obj = array();
			$this->collection->remove($obj);
		} 
		catch (MongoException $e) 
		{
			return false;
		}
		catch (Exception $e) 
		{
			return false;
		}
		return true;
   	}
}
?>