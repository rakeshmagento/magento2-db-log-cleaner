# magento2-db-log-cleaner
Magento2 Cron Log Cleaning, the module will clean the following tables weekly

report_event

report_viewed_product_index

report_compared_product_index

customer_visitor

# installation

1.Copy it to app/code/

2.Execute following commands

php bin/magento setup:upgrade

php bin/magento setup:static-content:deploy

php bin/magento cache:flush

php bin/magento cache:clean

3.The module will be installed and listed, if you run following commad

php bin/magento module:status

4.Now run the cron commads

php bin/magento cron:run

5.Now open the table cron_schedual , there is a new entry db_log_cleaning, that will be processed on time.




