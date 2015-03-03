<?php
// Setup File: 

# Disable error reporting
error_reporting(0);

# Database Connection
include("../config/connection.php");

# Constants:
DEFINE('D_TEMPLATE', 'template');

# Functions:
include("functions/data.php");
include("functions/template.php");
include("functions/sandbox.php");


# Site Setup:
$debug = data_setting_value($dbc, 'debug-status');

$site_title = 'AtomCMS 2.0';

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	
	$page = 'dashboard';
	
}


# Page Setup
include("config/queries.php");



# User Setup
$user = data_user($dbc,$_SESSION['username']);
?>