<?php
/**
 * Zaproo theme registration.
 *
 * @category  Zaproo
 * @package   Zaproo\Theme
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */
 
use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Zaproo_Theme',
    __DIR__
);
