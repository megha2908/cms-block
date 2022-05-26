<?php

/**
 * @category  LogicSpot
 * @package   LogicSpot_CmsBlock
 */
namespace LogicSpot\CmsBlock\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

/**
 * Class CmsStaticBlock
 * @package LogicSpot\CmsBlock\Setup\Patch\Data
 */
class CmsStaticBlock implements DataPatchInterface, PatchVersionInterface
{
    /**
    * @var ModuleDataSetupInterface
    */

    private $moduleDataSetup;
    /**
    * @var BlockFactory
    */

    private $blockFactory;
    /**
    * @param Module Data SetupInterface $moduleDataSetup
    * @param PageFactory $blockFactory
    */

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
    * {@inheritdoc}
    */
    public function apply()
    {
        $logicspotCmsStaticBlock = [
            'title' => 'LogicSpot CMS Block',
            'identifier' => 'logicspot_cms_block',
            'content' => '<div class="cms-block">Thank you for buying from us</div>',
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ];

        $this->moduleDataSetup->startSetup();
        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->blockFactory->create();
        $block->setData($logicspotCmsStaticBlock)->save();
        $this->moduleDataSetup->endSetup();
    }

    /**
    * {@inheritdoc}
    */

    public static function getDependencies()
    {
        return [];
    }

    /**
    * {@inheritdoc}
    */

    public static function getVersion()
    {
        return '2.0.0';
    }

    /**
    * {@inheritdoc}
    */

    public function getAliases()
    {
        return [];
    }

}
