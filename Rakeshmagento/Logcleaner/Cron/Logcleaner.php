<?php
namespace Rakeshmagento\Logcleaner\Cron;

use \Psr\Log\LoggerInterface;

class Logcleaner {

    protected $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

	/**
    * cleanup the logs tables.
    *
    * @return void
    */

    public function execute() {

        $this->logger->info('Db Log cleaning cron started..!');
        //Get Object Manager Instance
        $objectManager  = \Magento\Framework\App\ObjectManager::getInstance();
        $resource       = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection     = $resource->getConnection();

        $tablesToTurncate = array(
                            'report_event',
                            'report_viewed_product_index',
                            'report_compared_product_index',
                            'customer_visitor'
                        );
        foreach($tablesToTurncate as $_key => $value){

            $tableName  = $resource->getTableName($value);
            $sql        = "TRUNCATE ".$tableName;
            
            try{
                $connection->query($sql);
                $this->logger->info($tableName.' cleaned up.');
            }catch(\Exception $e){
                $this->logger->critical($e);
            }
        }
        $this->logger->info('Db Log cleaning cron ended..!');

        return $this;
    }

}