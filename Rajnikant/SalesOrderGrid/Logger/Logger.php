<?php
/**
 * @author   Rajnikant Das
 * @license  Open Software License (OSL 3.0)
 */
namespace Rajnikant\SalesOrderGrid\Logger;

class Logger extends \Monolog\Logger
{
    public function customLog($message)
    {
        try {
            if ($message === null) {
                $message = "NULL";
            }
            if (is_array($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (is_object($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (!empty(json_last_error())) {
                $message = (string) json_last_error();
            }
            $message = (string) $message;
        } catch (\Exception $e) {
            $message = "INVALID MESSAGE::" . $e->getMessage();
        }
        $message .= PHP_EOL;
        $this->info($message);
    }
}
