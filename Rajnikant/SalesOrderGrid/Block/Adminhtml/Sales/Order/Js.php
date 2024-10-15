<?php
/**
 * @author   Rajnikant Das
 * @license  Open Software License (OSL 3.0)
 */
namespace Rajnikant\SalesOrderGrid\Block\Adminhtml\Sales\Order;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Rajnikant\SalesOrderGrid\Helper\Data as SalesOrderGridHelper;

class Js extends Template
{
    /**
     * @var string
     */
    protected $_template = 'Rajnikant_SalesOrderGrid::sales/order/js.phtml';

    /**
     * @var SalesOrderGridHelper
     */
    private $salesOrderGridHelper;

    public function __construct(
        Context $context,
        SalesOrderGridHelper $salesOrderGridHelper,
        array $data = []
    ) {
        $this->salesOrderGridHelper = $salesOrderGridHelper;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        if (!$this->isActive()) {
            return '';
        }

        return parent::_toHtml();
    }

    public function isActive()
    {
        return $this->salesOrderGridHelper->isActive();
    }

    public function getBaseCurrencySymbol()
    {
        return $this->_storeManager->getStore()->getBaseCurrency()->getCurrencySymbol();
    }

    public function getAmountDisplayText()
    {
        return $this->salesOrderGridHelper->getConfig()->getAmountDisplayText();
    }

    public function getAmountDisplayRounding()
    {
        return $this->salesOrderGridHelper->getConfig()->getAmountDisplayRounding();
    }

    public function getGridConfig()
    {
        return [
            'is_active'                 => $this->isActive(),
            'base_currency_symbol'      => $this->getBaseCurrencySymbol(),
            'amount_display_text'       => $this->getAmountDisplayText(),
            'amount_display_rounding'   => $this->getAmountDisplayRounding()
        ];
    }
}
