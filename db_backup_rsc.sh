#!/bin/sh
# Database backup template for Rackspace Cloud

mysqldump --opt -hhost -ppassword -uuser database > /mnt/targetNN/NNNNNN/NNNNNN/www.domain.com/backups/db_backup_`date +%y%m%d`.sql

gzip -f /mnt/targetNN/NNNNNN/NNNNNN/www.domain.com/backups/db_backup_`date +%y%m%d`.sql
