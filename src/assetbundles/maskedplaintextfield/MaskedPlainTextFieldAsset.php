<?php
/**
 * Masked Plain Text plugin for Craft CMS 3.x
 *
 * Adds input masks to plain text fields
 *
 * @link      https://www.venveo.com
 * @copyright Copyright (c) 2020 Venveo
 */

namespace venveo\maskedplaintext\assetbundles\maskedplaintextfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Venveo
 * @package   MaskedPlainText
 * @since     1.0.0
 */
class MaskedPlainTextFieldAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/dist/';

        $this->depends = [
            CpAsset::class
        ];

        $this->js = [
            'main.js',
        ];
        parent::init();
    }
}
