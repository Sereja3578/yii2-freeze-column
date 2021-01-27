<?php

namespace sereja3578\freeze;

use kartik\base\AssetBundle;

/**
 * Class FreezeAsset
 * @package sereja3578\freeze
 * @author Sergey Ilichev <sergey.my.activity@gmail.com>
 */
class FreezeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init() : void
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['freeze']);
        $this->setupAssets('js', ['freeze']);

        parent::init();
    }
}
