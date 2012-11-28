<?php
/**
 * Sets up the capabilities for accessing the ILP qualification unit
 * block module.
 *
 */

$block_ilp_qual_unit_capabilities = array(

    'block/ilp_qual_unit:editunits' => array(

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'legacy' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'admin' => CAP_ALLOW
        )
    ),
);