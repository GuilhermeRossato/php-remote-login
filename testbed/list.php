<?php

session_start();

if (!isset($_SESSION)) {
	echo "You don't have a $_SESSION variable set";
	exit(1);
}
echo "<pre>";
if ($_SESSION['username'] === "Guilherme") {
	echo "Welcome aboard, here's the secret:\n\n";
	echo "42 is the meaning of life\n\n";
}
var_export($_SERVER);
var_export($_SESSION);
echo "</pre>";
?>