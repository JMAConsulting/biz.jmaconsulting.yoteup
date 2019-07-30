<?php

class CRM_Nrm_Form_Report_SurveyDaily18 extends CRM_Report_Form {

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
    $this->_groupFilter = TRUE;
    $this->_tagFilter = TRUE;
    parent::__construct();
  }

  function preProcess() {
    $this->assign('reportTitle', ts('Survey Daily Report for 2018'));
    parent::preProcess();
  }

  function select() {
    $columns =  array(
      /* 'Submitted_Time' => array( */
      /*   'title' => 'Submitted Time', */
      /*   'ignore_group_concat' => TRUE, */
      /*   'columnName' => "DATE_FORMAT(FROM_UNIXTIME(ws.completed), '%m-%d-%Y %r')", */
      /* ), */
      'First_Name' => array(
        'title' => 'First Name',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_contact.first_name',
      ),
      'Middle_Name' => array(
        'title' => 'Middle Name',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_contact.middle_name',
      ),
      'Last_Name' => array(
        'title' => 'Last Name',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_contact.last_name',
      ),
      'Nick_Name' => array(
        'title' => 'Nickname',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_contact.nick_name',
      ),
      'Birth_Date' => array(
        'title' => 'Birth Date',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_contact.birth_date',
      ),
      'Gender' => array(
        'title' => 'Gender',
        'ignore_group_concat' => TRUE,
        'columnName' => 'g.label',
      ),
      'Street_Address' => array(
        'title' => 'Street Address',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_address.street_address',
      ),
      'Street_Address_Line_2' => array(
        'title' => 'Street Address Line 2',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_address.supplemental_address_1',
      ),
      'City' => array(
        'title' => 'City',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_address.city',
      ),
      'State' => array(
        'title' => 'State',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_state_province.name',
      ),
      'Postal_Code' => array(
        'title' => 'Postal Code',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_address.postal_code',
      ),
      'Phone' => array(
        'title' => 'Phone',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_phone.phone',
      ),
      'Email' => array(
        'title' => 'Email',
        'ignore_group_concat' => TRUE,
        'columnName' => 'civicrm_email.email',
      ),
      'What_is_the_most_important_factor_in_your_college_decision' => array(
        'title' => 'What is the most important factor in your college decision',
        'ignore_group_concat' => TRUE,
        'columnName' => 'webform_items_temp_128.name',
      ),
      'How_would_you_most_prefer_to_be_contacted' => array(
        'title' => 'How would you most prefer to be contacted',
        'columnName' => 'webform_items_temp_131.name',
        'ignore_group_concat' => TRUE,
      ),
    );
    CRM_Nrm_BAO_Nrm::reportSelectClause($this, $columns, FALSE, FALSE);
  }

  function from() { 
    $config = CRM_Core_Config::singleton();
    $dsnArray = DB::parseDSN($config->userFrameworkDSN);
    $drupalDb = $dsnArray['database'];
    $fields = array(128 => 'civicrm_1_contact_1_cg20_custom_401', 131 => 'how_would_you_most_prefer_to_be_contacted');
    foreach($fields as $nodeId => $field) {
    $sql = "SELECT extra, cid
      FROM {$drupalDb}.webform_component
      WHERE form_key = '$field' AND nid = $nodeId";
    $results = CRM_Core_DAO::executeQuery($sql);
    $results->fetch();
    CRM_Core_DAO::executeQuery("DROP TEMPORARY TABLE IF EXISTS webform_items_temp_{$nodeId}");
    CRM_Core_DAO::executeQuery("CREATE TEMPORARY TABLE IF NOT EXISTS webform_items_temp_{$nodeId} (
      cid int(50) NOT NULL,
      value varchar(64) NOT NULL,
      name varchar(64) NOT NULL)"
    );
    $sql = "INSERT INTO webform_items_temp_{$nodeId} VALUES";
      $result = unserialize($results->extra);
      $items = explode("\n", $result['items']);
      foreach ($items as $key => &$item) {
        if($item) {
          $item = explode('|', $item);
          $vals[] = " ({$results->cid}, '{$item[0]}', '{$item[1]}')";
        }
      }
      $sql .= implode(',', $vals);
      CRM_Core_DAO::executeQuery($sql);
    }
    $surveyFields = array(
      128 => array(
        'What_is_the_most_important_factor_in_your_college_decision' => 'What is the most important factor in your college decision?',
      ),
      131 => array(
        'how_would_you_most_prefer_to_be_contacted' => 'How would you most prefer to be contacted?',
      ),
    );
    $this->_from = "FROM civicrm_contact
      LEFT JOIN civicrm_address ON civicrm_address.contact_id = civicrm_contact.id AND civicrm_address.is_primary = 1
      LEFT JOIN civicrm_state_province ON civicrm_state_province.id = civicrm_address.state_province_id
      LEFT JOIN civicrm_phone ON civicrm_phone.contact_id = civicrm_contact.id AND civicrm_phone.is_primary = 1
      LEFT JOIN civicrm_email ON civicrm_email.contact_id = civicrm_contact.id AND civicrm_email.is_primary = 1
      LEFT JOIN civicrm_option_value g ON civicrm_contact.gender_id = g.value AND g.option_group_id = 3 ";
    foreach ($surveyFields as $nodeId => $fields) {
      $select = array();
      $select[] = "GROUP_CONCAT(if(wc.cid=2, wsd.data, NULL)) AS contact_id";
        foreach ($fields as $alias => $field) {
        $select[] = "GROUP_CONCAT(if(wc.name='$field', wsd.data, NULL)) AS '{$alias}'";
      }
      $this->_from .= " LEFT JOIN (SELECT " . implode(',', $select) . 
        " FROM {$drupalDb}.webform_submitted_data wsd
          LEFT JOIN {$drupalDb}.webform_component wc ON wc.cid = wsd.cid
          LEFT JOIN {$drupalDb}.webform_submissions ws ON ws.sid = wsd.sid
          WHERE wc.nid = {$nodeId} AND wsd.nid = {$nodeId}
          AND DATE(FROM_UNIXTIME(ws.completed)) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY wsd.sid) AS temp_{$nodeId} ON temp_{$nodeId}.contact_id = civicrm_contact.id
          LEFT JOIN webform_items_temp_{$nodeId} AS webform_items_temp_{$nodeId} ON webform_items_temp_{$nodeId}.value = temp_{$nodeId}.{$alias}
        ";
    }
  }

  function where() {
    $this->_where = ' WHERE (temp_128.contact_id IS NOT NULL AND temp_131.contact_id IS NOT NULL )';
  }

  function groupBy() {
    return FALSE;
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
  }
}