<?php
/**
 * Masked Plain Text plugin for Craft CMS 3.x
 *
 * Adds input masks to plain text fields
 *
 * @link      https://www.venveo.com
 * @copyright Copyright (c) 2020 Venveo
 */

namespace venveo\maskedplaintext\fields;

use Craft;
use craft\base\ElementInterface;
use craft\fields\PlainText;
use craft\helpers\Json;
use venveo\maskedplaintext\assetbundles\maskedplaintextfield\MaskedPlainTextFieldAsset;

/**
 * @author    Venveo
 * @package   MaskedPlainText
 * @since     1.0.0
 */
class MaskedPlainText extends PlainText
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('app', 'Plain Text (Masked)');
    }

    /**
     * @var string|null The input’s mask
     */
    public $mask;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['mask'], 'string'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'masked-plain-text/_settings',
            [
                'field' => $this,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Register our asset bundle
        Craft::$app->getView()->registerAssetBundle(MaskedPlainTextFieldAsset::class);

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);

        // Variables to pass down to our field JavaScript to let it namespace properly
        $jsonVars = [
            'elementId' => $namespacedId,
            'mask' => $this->mask
        ];
        $jsonVars = Json::encode($jsonVars);
        Craft::$app->getView()->registerJs("new Craft.MaskedPlainTextField(" . $jsonVars . ");");

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            '_components/fieldtypes/PlainText/input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
            ]
        );
    }
}
