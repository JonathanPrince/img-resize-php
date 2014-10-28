<?php

Class resizer {

    private $imageInfo;
    private $inputWidth;
    private $inputHeight;
    private $imageIn;
    private $imageOut;

    /**
     * Contruct new resizer object
     * @param path $imgToResize location of original image
     */
    public function __construct($imgToResize) {

        if (file_exists($imgToResize)) {

            $this->imageInfo = getimagesize($imgToResize);
            $this->type = $this->imageInfo['mime'];

            // set original image dimensions
            $this->inputWidth = $this->imageInfo[0];
            $this->inputHeight = $this->imageInfo[1];

            // load image data to be resized
            $this->imageIn = $this->load($imgToResize);

        } else {

            throw new Exception($imgToResize.' was not found.');

        }

    }

    /**
     * loads original image
     * @param path $imgToResize location of original image
     * @return image identifier representing the original image
     */
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
                throw new Exception('File type: '.$this->type.' is not a recognised image type.');
                break;
        }

        return $img;

    }

    /**
     * Create new image with desired size
     * @param integer $outputWidth new image width
     * @param integer $outputHeight new image height
     */
    public function resize($outputWidth, $outputHeight) {

        $this->imageOut = imagecreatetruecolor($outputWidth, $outputHeight);
        imagecopyresampled($this->imageOut, $this->imageIn, 0, 0, 0, 0, $outputWidth, $outputHeight, $this->inputWidth, $this->inputHeight);
    }

    /**
     * Save new image
     * @param location $target path and filename for new image
     * @param integer $quality quality level to use when saving new image
     */
    public function save($target, $quality) {

        switch ($this->type) {

            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($this->imageOut, $target, $quality);      // quality for jpeg is 0-100
                break;

            case 'image/png':
            case 'image/x-png':
                imagepng($this->imageOut, $target, $quality);        // quality for png is 0-9
                break;

            case 'image/gif':
                imagegif($this->imageOut, $target);
                break;

            default:
                throw new Exception('Unable to save, not recognised as valid image type.');
                break;
        }
    }
}
