<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  // public function index() {
  //   $this->new_db = $this->load->database('new_db',true);
  //   $table_fields1 = $this->new_db->list_fields('shri_niwash');
  //   $table_fields2 = $this->db->list_fields('shri_niwash');
  //
  //   $current_missing_columns = array_diff($table_fields1, $table_fields2);
  //   $missing_columns = array_values($current_missing_columns);
  //
  //   $table = "shri_niwash";
  //   $table_fields1 = $this->new_db->list_fields('shri_niwash');
  //   $table_fields2 = $this->db->list_fields('shri_niwash');
  //   $current_missing_columns = array_diff($table_fields1, $table_fields2);
  //   $missing_columns = array_values($current_missing_columns);
  //   if(!empty($missing_columns))
  //   {
  //     foreach($missing_columns as $columns)
  //     {
  //       $column_infos = $this->new_db->field_data("shri_niwash", 'type');
  //       $column_names = '';
  //       $column_types = '';
  //       $column_default = '';
  //       $max_length = '';
  //       $has_default_value = false;
  //       $column_default = null;
  //
  //       foreach ($column_infos as $column_info) {
  //         if ($column_info->name == $columns) {
  //           $column_names = $column_info->name;
  //           $column_types = $column_info->type;
  //           $column_default = $column_info->default;
  //           $max_length = $column_info->max_length;
  //           $has_default_value = isset($column_info->default) && $column_info->default !== null;
  //           $column_default = $has_default_value ? $column_info->default : null;
  //         }
  //       }
  //       // print_r($column_default);
  //
  //       $types;
  //
  //       if ($column_types == 'timestamp') {
  //         $types = $column_types;
  //       } elseif ($column_types == 'enum') {
  //         // Handle enum type and wrap them into the signle quote ///
  //         $enum_values = $this->getEnumValues($table, $column_names);
  //         $quoted_enum_values = array_map(function ($value) {
  //           return "'" . $value . "'";
  //         }, $enum_values);
  //         $types = 'enum(' . implode(',', $quoted_enum_values) . ')';
  //       } else {
  //         $types = $column_types . "($max_length)";
  //       }
  //
  //       if (!$this->db->field_exists($column_names, $table)) {
  //         $sql = "ALTER TABLE `$table` ADD `$column_names` $types";
  //         // Add default value if it exists
  //         if ($has_default_value) {
  //           $sql .= " DEFAULT '{$column_default}'";
  //         }
  //         $this->db->query($sql);
  //         echo "Added missing column '$columns' to table '$table' in the second database.<br>";
  //       } else {
  //         echo 'The column already exists.';
  //       }
  //     }
  //
  //   }
  //   else{
  //
  //   }
  // }
  public function index()
  {
    // $this->load->view('welcome_message');
    $this->load->library('Dompdf_lib');
    $html = '<p>Hello, World!</p>';

    // Generate the base64-encoded PDF content
    $base64EncodedPdf = $this->dompdf_lib->generatePdf($html);

    // Do something with $base64EncodedPdf, for example, send it to the view
    $data['base64EncodedPdf'] = $base64EncodedPdf;

    print_r($base64EncodedPdf);die;
    $this->load->view('your_pdf_view', $data);
  }

  function getEnumValues($table, $column) {
    $this->new_db = $this->load->database('new_db',true);
    $query = $this->new_db->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    $result = $query->row();
    preg_match("/^enum\((.*)\)$/", $result->Type, $matches);
    $enumValues = array_map(function ($value) {
      return trim($value, "'");
    }, explode(',', $matches[1]));
    return $enumValues;
  }




}
