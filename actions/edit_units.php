<?php
require_once('../../../config.php');

require_login();

global  $CFG,   $USER;

require_once($CFG->dirroot.'/blocks/ilp_qual_unit/classes/forms/unitselection_mform.php');

$course_id   =   required_param('course_id',PARAM_INT);

$mform	= new	unitselection_mform($course_id);

//was the form cancelled?
if ($mform->is_cancelled()) {
    //send the user back to dashboard
    $return_url = $CFG->wwwroot.'/course/view.php?id='.$course_id;
    redirect($return_url, '', 60);
}


//was the form submitted?
// has the form been submitted?
if($mform->is_submitted()) {
    // check the validation rules
    if($mform->is_validated()) {

        //get the form data submitted
        $formdata = $mform->get_data();

        // process the data
        $success = $mform->process_data($formdata);


        $return_url = $CFG->wwwroot.'/course/view.php?id='.$course_id;
        redirect($return_url, get_string("unitsupdated", 'block_ilp_qual_unit'), ILP_REDIRECT_DELAY);
    }
}



if ($units  =   get_records('ilp_qual_units','courseid',$course_id)) 	{

    $unitdata   =   new stdClass();
    $unitdata->unit =   array();
    foreach($units as $u)    {
        if (!empty($u->selected))   {
        $unitdata->unit[$u->uniquereferencenumber]   =   $u->uniquereferencenumber;
        }
    }

    $unitdata->course_id    =   $course_id;

    //loop through the plugins and get the data for each one
    $mform->set_data($unitdata);
}

print_header();

$mform->display();

print_footer();





