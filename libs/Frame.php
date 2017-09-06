<?php

class Frame {
	public $x, $y, $height, $width;

	function __construct($x, $y, $height, $width)
	{
		$this->x = intval($x);
		$this->y = intval($y);
		$this->height = intval($height);
		$this->width = intval($width);
	}

}