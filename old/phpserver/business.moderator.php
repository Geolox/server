<?php
require_once('dao.moderator.php');
class moderatorBusiness
{
	private $dao;
	public function __construct(){
		$this->dao = new moderatorDao();
	}
    public function save($report) {
		return $this->dao->save($report);
    }
    public function exists($email) {
		return $this->dao->exists($email);
    }
    public function activate($moderator) {
		return $this->dao->activate($moderator);
    }
    public function login($moderator) {
		return $this->dao->login($moderator);
    }
}