<?php
/**
 * Zaproo theme configuration.
 *
 * @category  Zaproo
 * @package   Zaproo\Theme
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\Theme\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Theme\Model\Config;
use Magento\Theme\Model\ResourceModel\Theme\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Store;

class ThemeConfigure implements DataPatchInterface
{
    /**
     * Zaproo default theme.
     */
    const ZAPROO_THEME = 'Zaproo/default';

    /**
     * Theme config.
     *
     * @var Config
     */
    protected $themeConfig;

    /**
     * Theme collection factory.
     *
     * @var CollectionFactory
     */
    protected $themeCollectionFactory;

    /**
     * ThemeConfigure constructor.
     *
     * @param Config $themeConfig
     * @param CollectionFactory $themeCollectionFactory
     */
    public function __construct(
        Config $themeConfig,
        CollectionFactory $themeCollectionFactory
    ) {
        $this->themeConfig = $themeConfig;
        $this->themeCollectionFactory = $themeCollectionFactory;
    }

    /**
     * Apply patch.
     *
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $availableThemes = $this->themeCollectionFactory->create()->loadRegisteredThemes();

        /** @var \Magento\Theme\Model\Theme $theme */
        foreach ($availableThemes as $theme) {
            if ($theme->getCode() === self::ZAPROO_THEME) {
                $this->themeConfig->assignToStore(
                    $theme,
                    [Store::DEFAULT_STORE_ID],
                    ScopeConfigInterface::SCOPE_TYPE_DEFAULT
                );
            }
        }
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
        return '0.0.2';
    }
}
