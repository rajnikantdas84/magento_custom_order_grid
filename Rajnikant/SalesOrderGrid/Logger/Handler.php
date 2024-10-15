<?php
/**
 * @author   Rajnikant Das
 * @license  Open Software License (OSL 3.0)
 */
namespace Rajnikant\SalesOrderGrid\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/rajnikant_salesordergrid.log';

    /**
     * @var int
     */
    protected $loggerType = \Monolog\Logger::INFO;
}
