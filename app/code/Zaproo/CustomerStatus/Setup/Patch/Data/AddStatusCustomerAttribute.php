<?php
/**
 * Customer status install new customer attribute.
 *
 * @category  Zaproo
 * @package   Zaproo\CustomerStatus
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\CustomerStatus\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Zaproo\CustomerStatus\Helper\Data;

class AddStatusCustomerAttribute implements DataPatchInterface
{
    /**
     * Module data setup.
     *
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * Eav setup.
     *
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * Eav config.
     *
     * @var Config
     */
    protected $eavConfig;

    /**
     * Attribute set factory.
     *
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    /**
     * AddStatusCustomerAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * Apply patch.
     *
     * @return DataPatchInterface|void
     * @throws \Exception
     */
    public function apply()
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->removeAttribute(Customer::ENTITY, 'zaproo_customer_status');

        $attributeSetId = $eavSetup->getEntityType('customer');
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $eavSetup->addAttribute(
            Customer::ENTITY,
            Data::ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE,
            [
                'type' => 'varchar',
                'label' => 'Customer Status',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => false,
                'sort_order' => 90,
                'position' => 90,
                'system' => 0,
            ]
        );

        $customerStatusAttribute = $this->eavConfig->getAttribute(
            Customer::ENTITY,
            Data::ZAPROO_CUSTOMER_STATUS_ATTRIBUTE_CODE
        );
        $customerStatusAttribute->addData([
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroupId,
            'used_in_forms' => ['adminhtml_customer']
        ]);
        $customerStatusAttribute->save();
    }

    /**
     * Get aliases.
     *
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Get dependencies.
     *
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Provide version.
     *
     * @return string
     */
    public static function getVersion()
    {
        return '1.0.1';
    }
}
