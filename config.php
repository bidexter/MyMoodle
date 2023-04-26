<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();
#$release  = '4.1.2+ (Build: 20230401)';
$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'moodle412';
$CFG->dbuser    = 'root';
$CFG->dbpass    = '';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_general_ci',
);

$CFG->wwwroot   = 'http://www.localhost/moodledata';
$CFG->dataroot  = 'C:\\xampp\\phpMyAdmin\\moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

#$CFG->cachejs = false;
$CFG->showcrondebugging = true;
#$CFG->langstringcache = false;
@ini_set('display_errors', '1');         // NOT FOR PRODUCTION SERVERS!
$CFG->debug = (E_ALL | E_STRICT);   // === DEBUG_DEVELOPER - NOT FOR PRODUCTION SERVERS!
$CFG->debugdisplay = 1; 

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
