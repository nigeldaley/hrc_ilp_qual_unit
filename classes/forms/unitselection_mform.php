<?php

require_once($CFG->dirroot.'/lib/formslib.php');

require_once($CFG->dirroot.'/blocks/ilp/db/ilp_mis_connection.php');

class unitselection_mform extends moodleform {


    public 		$course_id;
    public      $qualid;
    public      $db;


    /**
     * TODO comment this
     */
    function __construct($course_id) {

        global $CFG;

        $this->course_id	=	$course_id;

        $course     =   get_record('course','id',$course_id);

        $this->qualid  =   $course->idnumber;

        $this->db = new ilp_mis_connection();

        // call the parent constructor
        parent::__construct("{$CFG->wwwroot}/blocks/ilp_qual_unit/actions/edit_units.php?course_id=".$course_id);
    }


    /**
     * TODO comment this
     */
    function definition() {
        global $USER, $CFG;

        $mform =& $this->_form;

        $course     =   get_record('course','id',$this->course_id);



        $title	=	get_string('selectcourseunits','block_ilp_qual_unit');
        //create a new fieldset
        $mform->addElement('html', '<fieldset id="reportfieldset" class="clearfix ilpfieldset">');
        $mform->addElement('html', '<legend class="ftoggler">'.$title.$course->fullname.'</legend>');

        $mform->addElement('html', get_string('selectcourseunitsdesc','block_ilp_qual_unit'));

        $mform->addElement('hidden', 'course_id',$this->course_id);
        $mform->setType('course_id', PARAM_INT);


        $qualificationunits =   $this->db->return_table_values('ofqual_qualification_units',array('qualificationid'=>array('='=>"'{$this->qualid}'")));

	if (!empty($qualificationunits))   {
            $i  =   0;
            foreach($qualificationunits as $qu)   {
                $title  =   $qu['UniqueReferenceNumber']." - ".$qu["Title"];
                $i  =   $qu['UniqueReferenceNumber'];
                $mform->addElement('advcheckbox', "unit[$i]", '', $title, array('group' => 1), array(0, $qu['UniqueReferenceNumber']));

            }
        }

        $buttonarray[] = &$mform->createElement('submit', 'submitbutton', get_string('submit'));
        $buttonarray[] = &$mform->createElement('cancel');

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);

        //close the fieldset
        $mform->addElement('html', '</fieldset>');
    }


    /**
     * TODO comment this
     */
    function process_data($data) {
        global	$CFG,$USER;

        foreach($data->unit as $idx => $v)   {

            $qual  =   get_record('ilp_qual_units','UniqueReferenceNumber',$idx,'courseid',$data->course_id);
            if (empty($qual))  {
                $course     =   get_record('course','id',$data->course_id);

                $qualificationunits =   $this->db->return_table_values('ofqual_qualification_units',array('UniqueReferenceNumber'=>array('='=>"'$idx'"),'qualificationid'=>array('='=>"'$course->idnumber'")));

                if (!empty($qualificationunits))   {
                    $qual   =   new stdClass();

                        $q  =   $qualificationunits[0];

                        $qual->courseid     =   $data->course_id;
                        //$qual->academic_year     =   $q['academic_year'];
                        $qual->qualificationid     =   $q['QualificationID'];
                        $qual->UniqueReferenceNumber     =   $q['UniqueReferenceNumber'];
                        $qual->title     =   $q['Title'];
                        $qual->unitownerreference     =   $q['UnitOwnerReference'];

                    $qual->selected =   (!empty($v))  ?  1 :  0 ;

                    $qual->title    =   mysql_real_escape_string($qual->title);

                    insert_record('ilp_qual_units',$qual);
                }
            }   else {



                $qual->selected =   (!empty($v))  ?  1 :  0 ;
                update_record('ilp_qual_units',$qual);
            }
        }

    }

    /**
     * TODO comment this
     */
    function definition_after_data() {

    }
//comment


}
