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
        foreach($config as $field => $join){
            if(!isset($join['table']) || !isset($join['field'])) continue;

            $this->query .= ((isset($join['type'])) ? $join['type'] : 'INNER') . ' JOIN ';
            $this->query .= $join['table'] . " ON " . $this->table . ".$field = ".$join['table'] . '.' . $join['field'] . " ";
        }

        return $this;
    }

    public function delete(){        
        $this->query .= "DELETE FROM " . $this->table . " ";
        return $this;
    }

    public function insert(array $fields){
        $valuesQuery = "";

        foreach($fields as $idx => $field){
            $valuesQuery .= ":" . $field;
            if($idx + 1 < sizeof($fields)) $valuesQuery .= ", ";
        }

        $this->query .= "INSERT INTO " . $this->table . "(" . implode(',', $fields) . ") VALUES($valuesQuery)";
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
            $query .= $field . " = :" . $field;
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