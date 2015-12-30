<?php
include('config.php');
class moderatorDao
{

	private $mongo_conn;
	private $db;
	private $collection;
	public function __construct(){
			$this->mongo_conn = new Mongo(MONGOCONN);
			$this->db = $this->mongo_conn->streetreports; //database pointer
			$this->collection = $this->db->moderators; //collection in db pointer
	}
    public function save($moderator) {
	    try{
			$obj = array(
			'name' => $moderator->name,
			'email' => $moderator->email,
			'password' => $moderator->password,
			'activation' =>md5(uniqid(rand(), true)), 
			'level' => $moderator->level,
			'creationdate' => new MongoDate(),
			'lastupdate' => new MongoDate());
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
   	public function exists($email) {
   		$obj=$this->collection->findOne(array('email'=>$email));
   		return is_array($obj);
   	}
   	public function activate($moderator) {
	    try{
			$this->collection->update(array('email'=>$moderator->email,'activation'=>$moderator->activation), array('$set' => array('activation'=>NULL)));
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
   	public function edit($moderator) {
	    try{
			$this->collection->update(array('email'=>$moderator->email),
			 array('$set' => 
			 	array(
			 		'name' => $moderator->name,
					'email' => $moderator->email,
					'password' => $moderator->password,
					'activation' => NULL, 
					'level' => $moderator->level,
					'lastupdate' => new MongoDate()
			 		)
			 	)
			 );
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
	public function login($moderator){
		$obj=$this->collection->findOne(array('email'=>$moderator["email"],'password'=>$moderator["password"]));
   		return $obj;
	}
}
?>