<?php
/**
 * Zaproo Cms tabs widget block.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\Cms\Block\Page;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Tabs extends Template implements BlockInterface
{
    /**
     * Default title placeholder.
     *
     * @var string
     */
    const DEFAULT_TITLE = '**Title**';

    /**
     * Provide titles.
     *
     * @return array
     */
    public function getTitles()
    {
        $titles = [];

        $titles['first_title'] = $this->getData('first_title') ? $this->getData('first_title') : self::DEFAULT_TITLE;
        $titles['second_title'] = $this->getData('second_title') ? $this->getData('second_title') : self::DEFAULT_TITLE;
        $titles['third_title'] = $this->getData('third_title') ? $this->getData('third_title') : self::DEFAULT_TITLE;

        return $titles;
    }

    /**
     * To html.
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->getTemplate()) {
            $this->setTemplate('Zaproo_Cms::widget/three_tabs.phtml');
        }

        return parent::_toHtml();
    }
}
