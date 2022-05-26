<?php
 /**
    * @category  LogicSpot
    * @package   LogicSpot_CmsBlock
*/
namespace LogicSpot\CmsBlock\Plugin;

use LogicSpot\CmsBlock\Helper\Data;
use Magento\Sales\Model\Order\Pdf\Invoice;
use Psr\Log\LoggerInterface;
/**
 * Class PdfInvoice
 * @package LogicSpot\CmsBlock\Plugin
 */
class InvoicePdf
{
    /**
     * @var Data
     */
    protected $_helper;
    /**
     * @var LoggerInterface
     */
    protected $_logger;
    /**
     * InvoicePdf constructor.
     * @param Data $helper
     * @param LoggerInterface $logger
     */
    public function __construct(Data $helper, LoggerInterface $logger)
    {
        $this->_helper = $helper;
        $this->_logger = $logger;
    }

    /**
     * @param Invoice $subject
     * @param $result
     * @return mixed
     */
    public function afterGetPdf(\Magento\Sales\Model\Order\Pdf\Invoice $subject, \Zend_Pdf $result)
    {
        $page = end($result->pages);
        try {
            $this->_helper->drawFooter($subject, $page);
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }
        return $result;
    }

}
