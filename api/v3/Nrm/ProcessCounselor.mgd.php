<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'Cron:Nrm.ProcessCounselor',
    'entity' => 'Job',
    'params' => 
    array (
      'version' => 3,
      'name' => 'Process Counselors',
      'description' => 'Send mail report to counselors',
      'run_frequency' => 'Daily',
      'api_entity' => 'Nrm',
      'api_action' => 'Processcounselor',
      'parameters' => '',
    ),
  ),
);