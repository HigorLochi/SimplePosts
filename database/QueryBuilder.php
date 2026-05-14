<?php

namespace database;

class QueryBuilder{
    private string $table = "";
    private string $query = "";

    public function getQuery(): string{
        $query = $this->query;
        $this->query = "";
        
        return $query;
    }

    public function table(string $table){        
        $this->table = $table;
        return $this;
    }

    public function select(array $fields){     
        $this->query .= "SELECT " . implode(',', $fields). " FROM " . $this->table . " ";   
        return $this;
    }

    public function join(array $config){
        foreach($config as $join){
            if(!isset($join['leftTable']) || !isset($join['leftField']) || !isset($join['rightTable']) || !isset($join['rightField'])) continue;

            $this->query .= ((isset($join['type'])) ? $join['type'] : 'INNER') . ' JOIN ';
            $this->query .= $join['rightTable'] . " ON " . $join['leftTable'] . "." . $join['leftField'] . " = ".$join['rightTable'] . '.' . $join['rightField'] . " ";
        }

        return $this;
    }

    public function delete(){        
        $this->query .= "DELETE FROM " . $this->table . " ";
        return $this;
    }

    public function insert(array $fields){
        $fiedsQuery = (sizeof($fields) > 0) ? implode(',', $fields) : "" ;
        $valuesQuery = "";

        foreach($fields as $idx => $field){
            $valuesQuery .= ":" . $field;
            if($idx + 1 < sizeof($fields)) $valuesQuery .= ", ";
        }

        $this->query .= "INSERT INTO " . $this->table . "(" . $fiedsQuery . ") VALUES($valuesQuery)";
        return $this;
    }

    public function update(array $fields){
        $valuesQuery = "";

        foreach($fields as $idx => $field){
            $valuesQuery .= "$field = :$field";
            if($idx + 1 < sizeof($fields)) $valuesQuery .= ", ";
        }

        $this->query .= "UPDATE " . $this->table . " SET " . $valuesQuery . " ";
        return $this;
    }

    public function where(array $fields){
        $query = "WHERE ";
        
        foreach($fields as $idx => $field){
            $query .= $field . " = :" . (strpos($field, '.') !== false ? explode('.', $field)[1] : $field);
            if($idx + 1 < sizeof($fields)) $query .= ", ";
        }

        $this->query .= $query . " ";
        return $this;
    }

    public function order(array $fields){
        $this->query .= "ORDER BY " . implode(',', $fields) . " ";
        return $this;
    }

    public function limit(int $limit, int $page){
        $query = "";
        
        if($limit > 0 && $page > 0) {
            $query .= " LIMIT " . (($page - 1) * $limit);

            if($limit > 0) $query .= ", $limit";
        }else 
            $query .= " LIMIT " . $limit;
        
        $this->query .= $query;
        return $this;
    }
}