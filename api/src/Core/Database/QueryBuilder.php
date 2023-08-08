<?php

namespace App\Core\Database;
class QueryBuilder
{
    protected $params;
    protected $type;
    protected $fields;
    protected $table;
    protected $where;
    protected $values;
    protected $set;
    protected array $join_array;
    protected array $on_array;

    public function __construct()
    {
        $this->params = [];
    }

    public function select($fields = "*"): QueryBuilder
    {
        $this->type = "select";
        $fields_string = $fields;
        if (is_array($fields)) {
            $fields_string = implode(", ", $fields);
        }
        $this->fields = $fields_string;
        return $this;
    }

    public function from($table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function getSql()
    {
        switch ($this->type) {
            case 'select':
                $sql = "SELECT {$this->fields} FROM {$this->table}";
                if (!empty($this->where)) {
                    $sql .= " WHERE {$this->where}";
                }
                if (!empty($this->join_array)) {
                    foreach ($this->join_array as $key => $value) {
                        $join_to_upper = strtoupper($key);
                        $sql .= " {$join_to_upper} JOIN {$value}";
                        if (!empty($this->on_array)) {
                            foreach ($this->on_array as $first => $second) {
                                $sql .= " ON {$first}={$second}";
                            }
                        }
                    }
                }
                return $sql;
                break;
            case 'insert':
                $sql = "INSERT INTO {$this->table} ($this->fields) VALUES ('{$this->values}')";
                return $sql;
                break;
            case 'update':
                $sql = "UPDATE {$this->table} SET {$this->set}";
                if (!empty($this->where)) {
                    $sql .= " WHERE {$this->where}";
                }
                return $sql;
                break;
            case 'delete':
                $sql = "DELETE FROM {$this->table}";
                if (!empty($this->where)) {
                    $sql .= " WHERE {$this->where}";
                }
                return $sql;
                break;
        }
    }

    public function where($where): QueryBuilder
    {
//        if(is_a($where)){
//
//        }
        $where_string = "";
        $where_parts = [];
        foreach ($where as $key => $value) {
            $where_parts [] = "{$key} = ':{$key}'";
            $this->params[$key] = $value;
        }
        $this->where = implode(' AND ', $where_parts);
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function insert($table, $fields = " "): QueryBuilder
    {
        $this->type = "insert";
        $this->table = $table;
        $fields_string = $fields;
        if (is_array($fields)) {
            $fields_string = implode(", ", $fields);
        }
        $this->fields = $fields_string;
        return $this;
    }

    public function Values($values): QueryBuilder
    {
        $values_string = $values;
        if (is_array($values)) {
            $values_string = implode("', '", $values);
        }
        $this->values = $values_string;
        return $this;
    }

    public function update($table): QueryBuilder
    {
        $this->type = "update";
        $this->table = $table;
        return $this;
    }

    public function set($set): QueryBuilder
    {
//        if(is_a($set)){
//
//        }
        $set_string = "";
        $set_parts = [];
        foreach ($set as $key => $value) {
            $set_parts [] = "{$key} = ':{$key}'";
            $this->params[$key] = $value;
        }
        $this->set = implode(', ', $set_parts);
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->type = "delete";
        return $this;
    }

    public function join($join_type, $table): QueryBuilder
    {
        $this->join_array[] = ["{$join_type}" => "{$table}"];  //I put join type for first argument of associative array and table name for second argument of associative array,
        // which I want to connect to my sql request, but I have any problems to conversation elements of array to string type.
        return $this;
    }

    public function on($first_field, $second_field): QueryBuilder
    {
        $this->on_array[] = ["{$first_field}" => "{$second_field}"]; //Same(
        return $this;
    }
    //So my main problem is associative array.
}
