<?php

namespace Core\ORM;

Class ORMBase {
    protected $sql;
    protected $where = [];
    protected $order = [];
    protected $limit;
    protected $offset;

    public static function query() {
        $query = new static();
        return $query;
    }

    public function get() {
        $this->sql = "select * from " . $this->getTableName();
        if(!empty($this->where)) {
            $cond = implode(" AND ", $this->where);
            $this->sql .= " WHERE " . $cond;
        }
        return $this->executeStatment();
    }

    public function where($column, $operator, $value) {
        if(is_string($value)) {
            $value = "\"$value\"";
        }else if (is_array($value)) {
            foreach($value as $index => $key) {
                if(is_string($key)){
                    $value[$index] = "\"$key\"";
                }
            }
            $value = "(" . implode(",", $value) . ")";
        }
        $this->where[] = "$column $operator $value";
        return $this;
    }

    protected function executeStatment() {
        return get_connection()->query($this->sql);
    }

    protected function getTableName () {
        $class = get_called_class();
        $parts = explode("\\", $class);
        return  strtolower($parts[count($parts) - 1]);
    }


}
