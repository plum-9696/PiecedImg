<?php


namespace Joey\PiecedImg\drive;

class PiecedImg
{
    static public $path;
    private $container = [];
    private $resource;

    /**
     * 合成元素
     * @param $css
     * @return $this
     * @author LJY
     * @time 2019/6/13 9:57
     */
    public function merge($css)
    {
        array_push($this->container, $css);
        return $this;
    }

    /**
     * 背景图
     * @param $path
     * @return PiecedImg
     * @author LJY
     * @time 2019/6/13 9:57
     */
    public static function backgroundImage($path)
    {
        static::$path = $path;
        return new static();
    }


    /**
     * 元素合成
     * @throws \Exception
     * @author LJY
     * @time 2019/6/13 9:57
     */
    private function build()
    {
        //初始化资源
        if (!static::$path)
            throw new \Exception('Background image lost');
        $this->resource = imagecreatefromstring(file_get_contents(static::$path));
        //获取大小
        list($width, $height) = getimagesize(static::$path);
        foreach ($this->container as $obj) {
            $point = $obj->position($width, $height);
            if($obj instanceof Text){
                $color = imagecolorallocate($this->resource, $obj->color[0], $obj->color[1], $obj->color[2]);
                imagettftext($this->resource, $obj->size, $obj->angle, $point['x'], $point['y'], $color, $obj->font, $obj->text);
            }else if($obj instanceof Img){
                $src_img = imagecreatefromstring(file_get_contents($obj->path));
                //图片相对于字体上移一个自身单位
                $point['y'] -= $obj->height;
                imagecopymerge($this->resource, $src_img, $point['x'], $point['y'], 0, 0, $obj->width, $obj->height,$obj->opacity);
            }
        }
    }

    /**
     * 输出字符穿
     * @throws \Exception
     * @author LJY
     * @time 2019/6/13 9:58
     */
    public function writeString()
    {
        $this->build();
        imagepng($this->resource);
        imagedestroy($this->resource);
    }

    /**
     * 输出本地
     * @param $filePath
     * @throws \Exception
     * @author LJY
     * @time 2019/6/13 9:58
     */
    public function writeSave($filePath)
    {
        $this->build();
        imagepng($this->resource,$filePath);
        imagedestroy($this->resource);
    }
}