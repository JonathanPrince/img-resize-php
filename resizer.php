<?php

Class resizer {

	private $imageInfo;
	private $inputWidth;
	private $inputHeight;
	private $imageIn;
	private $imageOut;

	public function __construct($imgToResize) {

		$this->imageInfo = getimagesize($imgToResize);
		$this->type = $this->imageInfo['mime'];

		// set original dimensions
		$this->inputWidth = $this->imageInfo[0];
		$this->inputHeight = $this->imageInfo[1];

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

	public function resize($outputWidth, $outputHeight) {

		$this->imageOut = imagecreatetruecolor($outputWidth, $outputHeight);
		imagecopyresampled($imageOut, $imageIn, 0, 0, 0, 0, $outputWidth, $outputHeight, $this->inputWidth, $this->inputHeight);
	}

?>