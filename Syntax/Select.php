<?php

class Select extends Syntax
{
  private $columns;
  private $from;
  private $where;

  function __construct($columns = '*')
  {
    $this->columns($columns);
  }

  public function columns($columns)
  {
    $this->columns = new SeletColumns($columns);
    return $this;
  }

  public function from($name, $alias = null)
  {
    $this->from = new From($name, $alias);
    return $this;
  }

  public function where($conditions)
  {
    $this->where = new Where($conditions);
    return $this;
  }
}