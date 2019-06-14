/**
 * Zaproo Cms calendar.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

require([
    'jquery',
    'clndr',
], function ($) {
      $('#full-clndr').clndr({
          template: $('#full-clndr-template').html(),
      });
});