<?php

namespace model;

/**
 * Class UserCredentials containing User login values and a UserClient for
 * checking if we are logging in from same computer
 * @package model
 */
class UserCredentials {
    private $user;
	private $client;
	
	public function __construct(User $user, UserClient $client) {
		$this->user = $user;
		$this->client = $client;
	}

	/**
	 * Returns the username
	 * @return string
	 */
	public function getName() {
		return $this->user->userName;
	}

	/**
	 * Returns the password
	 * @return string
	 */
	public function getPassword() {
		return $this->user->password;
	}

	/**
	 * @return UserClient
	 */
	public function getClient()  {
		return $this->client;
	}

	/**
	 * Checks if UserClient is same (if we are on same ip-address and using same browser,
	 * and checks if username and password matches
	 * @param UserCredentials $other
	 * @return bool
	 */
	function isSame(UserCredentials $other){
	    return  $this->client->isSame($other->getClient()) &&
	            $this->getName() == $other->getName() &&
	            $this->getName() == $other->getName();
	}
}