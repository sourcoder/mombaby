<?php
/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 */

namespace common\widgets\tags\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class TagsAsset extends AssetBundle
{
    public $css = [
        'css/jquery.tagsinput.css',
        
    ];
    
    public $js = [
        'js/jquery.tagsinput.js',
        'js/tagsinput-init.js',

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
}