#!/bin/sh
# Site backup template for Rackspace Cloud

# Archive database
#mysqldump --opt -hhost -ppassword -uuser database > /mnt/targetNN/NNNNNN/NNNNNN/www.domain.com/backups/db_backup_`date +%y%m%d`.sql

#gzip -f /mnt/targetNN/NNNNNN/NNNNNN/www.domain.com/backups/db_backup_`date +%y%m%d`.sql
 
# Archive installation
#tar -czf www.domain.com/web_backup_`date +%y%m%d%H`.tgz www.domain.com/web/content/

# Extract archive
# Make sure destination directory exists
#mkdir domain.com/extract_`date +%y%m%d%H`
#tar -xzf domain.com/web_backup_current.tgz -C domain.com/extract_`date +%y%m%d%H`

# Manual extract
#tar -czf sub.domain.com/web_backup_`date +%y%m%d%H`.tgz sub.domain.com/web/content/
#tar -xzf www.domain.com/web_backup_YYMMDDHH.tgz -C www.anotherdomain.com/folder
