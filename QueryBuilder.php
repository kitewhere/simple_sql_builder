<?php

/**
 * 
 */
class QueryBuilder
{
  public function select($fields)
  {
    return new Select($fields);
  }

  public function update()
  {

  }

  public function insert()
  {

  }

  public function delete()
  {

  }
}