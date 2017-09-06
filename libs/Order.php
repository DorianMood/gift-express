<?php

class Order {
	public $description = null;
	public $name = null;
	public $email = null;
	public $phone = null;
	public $address = null;
	public $id = null;
	public $items = null;

	public function __construct($description, $name, $email, $phone, $address)
	{
		$this->description = $description;
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone;
		$this->address = $address;
	}
}