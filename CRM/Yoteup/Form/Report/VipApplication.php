<?php

class CRM_Yoteup_Form_Report_VipApplication extends CRM_Report_Form {

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
    $this->assign('reportTitle', ts('VIP Application Report'));
    parent::preProcess();
  }

  function select() {
    $columns =  array(
      'Contact_ID' => array(
        'title' => 'Contact ID',
      ),
      'Enrollment_Term' => array(
        'title' => 'Enrollment Term',
      ),
      'Enrollment_Status' => array(
        'title' => 'Enrollment Status',
      ),
      'Intended_Major' => array(
        'title' => 'Intended Major',
      ),
      'Legal_First_Name' => array(
        'title' => 'Legal First Name',
      ),
      'Legal_Middle_Name' => array(
        'title' => 'Legal Middle Name',
      ),
      'Legal_Last_Name' => array(
        'title' => 'Legal Last Name',
      ),
      'Nickname' => array(
        'title' => 'Nickname',
      ),
      'Gender' => array(
        'title' => 'Gender',
        'columnName' => 'g.label',
      ),
      'Birth_Date' => array(
        'title' => 'Birth Date',
      ),
      'Street_Address' => array(
        'title' => 'Street Address',
      ),
      'Address_Line_2' => array(
        'title' => 'Address Line 2',
      ),
      'Address_Line_3' => array(
        'title' => 'Address Line 3',
      ),
      'City' => array(
        'title' => 'City',
      ),
      'State/Province' => array(
        'title' => 'State/Province',
      ),
      'Postal_Code' => array(
        'title' => 'Postal Code',
      ),
      'State_of_Official_Residence_Country' => array(
        'title' => 'State of Official Residence Country',
      ),
      'Phone_Number' => array(
        'title' => 'Phone Number',
      ),
      'Please_send_occasional_admissions_related_news_and_updates_to_my_phone_as_text_messages' => array(
        'title' => 'Please send occasional admissions related news and updates to my phone as text messages',
      ),
      'Email_How_did_you_become_interested_in_The_College_of_Idaho_and_why_are_you_applying_for_admission?' => array(
        'title' => 'Email	How did you become interested in The College of Idaho and why are you applying for admission?',
      ),
      'Are_you_a_U.S._Citizen?' => array(
        'title' => 'Are you a U.S. Citizen?',
      ),
      'Citizen_of' => array(
        'title' => 'Citizen of',
      ),
      'What_is_your_current_Visa_Status_in_the_US?' => array(
        'title' => 'What is your current Visa Status in the US?',
      ),
      'Number_of_years_residing_in_the_USA' => array(
        'title' => 'Number of years residing in the USA',
      ),
      'School_Name_1' => array(
        'title' => 'School Name',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 42,
      ),
      'School_City_&_State_1' => array(
        'title' => 'School City & State',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 43,
      ),
      'Dates_Attended_1' => array(
        'title' => 'Dates Attended',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 44,
      ),
      'Graduation_Date_1' => array(
        'title' => 'Graduation Date',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 45,
      ),
      'Degree(s)_Earned_1' => array(
        'title' => 'Degree(s) Earned',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 46,
      ),
      'School_Name_2' => array(
        'title' => 'School Name',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 57,
      ),
      'School_City_&_State_2' => array(
        'title' => 'School City & State',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 58,
      ),
      'Dates_Attended_2' => array(
        'title' => 'Dates Attended',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 59,
      ),
      'Graduation_Date_2' => array(
        'title' => 'Graduation Date',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 60,
      ),
      'Degree(s)_Earned_2' => array(
        'title' => 'Degree(s) Earned',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 61,
      ),
      'Have_you_attended_another_college?' => array(
        'title' => 'Have you attended another college?',
      ),
      'School_Name_3' => array(
        'title' => 'School Name',
        'same_alias' => TRUE,
        'alias' => 3,
        'cid' => 52,
      ),
      'School_City_&_State_3' => array(
        'title' => 'School City & State',
        'same_alias' => TRUE,
        'alias' => 3,
        'cid' => 53,
      ),
      'Dates_Attended_3' => array(
        'title' => 'Dates Attended',
        'same_alias' => TRUE,
        'alias' => 3,
        'cid' => 54,
      ),
      'Graduation_Date_3' => array(
        'title' => 'Graduation Date',
        'same_alias' => TRUE,
        'alias' => 3,
        'cid' => 55,
      ),
      'Degrees_Earned_1' => array(
        'title' => 'Degrees Earned',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 55,
      ),
      'School_Name_4' => array(
        'title' => 'School Name',
        'same_alias' => TRUE,
        'alias' => 4,
        'cid' => 47,
      ),
      'School_City_&_State_4' => array(
        'title' => 'School City & State',
        'same_alias' => TRUE,
        'alias' => 4,
        'cid' => 48,
      ),
      'Dates_Attended_4' => array(
        'title' => 'Dates Attended',
        'same_alias' => TRUE,
        'alias' => 4,
        'cid' => 49,
      ),
      'Graduation_Date_4' => array(
        'title' => 'Graduation Date',
        'same_alias' => TRUE,
        'alias' => 4,
        'cid' => 50,
      ),
      'Degrees_Earned_2' => array(
        'title' => 'Degrees Earned',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 51,
      ),
      'High_School_GPA' => array(
        'title' => 'High School GPA',
      ),
      'Have_you_ever_been_dismissed_for_academic_or_disciplinary_reasons_from_a_secondary_school_or_college?' => array(
        'title' => 'Have you ever been dismissed for academic or disciplinary reasons from a secondary school or college?',
        'columnName' => 'yesno_alias.name',
      ),
      'If_yes,_please_explain' => array(
        'title' => 'If yes, please explain',
      ),
      'Have_you_ever_been_convicted_of_a_crime,_other_than_a_minor_traffic_violation?' => array(
        'title' => 'Have you ever been convicted of a crime, other than a minor traffic violation?',
        'columnName' => 'yesno_alias.name',
      ),
      'If_yes,_please_explain_2' => array(
        'title' => 'If yes, please explain 2',
      ),
      'Date_Taken_(or_planned)' => array(
        'title' => 'Date Taken (or planned)',
      ),
      'Critical_Reading_Score' => array(
        'title' => 'Critical Reading Score',
      ),
      'Math_Score' => array(
        'title' => 'Math Score',
      ),
      'Writing_Score' => array(
        'title' => 'Writing Score',
      ),
      'ACT_Date_Taken_(or_planned)' => array(
        'title' => 'ACT Date Taken (or planned)',
      ),
      'ACT_Score' => array(
        'title' => 'ACT Score',
      ),
      'TOEFL_ Date' => array(
        'title' => 'TOEFL Date',
      ),
      'TOEFL_Score' => array(
        'title' => 'TOEFL Score',
      ),
      'First_Name_1' => array(
        'title' => 'First Name',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 124,
      ),
      'Last_Name_1' => array(
        'title' => 'Last Name',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 180,
      ),
      'Phone_1' => array(
        'title' => 'Phone',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 125,
      ),
      'Email_1' => array(
        'title' => 'Email',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 126,
      ),
      'Relationship_1' => array(
        'title' => 'Relationship',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 181,
      ),
      'Education_Level_1' => array(
        'title' => 'Education Level',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 127,
        'columnName' => 'edu_1_alias.name',
      ),
      'Institution(s)_attended_1' => array(
        'title' => 'Institution(s) attended',
        'same_alias' => TRUE,
        'alias' => 1,
        'cid' => 182,
      ),
      'First_Name_2' => array(
        'title' => 'First Name',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 128,
      ),
      'Last_Name_2' => array(
        'title' => 'Last Name',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 187,
      ),
      'Phone_2' => array(
        'title' => 'Phone',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 129,
      ),
      'Email_2' => array(
        'title' => 'Email',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 130,
      ),
      'Relationship_2' => array(
        'title' => 'Relationship',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 183,
      ),
      'Education_Level_2' => array(
        'title' => 'Education Level',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 131,
        'columnName' => 'edu_2_alias.name',
      ),
      'Institution(s)_attended_2' => array(
        'title' => 'Institution(s) attended',
        'same_alias' => TRUE,
        'alias' => 2,
        'cid' => 184,
      ),
      'Are_you_of_Hispanic_or_Latino_descent' => array(
        'title' => 'Are you of Hispanic or Latino descent',
        'columnName' => 'yesno_alias.name',
      ),
      'Please_select_the_category_that_best_reflects_your_ethnic_background' => array(
        'title' => 'Please select the category that best reflects your ethnic background',
        'columnName' => 'category_alias.name',
      ),
      'Athletic_Interests' => array(
        'title' => 'Athletic Interests',
        'columnName' => 'athletic_alias.name',
      ),
      'Activity_Interests' => array(
        'title' => 'Activity Interests',
        'columnName' => 'activity_alias.name',
      ),
      /* 'Nonresident_Alien' => array( */
      /*   'title' => 'Nonresident Alien', */
      /* ), */
      /* 'Race_and_Ethnicity_unknown' => array( */
      /*   'title' => 'Race and Ethnicity unknown', */
      /* ), */
      /* 'Hispanics_of_any_race' => array( */
      /*   'title' => 'Hispanics of any race', */
      /* ), */
      /* 'American_Indian_/_Alaska_Native_(Original_Peoples_of_the_Americas)' => array( */
      /*   'title' => 'American Indian / Alaska Native (Original Peoples of the Americas)', */
      /* ), */
      /* 'Asian_(including_Indian_subcontitent_and_Phillipines)' => array( */
      /*   'title' => 'Asian (including Indian subcontitent and Phillipines)', */
      /* ), */
      /* 'Black_/_African_American_(Including_Africa_and_the_Caribbean)' => array( */
      /*   'title' => 'Black / African American (Including Africa and the Caribbean)', */
      /* ), */
      /* 'Native_Hawaiian_or Other Pacific Islander (Original Peoples)' => array( */
      /*   'title' => 'Native Hawaiian or Other Pacific Islander (Original Peoples)', */
      /* ), */
      /* 'White_(including_Middle_Eastern)' => array( */
      /*   'title' => 'White (including Middle Eastern)', */
      /* ), */
      /* 'Two_or_more_races' => array( */
      /*   'title' => 'Two or more races', */
      /* ), */
      /* 'Men\'s_Baseball' => array( */
      /*   'title' => 'Men\'s Baseball', */
      /* ), */
      /* 'Men\'s_Basketball' => array( */
      /*   'title' => 'Men\'s Basketball', */
      /* ), */
      /* 'Men\'s_Cheerleading' => array( */
      /*   'title' => 'Men\'s Cheerleading', */
      /* ), */
      /* 'Men\'s_Cross_Country' => array( */
      /*   'title' => 'Men\'s Cross Country', */
      /* ), */
      /* 'Men\'s_Football' => array( */
      /*   'title' => 'Men\'s Football', */
      /* ), */
      /* 'Men\'s_Golf' => array( */
      /*   'title' => 'Men\'s Golf', */
      /* ), */
    );
		
/* 			
Men's Lacrosse	
Men's Skiing	
Men's Soccer	
Men's Swimming	
Men's Track & Field 
Men's Tennis	 */
/* Women's Basketball	 */
/* Women's Cross Country	 */
/* Women's Golf	 */
/* Women's Skiing	 */
/* Women's Soccer	 */
/* Women's Softball	 */
/* Women's Swimming	 */
/* Women's Tennis	 */
/* Women's Volleyball	 */
/* Women's Track & Field	 */
/* Women's Bowling	 */
/* Women's Cheerleading	 */
/* Women's LaCrosse	 */
/* Campus Ministries	 */
/* Clubs & Organizations	 */
/* Greek Life	 */
/* Intramurals	 */
/* Outdoor Programs	 */
/* Student Government	 */
/* Student Publications	 */
/* Study Abroad	 */
/* Sustainable Living	 */
/* Fraternity/Sorority	 */
/* Honors/Academic Clubs	 */
/* Campus Ministry  */

    CRM_Yoteup_BAO_Yoteup::reportSelectClause($this, $columns);
  }

  function from() { 
    CRM_Yoteup_BAO_Yoteup::reportFromClause($this->_from, TRUE, array('category', 'athletic', 'activity', 'edu_1', 'edu_2', 'yesno'));
  }

  function where() {
    CRM_Yoteup_BAO_Yoteup::reportWhereClause($this->_where, 70);
  }

  function groupBy() {
    $this->_groupBy = "GROUP BY wsd.sid";
  }

  function orderBy() {
    return FALSE;
  }

  function postProcess() {

    $this->beginPostProcess();
    
    $tempTables = array(
      167 => 'category',
      159 => 'athletic',
      158 => 'activity',
      195 => 'edu_1',
      196 => 'edu_2',
    );
    self::createTemp($tempTables);
    self::createYesNo();

    $sql = $this->buildQuery(FALSE);

    $rows = array();
    $this->buildRows($sql, $rows);

    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }
  
  function createYesNo() {
    CRM_Core_DAO::executeQuery("CREATE TEMPORARY TABLE IF NOT EXISTS yesno (
      value varchar(64) NOT NULL,
      name varchar(64) NOT NULL)"
    );
    CRM_Core_DAO::executeQuery("INSERT INTO yesno VALUES (0, 'No'), (1, 'Yes')");
  }

  function createTemp($tempTables) {
    foreach ($tempTables as $optId => $tableName) {
      $result = $vals = array();
      $sql = "SELECT label, value FROM civicrm_option_value WHERE option_group_id = {$optId}";
      $dao = CRM_Core_DAO::executeQuery($sql);
      while ($dao->fetch()) {
        $result[$dao->value] = $dao->label;
      }
      CRM_Core_DAO::executeQuery("DROP TEMPORARY TABLE IF EXISTS {$tableName}");
      CRM_Core_DAO::executeQuery("CREATE TEMPORARY TABLE IF NOT EXISTS {$tableName} (
        value varchar(64) NOT NULL,
        name varchar(64) NOT NULL)"
      );
      $sql = "INSERT INTO {$tableName} VALUES";
      foreach ($result as $key => $items) {
        $items = addslashes($items);
        $vals[] = " ('{$key}', '{$items}')";
      }
      $sql .= implode(',', $vals);
      CRM_Core_DAO::executeQuery($sql);
    }
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