<?php
/**
 * Zaproo cms module registration.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */
 
use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Zaproo_Cms',
    __DIR__
);