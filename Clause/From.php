<?php
class From extends Clause
{
  private $tableName;
  private $tableAlias;

  public function __construct($tableName, $tableAlias = null)
  {
    $this->tableName = $tableName;
    $this->tableAlias = $tableAlias == null ? $tableName : $tableAlias;
  }

  public function render() {
    return sprintf('from %s %s', $this->tableName, $this->tableAlias);
  }
}