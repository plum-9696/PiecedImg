<?php

namespace Joey\PiecedImg\drive;

abstract class Css
{
    const ALIGN_START = 1;
    const ALIGN_CENTER = 2;
    const ALIGN_END = 3;
    public $margin = [0, 0, 0, 0];
    public $vertical = self::ALIGN_START;
    public $align = self::ALIGN_START;

    /**
     * 简写外边距
     * @param mixed ...$arguments
     * @return $this
     * @throws \Exception
     * @author LJY
     * @time 2019/6/13 9:54
     */
    protected function margin(...$arguments)
    {
        //margin CSS简写只能为1 2 4
        if (!in_array(count($arguments), [1, 2, 4]))
            throw new \Exception('error Arguments');

        switch (count($arguments)) {
            case 1:
                $this->margin = [$arguments[0], $arguments[0], $arguments[0], $arguments[0]];
                break;
            case 2:
                $this->margin = [$arguments[0], $arguments[1], $arguments[0], $arguments[1]];
                break;
            case 3:
                $this->margin = [$arguments[0], $arguments[1], $arguments[2], $arguments[3]];
                break;
        }
        return $this;
    }

    /**
     * 上边距
     * @param $margin
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:54
     */
    protected function marginTop($margin)
    {
        $this->margin[0] = $margin;
        return $this;
    }

    /**
     * 右边距
     * @param $margin
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:55
     */
    protected function marginRight($margin)
    {
        $this->margin[1] = $margin;
        return $this;
    }

    /**
     * 下边距
     * @param $margin
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:55
     */
    protected function marginBottom($margin)
    {
        $this->margin[2] = $margin;
        return $this;
    }

    /**
     * 左边距
     * @param $margin
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:55
     */
    protected function marginLeft($margin)
    {
        $this->margin[3] = $margin;
        return $this;
    }

    /**
     * 垂直排列
     * @param $align
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:55
     */
    protected function vertical($align)
    {
        $this->vertical = $align;
        return $this;
    }

    /**
     * 水平排列
     * @param $align
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:55
     */
    protected function align($align)
    {
        $this->align = $align;
        return $this;
    }

    /**
     * 获取自身大小
     * @return mixed
     * @author LJY
     * @time 2019/6/13 9:55
     */
    abstract protected function getSize();

    /**
     * 获取元素定位
     * @param $width
     * @param $height
     * @param string $type
     * @return array
     * @author LJY
     * @time 2019/6/13 9:55
     */
    public function position($width, $height, $type = "text")
    {
        $x = 0;
        $y = 0;
        //水平方向
        switch ($this->align) {
            case self::ALIGN_START:
                $x = $this->margin[3];
                break;
            case self::ALIGN_CENTER:
                //(父宽-子宽-左边距-右边距)/2+左边距
                $x = $this->margin[3] + ($width - $this->margin[3] - $this->margin[1] - $this->width) / 2;
                break;
            case self::ALIGN_END:
                //父容器宽度-自身宽度-右边距
                $x = $width - $this->width - $this->margin[1];
                break;
        }
        //垂直方向
        switch ($this->vertical) {
            case self::ALIGN_START:
                $y = $this->margin[0] + $this->height;
                break;
            case self::ALIGN_CENTER:
                //(父容器高度-外边距)/2+自身/2
                $y = ($height - $this->margin[0] - $this->margin[2] ) / 2 + $this->height/2;
                break;
            case self::ALIGN_END:
                //父容器高度-下边距
                $y = $height - $this->margin[2];
                break;
        }
        //若超出范围置为0
        if ($x < 0 || $y < 0) {
            $x = 0;
            $y = 0;
        }
        return compact('x', 'y');
    }


    public static function __callStatic($method, $arg)
    {
        $obj = new static();
        return call_user_func_array([$obj, $method], $arg);
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this, $method], $args);
    }

}