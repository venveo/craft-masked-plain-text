<?php
/**
 * Masked Plain Text plugin for Craft CMS 3.x
 *
 * Adds input masks to plain text fields
 *
 * @link      https://www.venveo.com
 * @copyright Copyright (c) 2020 Venveo
 */

namespace venveo\maskedplaintext;

use craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use venveo\maskedplaintext\fields\MaskedPlainText as MaskedPlainTextField;
use yii\base\Event;

/**
 * Class MaskedPlainText
 *
 * @author    Venveo
 * @package   MaskedPlainText
 * @since     1.0.0
 *
 */
class Plugin extends BasePlugin
{
    /**
     * @var Plugin
     */
    public static $plugin;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = MaskedPlainTextField::class;
            }
        );
    }
}
