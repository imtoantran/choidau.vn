<?php

class ImageManipulation
{
    var $image;
    var $image_type;

    function load($filename)
    {

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image, $filename);
        }
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image);
        }
    }

    function getWidth()
    {

        return imagesx($this->image);
    }

    function getHeight()
    {

        return imagesy($this->image);
    }

    function resizeToHeight($height)
    {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    function square($size)
    {
        $height = $width = $size;
        $x = $y = 0;
        if ($this->getHeight() > $this->getWidth()) {
            $ratio = $size / $this->getWidth();
            $width = $size;
            $height = $ratio * $this->getHeight();
            $y = ($height - $width) * .5;
        } else {
            $ratio = $size / $this->getHeight();
            $height = $size;
            $width = $ratio * $this->getWidth();
            $x = ($width - $height) * .5;
        }
        $this->resize($width, $height);
        $this->image = imagecrop($this->image, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
    }
    public function crop($w,$h)
    {
        $height = $width = $w;
        $x = $y = 0;
        if ($h/$this->getHeight() < $w/$this->getWidth()) {
            $ratio = $w / $this->getWidth();
            $width = $w;
            $height = ceil($ratio * $this->getHeight());
            //$y = abs($height - $width) * .5;
        } else {
            $ratio = $h / $this->getHeight();
            $height = $h;
            $width = ceil($ratio * $this->getWidth());
            //$x = abs($width - $height) * .5;
        }
        $this->resize($width, $height);
        $this->image = imagecrop($this->image, ['x' => $x, 'y' => $y, 'width' => $w, 'height' => $h]);
    }
}