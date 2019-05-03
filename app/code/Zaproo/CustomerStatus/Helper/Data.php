<?php
/**
 * Customer status data helper.
 *
 * @category  Zaproo
 * @package   Zaproo\CustomerStatus
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\CustomerStatus\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Customer status attribute code.
     *
     * @var string
     */
    const ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE = 'zaproo_customer_status';
}
