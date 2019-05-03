<?php
/**
 * Customer status form block.
 *
 * @category  Zaproo
 * @package   Zaproo\CustomerStatus
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\CustomerStatus\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Zaproo\CustomerStatus\Helper\Data;

class StatusForm extends Template
{
    /**
     * Customer repository.
     *
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Customer session.
     *
     * @var Session
     */
    protected $customerSession;

    /**
     * StatusForm constructor.
     *
     * @param Template\Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerRepositoryInterface $customerRepository,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    /**
     * Provide current customer status.
     *
     * @return string
     */
    public function getCurrentCustomerStatus()
    {
        $status = '';

        if ($customerId = $this->customerSession->getCustomer()->getId()) {
            try {
                $status = $this->customerRepository->getById($customerId)
                    ->getCustomAttribute(Data::ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE)
                    ->getValue();
            } catch (\Exception $e) {
                // Status can't be loaded.
            }
        }

        return $status;
    }

    /**
     * Provide url for saving status form.
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('customerStatus/status/save');
    }

    /**
     * Preparing global layout.
     *
     * @return Template|void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Customer status form'));
    }
}
