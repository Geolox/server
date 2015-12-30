<?php
require_once('dao.report.php');
class reportBusiness
{
	private $dao;
	public function __construct(){
		$this->dao = new reportDao();
	}
    public function save($report) {
		return $this->dao->save($report);
    }
    public function find($catid) {
		return $this->dao->find($catid);
    }
	public function removeAll(){
		return $this->dao->removeAll();
	}
}