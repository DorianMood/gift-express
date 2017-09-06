<?php

require_once ROOT . '/libs/Frame.php';

class Picture {
	public $path;
	public $extension;
	public $temp;
	public $frame;
	public $SIZE = 1000;

	function __construct($tempPic, $frame = null)
	{
		if (isset($frame->leftTopX))
			$this->frame = new Frame($frame->x, $frame->y, $frame->height, $frame->width);
		echo "load";
		$pic = new SimpleImage();
		$pic->load($tempPic);

		$this->extension = $pic->getExtension();
		$this->generateName('tmp');
		$this->temp = $this->path;

		echo "befire save";

		$pic->save($this->path, $pic->image_type);

		if (isset($frame) && $frame !== null) {
			$this->cropPicture($frame);
		}
	}

	private function cropPicture($f)
	{
		$pic = new SimpleImage();
		$pic->load($this->path);

		$pic->crop($f->x, $f->y, $f->width, $f->height);
		$this->generateName('tmp');
		$this->temp = $this->path;
		//echo $pic->image_type;
		$pic->save($this->temp, $pic->image_type);
		//$this->save();
	}

	public function save()
	{
		$pic = new SimpleImage();
		$pic->load($this->temp);
		$this->generateName('uploads');
		//echo $pic->image_type;
		$pic->save($this->path, $pic->image_type);
		//$this->removeTemp();
	}

	private function removeTemp()
	{
		$files = glob(ROOT . '/tmp/*'); // get all file names
		foreach($files as $file) // iterate files
			if(is_file($file))
				unlink($file); // delete file
	}

	private function generateName($directory)
	{
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

		$this->path = $dirName . '/' . $name . $this->extension;
	}
}