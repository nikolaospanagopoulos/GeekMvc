<?php
$timestamp = time();
if (!isset($argv[1])) {
	die("Please add a migration name");
}
$x = $argv[1];
function createFileAndWrite($filename, $type)
{
	$timestamp = time();
	$myfile = fopen("./migrations/" . $filename . $type . $timestamp . ".php", "w") or die("Unable to open file!");
	$txt = '<?php
use App\Core\Database;
class migration' . $filename . $type . $timestamp . '
{
	public function ' . $type . '()
	{
		$db = Database::$db;
         //write your query here
	}
}
';
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "file created successfully \n";
}

createFileAndWrite($x, "up");
createFileAndWrite($x, "down");
