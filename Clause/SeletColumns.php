<?php
/**
 * Created by PhpStorm.
 * User: kitewhere
 * Date: 2018/8/22
 * Time: 上午12:24
 */

class SeletColumns
{
  private $columns;

  public function getColumns()
  {
    return $this->columns;
  }

  public function __construct($columns)
  {
    if (is_string($columns)) {
      $columns = explode(',', $columns);
    }

    foreach ($columns as $table => &$column) {
      if (is_string($column)) {
        $column = $this->parseColumeStr($column);
      } else if (is_array($column)) {
        $column = $this->parseColumeArr($column);
      }

      if (is_string($table)) {
        $column['table'] = $table;
      }
    }
    unset($column);

    $this->columns = $columns;
  }

  private function parseColumeStr($str) {
    $pattern = '/^((?<table>[a-zA-Z\$_][a-zA-Z\d_]*)\.)?(?<column>[a-zA-Z\$_][a-zA-Z\d_]*)(\s+as\s+(?<alias>[a-zA-Z\$_][a-zA-Z\d_]*))?$/';

    if (1 !== preg_match($pattern, trim($str), $matches)) {
      throw new Exception("invalid column $str");
    }
    return array(
      'table' => $matches['table'],
      'column' => $matches['column'],
      'alias' => $matches['alias'],
    );
  }

  private function parseColumeArr($column)
  {
    if (!isset($column['column'])) {
      throw new Exception('column array need column key');
    }

    return array(
      'column' => $column['column'],
      'table' => $this->getColumnPart($column, 'table'),
      'alias' => $this->getColumnPart($column, 'alias'),
    );
  }

  private function getColumnPart($column, $part)
  {
    if (!isset($column[$part])) {
      return '';
    }

    if (! is_string($column[$part])) {
      throw new Exception("column.$part need a string");
    }

    return $column[$part];
  }
}