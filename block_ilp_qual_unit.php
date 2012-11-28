<?php

class block_ilp_qual_unit extends block_base {

    function init() {
        $this->title = get_string('title', 'block_ilp_qual_unit');
        $this->version = 2007101509;
    }

    function get_content() {
        global $CFG, $USER, $COURSE;


		if ($this->content !== NULL) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        $this->content->footer = '';

		$context = get_context_instance(CONTEXT_COURSE, $COURSE->id);

        $doanything =   has_capability('moodle/site:doanything', get_context_instance(CONTEXT_SYSTEM));

        if (has_capability('block/ilp_qual_unit:editunits', $context)) {
			$this->content->text = "<a href='{$CFG->wwwroot}/blocks/ilp_qual_unit/actions/edit_units.php?course_id={$COURSE->id}' >".get_string('editilpunits','block_ilp_qual_unit')."</a>";
        } else {
			$this->content->text =	get_string('notauthorised','block_ilp_qual_unit');
		}

        return $this->content;
    }
}

?>