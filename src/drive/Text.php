<?php

namespace Joey\PiecedImg\drive;


class Text extends Css
{
    public $angle=0;
    public $color = [0,0,0];
    public $size = 18;
    public $text;
    public $font;
    public $width;
    public $height;

    /**
     * 设置颜色
     * @param $r
     * @param $g
     * @param $b
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:58
     */
    protected function color($r, $g, $b)
    {
        $this->color = [$r, $g, $b];
        return $this;
    }

    /**
     * 设置角度
     * @param $angle
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:58
     */
    protected function angle($angle)
    {
        $this->angle = $angle;
        return $this;
    }

    /**
     * 设置大小
     * @param $size
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:58
     */
    protected function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 获取大小
     * @return mixed|void
     * @author LJY
     * @time 2019/6/13 9:59
     */
    protected function getSize()
    {
        $point = imagettfbbox($this->size, $this->angle, $this->font, $this->text);
        $height = bcadd(abs($point[1]), abs($point[7]));
        $width = bcadd(abs($point[0]), abs($point[2]));
        $this->width =$width;
        $this->height =$height;
    }

    /**
     * 构建
     * @param $text
     * @param $font
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:59
     */
    protected function build($text, $font)
    {
        $this->text = $text;
        $this->font = $font;
        //获取大小
        $this->getSize();
        return $this;
    }
}