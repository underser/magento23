/**
 * Zaproo Cms welcome from component.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

define([
    'ko',
    'uiComponent',
    'jquery',
    'mage/validation'
], function (ko, Component, $) {
    'use strict';

    return Component.extend({
        welcomeMessage: ko.observable(''),
        firstName: ko.observable(''),
        lastName: ko.observable(''),
        message: ko.observable(''),

        initialize: function () {
            this._super();
        },

        prepareSubmit: function (form) {
            var $form = $(form);

            if ($form.validation() && $form.validation('isValid')) {
                var welcomeMessage = 'Hello ' + this.firstName() + ' ' + this.lastName() +'! ' + this.message();

                this.welcomeMessage(welcomeMessage);

                $form.hide();
            }
        }
    });
});
