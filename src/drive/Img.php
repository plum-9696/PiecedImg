<?php


namespace Joey\PiecedImg\drive;


class Img extends Css
{
    public $path;
    public $width;
    public $height;
    public $opacity = 100;

    /**
     * 获取大小
     * @return mixed|void
     * @author LJY
     * @time 2019/6/13 9:56
     */
    protected function getSize()
    {
        list($width, $height) = getimagesize($this->path);
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * 透明度
     * @param $opacity
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:56
     */
    protected function opacity($opacity)
    {
        $this->opacity = $opacity * 100;
        return $this;
    }

    /**
     * 构建
     * @param $path
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:57
     */
    protected function build($path)
    {
        $this->path = $path;
        //获取大小
        $this->getSize();
        return $this;
    }


}