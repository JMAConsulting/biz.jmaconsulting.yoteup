<?php

class CRM_Yoteup_Form_Report_RequestedInfo extends CRM_Report_Form {

  protected $_summary = NULL;

  protected $_customGroupGroupBy = FALSE; 

  function __construct() { 
    $this->_columns = array(
      'civicrm_contact' => array(
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' => array(
          'display_name' => array(
            'title' => ts('Student Info'),
            'required' => TRUE,
            'default' => TRUE,
            'no_repeat' => TRUE,
          ),
        ),
        'grouping' => 'contact-fields',
      ),
    );
    $this->_groupFilter = FALSE;
    $this->_tagFilter = FALSE;
    parent::__construct();
  }

  function preProcess() {
    $this->assign('reportTitle', ts('Requested Information Report'));
    parent::preProcess();
  }

  function select() {
    $columns =  array(
      'Submitted_Time' => array(
        'title' => 'Submitted Time',
        'ignore_group_concat' => TRUE,
        'columnName' => "DATE_FORMAT(FROM_UNIXTIME(ws.completed), '%m-%d-%Y %r')",
      ),
      'First_Name' => array(
        'title' => 'First Name',
      ),
      'Middle_Name' => array(
        'title' => 'Middle Name',
      ),
      'Last_Name' => array(
        'title' => 'Last Name',
      ),
      'Preferred_Name' => array(
        'title' => 'Preferred Name',
      ),
      'Address' => array(
        'title' => 'Address',
      ),
      'Address_Line_2' => array(
        'title' => 'Address Line 2',
      ),
      'City' => array(
        'title' => 'City',
      ),
      'State' => array(
        'title' => 'State',
      ),
      'Zip_Code' => array(
        'title' => 'Zip Code',
      ),
      'Email' => array(
        'title' => 'Email',
      ),
      'Home_Phone' => array(
        'title' => 'Home Phone',
      ),
      'Mobile_Phone' => array(
        'title' => 'Mobile Phone',
      ),
      'Please_send_occasional_admissions_related_news_and_updates_to_my_phone_as_text_messages' => array(
        'title' => 'Please send occasional admissions related news and updates to my phone as text messages',
      ),
      'Gender' => array(
        'title' => 'Gender',
        'columnName' => 'g.label',
      ),
      'High_School_Attended' => array(
        'title' => 'High School Attended',
      ),
      'High_School_City_&_State' => array(
        'title' => 'High School City & State',
      ),
      'High_School_Graduation_Date' => array(
        'title' => 'High School Graduation Date',
      ),
      'Academic_Interests' => array(
        'title' => 'Academic Interests',
      ),
      'Athletic_Interests' => array(
        'title' => 'Athletic Interests',
      ),
      'Extra-Curricular_Interests' => array(
        'title' => 'Extra-Curricular Interests',
      ),
    );

    CRM_Yoteup_BAO_Yoteup::reportSelectClause($this, $columns);
  }

  function from() { 
    CRM_Yoteup_BAO_Yoteup::reportFromClause($this->_from);
  }

  function where() {
    CRM_Yoteup_BAO_Yoteup::reportWhereClause($this->_where, 72);
  }

  function groupBy() {
    $this->_groupBy = "GROUP BY wsd.sid";
  }

  function orderBy() {
    return FALSE;
  }

  function postProcess() {

    $this->beginPostProcess();

    $sql = $this->buildQuery(FALSE);

    $rows = array();
    $this->buildRows($sql, $rows);

    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }

  function alterDisplay(&$rows) {
    // custom code to alter rows
    $entryFound = FALSE;
    $checkList = array();
    foreach ($rows as $rowNum => $row) {

      if (!empty($this->_noRepeats) && $this->_outputMode != 'csv') {
        // not repeat contact display names if it matches with the one
        // in previous row
        $repeatFound = FALSE;
        foreach ($row as $colName => $colVal) {
          if (CRM_Utils_Array::value($colName, $checkList) &&
            is_array($checkList[$colName]) &&
            in_array($colVal, $checkList[$colName])
          ) {
            $rows[$rowNum][$colName] = "";
            $repeatFound = TRUE;
          }
          if (in_array($colName, $this->_noRepeats)) {
            $checkList[$colName][] = $colVal;
          }
        }
      }

      if (!$entryFound) {
        break;
      }
    }
  }
}
