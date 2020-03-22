/* global Craft */
/* global Garnish */

import IMask from 'imask';

Craft.MaskedPlainTextField = Garnish.Base.extend({
        elementId: null,
        $element: null,
        mask: null,
        instance: null,
        init: function (settings) {
            this.setSettings(settings, Craft.MaskedPlainTextField.defaults);

            const props = this.settings;
            this.$element = document.getElementById(props.elementId);
            const maskOptions = {
                mask: props.mask
            }
            this.instance = IMask(this.$element, maskOptions);

            return this.instance;
        }
    },
    {
        defaults: {
            elementId: null,
            mask: null,
        }
    });
