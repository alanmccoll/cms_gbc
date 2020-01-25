<?php

/**
 * Class CRM_Reportplus_Form
 */

class CRM_Reportplus_Utils_Report extends CRM_Report_Utils_Report {
  /**
   * @param CRM_Core_Form $form
   * @param $form
   * @param $rows
   */
  public static function export2csv(&$form, &$rows) {
    //Mark as a CSV file.
    if (isset($form->_csvEncoding)) {
      header('Content-Type: text/csv; charset=' . $form->_csvEncoding);
    }
    else {
      header('Content-Type: text/csv');
    }

    //Force a download and name the file using the current timestamp.
    $datetime = date('Ymd-Gi', $_SERVER['REQUEST_TIME']);
    header('Content-Disposition: attachment; filename=' . $form->_csvFilename . '_' . $datetime . '.' . $form->_csvFileExtension);

    $csv = self::makeCsv($form, $rows);
    if (isset($form->_csvEncoding)) {
      $csv = mb_convert_encoding($csv, $form->_csvEncoding, "UTF-8");
    }

    echo $csv;
    CRM_Utils_System::civiExit();
  }

  /**
   * Utility function for export2csv and CRM_Report_Form::endPostProcess
   * - make CSV file content and return as string.
   */
  public static function makeCsv(&$form, &$rows) {
    $config = CRM_Core_Config::singleton();
    $csv = '';
    if (!isset($form->_csvSeparator)) {
      $form->_csvSeparator = $config->fieldSeparator;
    }

    // Add headers if this is the first row.
    $columnHeaders = array_keys($form->_columnHeaders);

    // Replace internal header names with friendly ones, where available.
    if ($form->_csvShowHeaders) {
      foreach ($columnHeaders as $header) {
        if (isset($form->_columnHeaders[$header])) {
          $headers[] = '"' . html_entity_decode(strip_tags($form->_columnHeaders[$header]['title'])) . '"';
        }
      }
      // Add the headers.
      $csv .= implode($form->_csvSeparator, $headers) . "\r\n";
    }

    $displayRows = [];
    $value = NULL;
    foreach ($rows as $row) {
      foreach ($columnHeaders as $k => $v) {
        $value = CRM_Utils_Array::value($v, $row);
        if (isset($value)) {
          // Remove HTML, unencode entities, and escape quotation marks.
          if ($form->_csvEnclose) {
            $value = str_replace('"', '""', html_entity_decode(strip_tags($value)));
          }
          else {
            $value = html_entity_decode(strip_tags($value));
          }

          if (CRM_Utils_Array::value('type', $form->_columnHeaders[$v]) & 4) {
            if (CRM_Utils_Array::value('group_by', $form->_columnHeaders[$v]) == 'MONTH' ||
              CRM_Utils_Array::value('group_by', $form->_columnHeaders[$v]) == 'QUARTER'
            ) {
              $value = CRM_Utils_Date::customFormat($value, $config->dateformatPartial);
            }
            elseif (CRM_Utils_Array::value('group_by', $form->_columnHeaders[$v]) == 'YEAR') {
              $value = CRM_Utils_Date::customFormat($value, $config->dateformatYear);
            }
            elseif ($form->_columnHeaders[$v]['type'] == 12) {
              // This is a datetime format
              $value = CRM_Utils_Date::customFormat($value, '%Y-%m-%d %H:%i');
            }
            else {
              $value = CRM_Utils_Date::customFormat($value, '%Y-%m-%d');
            }
          }
          elseif (CRM_Utils_Array::value('type', $form->_columnHeaders[$v]) == 1024) {
            $value = CRM_Utils_Money::format($value, $row['civicrm_contribution_currency']);
          }

          if ($form->_csvEnclose) {
            $displayRows[$v] = '"' . $value . '"';
          }
          else {
            $displayRows[$v] = $value;
          }
        }
        else {
          $displayRows[$v] = "";
        }
      }
      // Add the data row.
      $csv .= implode($form->_csvSeparator, $displayRows) . "\r\n";
    }

    return $csv;
  }
}
