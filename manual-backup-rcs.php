<?php
/*******************************************************************************
 *
 * A backup script that works with the Rackspace Cloud Sites Load Balancer
 *
 * Based on a script by Jereme Hancock. For more information, see:
 * http://cloudsitesrock.com/?ac=list&cat=6&m=0&y=0
 *
 *******************************************************************************/

/*****
 * Your Cloud Sites settings
 */

/* Server-side path web directory */
define("BACKUP_PATH", "");

/* MySQL database settings */
define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASSWORD", "");
define("DB_DBNAME", "");

/* The site files within your web content folder */
define("SITE_PATH", "");


/*****
 * Run a command while preventing load balancer timeouts
 */
function run_command($cmd) {
	$pipe = popen($cmd, 'r');

    if (empty($pipe)) {
    	throw new Exception("Unable to open pipe for command '$cmd'");
    }

    stream_set_blocking($pipe, false);
    echo "\n";

	// Status display may not work depending on your hosting environment
    while (!feof($pipe)) {
    	fread($pipe, 1024);
    	sleep(1);
    	echo ".";
    	flush();
    }
    pclose($pipe);
	echo "Done<br/>";
}


/*****
 * Start the script
 */
$now = gmdate("YmdHi", time());
$db_backup_filename = BACKUP_PATH."db_backup_".$now.".sql";
$site_backup_filename = BACKUP_PATH."wordpress_".$now.".zip";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title>Backup</title>
</head>
<body>
<?php
echo "<p>Starting backup at ".$now."...</p>";

/*
 * Backup the database
 */
echo "Backing up database...<br />";
$cmd = "mysqldump --opt -h".DB_HOST.
 			" -p".DB_PASSWORD.
			" -u".DB_USER.
			" ".DB_DBNAME." >".
			" ".$db_backup_filename;
run_command($cmd);

$cmd = "gzip -f ".$db_backup_filename;
run_command($cmd);
echo "Database backed up<br />";

/*
 * Backup the site files
 */
echo "Backing up site files...<br />";
$cmd = "zip -9prv ".$site_backup_filename." ".SITE_PATH;
run_command($cmd);
echo "Site files backed up";
echo "<p>Backup complete</p>";

?>