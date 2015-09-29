<?php

namespace model;

class UserCredentials {
    private $user;
	private $client;
	
	public function __construct(User $user, UserClient $client) {
		$this->user = $user;
		$this->client = $client;
	}
	public function getName() {
		return $this->user->userName;
	}
	public function getPassword() {
		return $this->user->password;
	}
	public function getClient()  {
		return $this->client;
	}
	
	function isSame(UserCredentials $other){
	    return  $this->client->isSame($other->getClient()) &&
	            $this->getName() == $other->getName() &&
	            $this->getName() == $other->getName();
	}
}