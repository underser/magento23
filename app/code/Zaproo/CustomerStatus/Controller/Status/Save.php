<?php
/**
 * Customer status save action.
 *
 * @category  Zaproo
 * @package   Zaproo\CustomerStatus
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\CustomerStatus\Controller\Status;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Zaproo\CustomerStatus\Helper\Data;

class Save extends Action
{
    /**
     * Customer session.
     *
     * @var Session
     */
    protected $customerSession;

    /**
     * Customer repository.
     *
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Escaper.
     *
     * @var Escaper
     */
    protected $escaper;

    /**
     * From key validator.
     *
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param Session $customerSession
     * @param CustomerRepositoryInterface $customerRepository
     * @param Escaper $escaper
     * @param Validator $formKeyValidator
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        Escaper $escaper,
        Validator $formKeyValidator
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->escaper = $escaper;
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * Dispatch request.
     *
     * @return \Magento\Framework\Controller\Result\Redirect|bool
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->_redirect->getRefererUrl());
        $newStatus = $this->escaper->escapeHtml($this->getRequest()->getParam('status'));

        try {
            if (!$this->formKeyValidator->validate($this->getRequest())) {
                throw new LocalizedException(__('Invalid Form Key. Please refresh the page.'));
            }

            if ($this->customerSession->isLoggedIn()) {
                $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
                $customer->getCustomAttribute(Data::ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE)->setValue($newStatus);
                $this->customerRepository->save($customer);
                $this->messageManager->addSuccessMessage(__('New status is saved.'));
            } else {
                $this->customerSession->setAfterAuthUrl($this->_redirect->getRefererUrl());
                return $this->customerSession->authenticate();
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Sorry we can\'t save new status.'));
        }

        return $resultRedirect;
    }
}
