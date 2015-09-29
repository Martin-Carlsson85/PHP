<?php

namespace model;

class UserCredentials {
    private $userName;
	private $password;
	//private $tempPassword;
	private $client;
	
	public function __construct($name, $password, UserClient $client) {
		$this->userName = htmlspecialchars($name);
		$this->password = htmlspecialchars($password);
		//$this->tempPassword = $tempPassword;
		$this->client = $client;
	}
	public function getName() {
		return $this->userName;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getTempPassword() {
		return $this->tempPassword;
	}
	public function getClient()  {
		return $this->client;
	}
	
	function isSame(UserCredentials $other){
	    return  $this->client->isSame($other) &&
	            $this->userName == $other->username &&
	            $this->password == $other->password;
	}
}