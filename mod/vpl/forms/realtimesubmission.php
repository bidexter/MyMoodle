<?php

/**
 * Launches Online submission mode
 * @package mod_vpl
 * @copyright 2012 Juan Carlos Rodríguez-del-Pino
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Juan Carlos Rodríguez-del-Pino <jcrodriguez@dis.ulpgc.es>
 */
require_once(__DIR__ . '/../../../config.php');
require_once(dirname(__FILE__) . '/../locallib.php');
require_once(dirname(__FILE__) . '/../vpl.class.php');
require_once(dirname(__FILE__) . '/../vpl_submission.class.php');
require_once(dirname(__FILE__) . '/../views/sh_factory.class.php');
global $USER, $DB;
require_login();
$id = required_param('id', PARAM_INT);
$userid = optional_param('userid', false, PARAM_INT);
$copy = optional_param('privatecopy', false, PARAM_INT);
$subid = optional_param( 'submissionid', false, PARAM_INT );
$vpl = new mod_vpl($id);
$pageparms = array('id' => $id);
if ($userid && ! $copy) {
    $pageparms['userid'] = $userid;
}
if ($copy) {
    $pageparms['privatecopy'] = 1;
}
if ($subid) {
    $pageparms['submissionid'] = $subid;
}
$vpl->prepare_page( 'forms/edit.php', $pageparms );
if (! $vpl->is_visible()) {
    vpl_redirect('?id=' . $id, get_string( 'notavailable' ), 'error' );
}
if (! $vpl->is_submit_able()) {
    vpl_redirect('?id=' . $id, get_string( 'notavailable' ), 'error' );
}
if (! $userid || $userid == $USER->id) { // Edit own submission.
    $userid = $USER->id;
    $vpl->require_capability( VPL_SUBMIT_CAPABILITY );
} else { // Edit other user submission.
    $vpl->require_capability( VPL_GRADE_CAPABILITY );
}
$vpl->restrictions_check();

$instance = $vpl->get_instance();

$grader = $vpl->has_capability(VPL_GRADE_CAPABILITY);
// Print header.
$vpl->print_header(get_string('realtimesubmission', VPL));
$vpl->print_view_tabs(basename(__FILE__));
$vpl->print_footer();

