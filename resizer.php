<?php

Class resizer {

	private $imageInfo;
	private $width;
	private $height;
	private $img;

	public function __construct($imgToResize) {

		$this->imageInfo = getimagesize($imgToResize);
		$this->type = $this->imageInfo['mime'];

		// set original dimensions
		$this->width = $this->imageInfo[0];
		$this->height = $this->imageInfo[1];

		// open image to be resized
		$this->img = $this->load($imgToResize);

	}

	private function load($imgToResize) {

		switch ($this->type) {
			
			case 'image/jpeg':
			case 'image/pjpeg':
				$img = @imagecreatefromjpeg($imgToResize);
				break;

			case 'image/png':
			case 'image/x-png':
				$img = @imagecreatefrompng($imgToResize);
				break;

			case 'image/gif':
				$img = @imagecreatefromgif($imgToResize);
				break;
			
			default:
				echo "got me on that one";
				break;
		}

		return $img;

	}

?>