<?php
$timestamp = time();
if (!isset($argv[1])) {
	die("Please add a migration name");
}
$x = $argv[1];
function createFileAndWrite($filename)
{
	$timestamp = time();
	$myfile = fopen("./migrations/" . $filename . $timestamp . ".php", "w") or die("Unable to open file!");
	$txt = "<?php

class migration" . $filename . $timestamp . "
{
	public function up()
	{
	}
	public function down()
	{
	}
}
";
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "file created successfully ";
}

createFileAndWrite($x);
