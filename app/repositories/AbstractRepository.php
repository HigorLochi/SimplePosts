<?php

namespace app\repositories;

abstract class AbstractRepository{
    private $tableName;
    
    protected function limit(int $limit, int $page): string{
        $query = "";
        
        if($limit > 0 && $page > 0) {
            $query .= " LIMIT " . (($page - 1) * $limit);

            if($limit > 0) $query .= ", $limit";
        }else 
            $query .= " LIMIT " . $limit;
        
        return $query;
    }
}