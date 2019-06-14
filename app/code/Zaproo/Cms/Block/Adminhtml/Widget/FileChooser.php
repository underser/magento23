<?php
/**
 * Zaproo Cms tabs widget block.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\Cms\Block\Adminhtml\Widget;

use Magento\Framework\Data\Form\Element\AbstractElement;

class FileChooser extends AbstractField
{
    /**
     * Prepare chooser element HTML.
     *
     * @param AbstractElement $element Form Element.
     *
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $config = $this->_getData('config');
        $sourceUrl = $this->getUrl('cms/wysiwyg_images/index', [
            'target_element_id' => $element->getId(), 'type' => 'file']);
        /** @var \Magento\Backend\Block\Widget\Button $chooser */
        $chooser = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel($config['button']['open'])
            ->setOnClick('MediabrowserUtility.openDialog(\'' . $sourceUrl . '\', 0, 0, "MediaBrowser", {})')
            ->setDisabled($element->getReadonly());

        $input = $this->elementFactory->create("text", ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setClass("widget-option input-text admin__control-text");
        if ($element->getRequired()) {
            $input->addClass('required-entry');
        }

        $element->setData(
            'after_element_html',
            $input->getElementHtml() . $chooser->toHtml(). "<script>require(['mage/adminhtml/browser']);</script>"
        );

        return $element;
    }
}
