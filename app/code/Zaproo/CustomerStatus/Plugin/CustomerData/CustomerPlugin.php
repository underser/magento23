<?php
/**
 * Zaproo customer data plugin.
 *
 * @category  Zaproo
 * @package   Zaproo\CustomerStatus
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\CustomerStatus\Plugin\CustomerData;

use Magento\Customer\CustomerData\Customer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Zaproo\CustomerStatus\Helper\Data;

class CustomerPlugin
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
     * CustomerPlugin constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $customerSession
     */
    public function __construct(CustomerRepositoryInterface $customerRepository, Session $customerSession)
    {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    /**
     * @param Customer $subject
     * @param array $result
     *
     * @return array
     */
    public function afterGetSectionData(Customer $subject, $result)
    {
        $extraData = ['customerStatus' => ''];

        if (count($result) && $this->customerSession->isLoggedIn()) {
            try {
                $extraData['customerStatus'] = $this->customerRepository->getById($this->customerSession->getId())
                    ->getCustomAttribute(Data::ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE)
                    ->getValue();
            } catch (\Exception $e) {
                // Status can't be loaded.
            }
        }

        return array_merge($result, $extraData);
    }
}
