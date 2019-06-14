<?php
/**
 * Zaproo Cms abstract field for widget.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\Cms\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\AbstractElement;

abstract class AbstractField extends Template
{
    /**
     * Element factory.
     *
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $elementFactory;

    /**
     * AbstractField constructor.
     *
     * @param Context $context
     * @param Factory $elementFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Factory $elementFactory,
        array $data = []
    ) {
        $this->elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    /**
     * Prepare element HTML
     *
     * @param  AbstractElement $element Form Element
     * @return AbstractElement
     */
    abstract public function prepareElementHtml(AbstractElement $element);
}
