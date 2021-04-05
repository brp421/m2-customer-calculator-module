/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'jquery-ui-modules/widget',
    'mage/translate'
], function ($, confirm) {
    'use strict';

    $.widget('mage.calculation', {
        /**
         * Options common to all instances of this widget.
         * @type {Object}
         */
        options: {
            deleteConfirmMessage: $.mage.__('Are you sure you want to delete this calculation entry?')
        },

        /**
         * Bind event handlers for adding and deleting addresses.
         * @private
         */
        _create: function () {
            var options         = this.options,
                addCalculationEntry      = options.addCalculationEntry,
                deleteCalculation   = options.deleteCalculation;

            if (addCalculationEntry) {
                $(document).on('click', addCalculationEntry, this._addCalc.bind(this));
            }

            if (deleteCalculation) {
                $(document).on('click', deleteCalculation, this._deleteCalc.bind(this));
            }
        },

        /**
         * Add a new address.
         * @private
         */
        _addCalc: function () {
            window.location = this.options.addCalculationLocation;
        },

        /**
         * Delete the address whose id is specified in a data attribute after confirmation from the user.
         * @private
         * @param {jQuery.Event} e
         * @return {Boolean}
         */
        _deleteCalc: function (e) {
            var self = this;

            confirm({
                content: this.options.deleteConfirmMessage,
                actions: {

                    /** @inheritdoc */
                    confirm: function () {
                        if (typeof $(e.target).parent().data('address') !== 'undefined') {
                            window.location = self.options.deleteUrlPrefix + $(e.target).parent().data('address') +
                                '/form_key/' + $.mage.cookies.get('form_key');
                        } else {
                            window.location = self.options.deleteUrlPrefix + $(e.target).data('address') +
                                '/form_key/' + $.mage.cookies.get('form_key');
                        }
                    }
                }
            });

            return false;
        }
    });

    return $.mage.address;
});
