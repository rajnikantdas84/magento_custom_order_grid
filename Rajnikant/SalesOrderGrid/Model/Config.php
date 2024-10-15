<?php
/**
 * @author   Rajnikant Das
 * @license  Open Software License (OSL 3.0)
 */
namespace Rajnikant\SalesOrderGrid\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    public const DEFAULT_AMOUNT_DISPLAY_TEXT = '| Total amount {{amount}}';

    public const XML_PATH_ENABLED = 'rajnikant_salesordergrid/general/enabled';
    public const XML_PATH_DEBUG = 'rajnikant_salesordergrid/general/debug';

    public const XML_PATH_GRID_AMOUNT_DISPLAY_TEXT       = 'rajnikant_salesordergrid/grid/amount_display_text';
    public const XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING   = 'rajnikant_salesordergrid/grid/amount_display_rounding';
    private const XML_PATH_GRID_STATUS_COLOR = 'rajnikant_salesordergrid/grid/status_color';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getConfigFlag($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_ENABLED, $storeId);
    }

    public function isActive($storeId = null)
    {
        return $this->isEnabled($storeId);
    }

    public function isDebugEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_DEBUG, $storeId);
    }

    public function getAmountDisplayText($storeId = null)
    {
        $text = $this->getConfigValue(self::XML_PATH_GRID_AMOUNT_DISPLAY_TEXT, $storeId);
        if (empty($text) || strpos($text, '{{amount}}') === false) {
            return self::DEFAULT_AMOUNT_DISPLAY_TEXT;
        }
        return $text;
    }

    public function getAmountDisplayRounding($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING, $storeId);
    }

    public function getGridStatusColor($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_GRID_STATUS_COLOR, $storeId);
    }
}
