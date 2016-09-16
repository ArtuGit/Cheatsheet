_now=$(date +"%Y_%m_%d-%H:%M")
source_site_directory_name="/home/u2983/domains/devel7.itcross.com.ua"
backup_file_name="itc_demo_backup_$_now.tar.gz"

clear
echo "--- The Website Backup start---"
bash site_backup.sh $source_site_directory_name $backup_file_name
echo "--- The Website Backup end---"
