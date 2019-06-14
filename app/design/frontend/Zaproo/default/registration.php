<?php
/**
 * _ {{desc}}.
 *
 * @category  Category
 * @package   Category\Package
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Company
 */
 
use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::THEME,
    'frontend/Zaproo/default',
    __DIR__
);