<?php
/**
 * Zaproo Cms home page update.
 *
 * @category  Zaproo
 * @package   Zaproo\Cms
 * @author    Roman Sliusar <roman.slusar95@gmail.com>
 * @copyright 2019 Zaproo
 */

namespace Zaproo\Cms\Setup\Patch\Data;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Api\GetPageByIdentifierInterface;
use Magento\Store\Model\Store;

class UpdateHomePage implements DataPatchInterface
{
    /**
     * Page repository.
     *
     * @var PageRepositoryInterface
     */
    protected $pageRepository;

    /**
     * Get cms page by identifier.
     *
     * @var GetPageByIdentifierInterface
     */
    protected $getPageByIdentifier;

    /**
     * UpdateHomePage constructor.
     *
     * @param PageRepositoryInterface $pageRepository
     * @param GetPageByIdentifierInterface $getPageByIdentifier
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        GetPageByIdentifierInterface $getPageByIdentifier
    ) {
        $this->pageRepository = $pageRepository;
        $this->getPageByIdentifier = $getPageByIdentifier;
    }

    /**
     * Apply patch.
     *
     * @return DataPatchInterface|void
     * @throws NoSuchEntityException|LocalizedException
     */
    public function apply()
    {
        $threeTabsWidget = '<p>{{widget type="Zaproo\Cms\Block\Page\Tabs" first_title="Form" second_title="Text" image="https://static2.clutch.co/s3fs-public/logos/161x161-1534155086.584.jpg" second_tab_text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." third_title="Calendar" type_name="Zaproo CMS Page Tabs"}}</p>';
        $cmsHome = $this->getPageByIdentifier->execute('home', Store::DEFAULT_STORE_ID);

        $newPageContent = $threeTabsWidget . $cmsHome->getContent();

        $cmsHome->setContent($newPageContent);

        $this->pageRepository->save($cmsHome);
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
