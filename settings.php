<?php

$globalsettings 	= new admin_setting_heading('block_ilp_qual_unit/reportconfig', get_string('connectionsettings', 'block_ilp_qual_unit'), '');

$settings->add($globalsettings);


$mis_settings 	= new admin_setting_heading('block_ilp_qual_unit/mis_connection', get_string('mis_connection', 'block_ilp_qual_unit'), '');
$settings->add($mis_settings);
$options = array(
    ' '     => get_string('noconnection','block_ilp_qual_unit'),
    'mssql' => 'Mssql',
    'mysql' => 'Mysql',
    'odbc' => 'Odbc',
    'oci8' => 'Oracle',
    'postgres' => 'Postgres',
    'sybase' => 'Sybase'
);
$mis_connection			= 	new admin_setting_configselect('block_ilp_qual_unit/dbconnectiontype',get_string('db_connection','block_ilp_qual_unit'),get_string('reportconfigurationsection','block_ilp_qual_unit'), '', $options);
$settings->add( $mis_connection );
/*
*/

$dbname			=	new admin_setting_configtext('block_ilp_qual_unit/dbname',get_string( 'db_name', 'block_ilp_qual_unit' ),get_string( 'set_db_name', 'block_ilp_qual_unit' ),'',PARAM_RAW);
$settings->add($dbname);

$dbhost			=	new admin_setting_configtext('block_ilp_qual_unit/dbhost',get_string( 'db_host', 'block_ilp_qual_unit' ), get_string( 'host_name_or_ip', 'block_ilp_qual_unit' ),'',PARAM_RAW);
$settings->add($dbhost);

$dbuser			=	new admin_setting_configtext('block_ilp_qual_unit/dbuser',get_string( 'db_user', 'block_ilp_qual_unit' ), get_string( 'db_user', 'block_ilp_qual_unit' ),'',PARAM_RAW);
$settings->add( $dbuser );

$dbpass			=	new admin_setting_configtext('block_ilp_qual_unit/dbpass',get_string( 'db_pass', 'block_ilp_qual_unit' ), get_string( 'db_pass', 'block_ilp_qual_unit' ),'',PARAM_RAW);
$settings->add($dbpass);

$miscsettings 	= new admin_setting_heading('block_ilp_qual_unit/miscoptions', get_string('miscoptions', 'block_ilp_qual_unit'), '');

$settings->add($miscsettings);


?>