<?php

// проверенно для обычного итема (номер и ID)

require_once ROOT . '/libs/Picture.php';
require_once ROOT . '/libs/CustomItem.php';

class OrderItem {
	public $itemId, $itemNumber;
	public $content = null;

	function __construct($itemId, $itemNumber, $pictures = null, $frames = null, $text = null)
	{
		$this->itemId = intval($itemId);
		$this->itemNumber = intval($itemNumber);
		if (isset($pictures)) {
			if (isset($text)) { // GIFT
				//echo '===GIFT===';
				$this->content = new CustomItem($pictures, [new Frame($frames[0]->x, $frames[0]->y, $frames[0]->height, $frames[0]->width)], $text);
			}
			else { // ARRAY OF PICTURES
				$framesForPictures = [];
				foreach ($frames as $frame)
					array_push($framesForPictures, new Frame($frame->x, $frame->y, $frame->height, $frame->width));
				$this->content = new CustomItem($pictures, $framesForPictures);
			}
		}
	}
	public function saveContent() {
		if (isset($this->content)) {
			$this->content->generateArchiveName('zip');
			$this->content->saveContent();
		} else {
			echo "orderItem content is not set";
		}
		return false;
	}
}
