<?php

require_once ROOT . '/libs/Picture.php';
require_once ROOT . '/libs/pclzip.lib.php';

class CustomItem {
	public $pictures;
	public $text = null;
	public $file = null;

	/**
	 * CustomItem constructor.
	 * @param "array or one picture for gift etc" $pictures
	 * @param "text" $text
	 * @param  "frames" $frames
	 */
	function __construct($pictures, $frames = null, $text = null)
	{
		if (count($pictures) > 1) {
			$this->pictures = [];
			for ($i = 0; $i < count($pictures); $i++) {
				//var_dump($pictures[$i]);
				//move_uploaded_file($pictures[$i]['tmp_name'], '/var/www/html/site/tmp/' . $i);
				//echo(exif_imagetype($pictures[$i]['tmp_name']));
				array_push($this->pictures, new Picture($pictures[$i]['tmp_name'], $frames[$i]));
			}
		}
		else {
			$this->pictures = [new Picture($pictures[0]['tmp_name'], $frames[0])];
		}
		if (isset($text))
			$this->text = $text;
	}
	public function saveContent() {
		if (isset($this->pictures)) {
			$this->generateArchiveName('zip');

			$zip = new PclZip($this->file);
			if (count($this->pictures) > 1) { // more then one picture
				$names = [];
				$counter = 1;
				foreach ($this->pictures as $pic) {
					rename($pic->temp, ROOT.'/tmp/'.$counter.$pic->extension);
					array_push($names, ROOT.'/tmp/'.$counter.$pic->extension);
					$counter++;
				}
				echo $zip->create($names, PCLZIP_OPT_REMOVE_PATH, ROOT.'/tmp/');
			} else { // one picutre GIFT
				$zip->create($this->pictures[0]->temp, PCLZIP_OPT_REMOVE_PATH, ROOT.'/tmp/');
				if ($zip->add('/var/www/html/site/tmp/1HVqNshZjSbew71phhAmGiEQ7ZcZSTxU.png') == 0)
					echo $zip->errorInfo();
			}
			return true;
		}
		return false;
	}
	public function addToArchive($zip) {
		if (count($this->pictures) > 1) {
			$names = [];
			foreach ($this->pictures as $pic) {
				array_push($names, $pic->temp);
			}

		} else {
			//$zip->add
		}
	}
	public function generateArchiveName($directory) {
		$dirName = ROOT . '/' . $directory;
		$dictionary = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$name = "";
		$unical = true;
		$files = scandir($dirName);

		do
		{
			$name = "";
			$unical = true;
			for ($i = 0; $i < 32; $i++)
				$name .= $dictionary[rand(0, strlen($dictionary) - 1)];
			foreach ($files as $file)
				if (preg_match("/$name/", $file)) {
					$unical = false;
					break;
				}
		} while ($unical === false);

		$this->file = $dirName . '/' . $name . '.zip';
	}
	public function removeTemp()
	{
		$files = glob(ROOT . '/tmp/*'); // get all file names
		foreach($files as $file) // iterate files
			if(is_file($file))
				unlink($file); // delete file
	}
}

// select * from orders left join order_item as oi on orders.id = oi.order_id