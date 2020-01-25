<?php

/**
 * Build various graphs using Chart JS library.
 * http://www.chartjs.org/
 *
 */
class CRM_Reportplus_Utils_ChartJS {

  /**
   * Colours.
   * @var array
   */
  private static $_colours = [
    '#4dc9f6',
    '#f67019',
    '#f53794',
    '#537bc4',
    '#acc236',
    '#166a8f',
    '#00a950',
    '#58595b',
    '#8549ba'
  ];

  /**
   * @param $rows
   * @param $chart
   * @param $interval
   */
  public static function chart($rows, $type, $xLabels, $params = []) {
    $data = self::getData($rows, $type, $xLabels, $params);
    $options = self::getOptions($type, $params);

    // assign chart data to template
    $template = CRM_Core_Smarty::singleton();
    $template->assign('chartJSData', json_encode($data));
    $template->assign('chartJSOptions', json_encode($options));
  }

  public static function getOptions($type, $params = []) {
    $options = [
      'responsive' => 'true',
      'legend' => [
        'position' => 'top',
      ],
      'title' => [
        'display' => 'true',
        'text' => !empty($params['title']) ?: $params['description'],
      ]
    ];

    return $options;
  }

  public static function getData($rows, $type, $xLabels, $params = []) {
    // remove last column from rows id showTotal
    if (!empty($params['showTotals'])) {
      foreach ($rows as $keyA => $valueA) {
        unset($rows[$keyA]['col_total']);
      }
      unset($xLabels['col_total']);
    }

    $data = [];
    $data['labels'] = array_column($xLabels, 'title');
    switch ($type) {
      case 'doughnut':
      case 'pie':
        $data['datasets'] = self::pie($rows, $params);
        break;

      case 'bar':
      case 'horizontalBar':
        $data['datasets'] = self::bar($rows, $params);
        break;

      case 'line':
        $data['datasets'] = self::line($rows, $params);
        break;
    }

    return $data;
  }

  private static function line($rows, $params = []) {
    $datasets = self::bar($rows);

    foreach ($datasets as $key => $dataset) {
      $datasets[$key]['fill'] = !empty($params['chartjs_line_fill']);
      $datasets[$key]['lineTension'] = !empty($params['chartjs_line_smooth']) ? 0.4 : 0;
      if ($dataset['label'] == 'Total') {
        $datasets[$key]['borderWidth'] = 4;
      }
    }

    return $datasets;
  }

  private static function bar($rows, $params = []) {
    $i = 0;
    $datasets = [];

    foreach ($rows as $yLabel => $row) {
      $color = self::$_colours[$i % (count(self::$_colours))];
      $datasets[] = [
        'label' => $yLabel,
      //color(window.chartColors.red).alpha(0.5).rgbString(),
        'backgroundColor' => $color,
      //window.chartColors.red,
        'borderColor' => $color,
        'borderWidth' => 1,
        'data' => array_values($row),
      ];
      $i++;
    }

    return $datasets;
  }

  private static function pie($rows, $params = []) {
    $i = 0;
    $datasets = [];

    foreach ($rows as $yLabel => $row) {
      //$color = self::$_colours[$i % (count(self::$_colours))];
      $datasets[] = [
        'label' => $yLabel,
      //color(window.chartColors.red).alpha(0.5).rgbString(),
        'backgroundColor' => array_slice(self::$_colours, count(array_values($row))),
        'data' => array_values($row),
      ];
      $i++;
    }

    return $datasets;
  }

}
