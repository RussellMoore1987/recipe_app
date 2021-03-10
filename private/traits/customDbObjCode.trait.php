<?php
    trait CustomDbObjCode {
        // #things only in reference to collection_type_reference start
            // delete connecting record
            public function delete_connection_records($tableName, $NameOfId, $id) {
                $sql = "DELETE FROM {$tableName} ";
                $sql .= "WHERE {$NameOfId}='{$id}' ";
                // perform query
                $result = self::$database->query($sql);
                // error handling
                $result = self::db_error_check($result);
                // return result
                return $result;
            }

            // make connecting record
            public function insert_connection_record($tableName, array $NameOfColumns_array, array $values_array) {
                // set variables
                $column1 = $NameOfColumns_array[0];
                $column2 = $NameOfColumns_array[1];
                $columnValue1 = $values_array[0];
                $columnValue2 = $values_array[1];

                // make sql
                $sql = "INSERT INTO {$tableName} ({$column1}, {$column2}) ";
                $sql .= "VALUES ({$columnValue1}, {$columnValue2}) ";
                // perform query
                $result = self::$database->query($sql);
                // error handling
                $result = self::db_error_check($result);
                // return result
                return $result;
            }
        // #things only in reference to collection_type_reference start  
    }
    
?>