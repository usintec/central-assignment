<?php
namespace KanbanBoard;

class LoadConfiguration {
    public static function addToEnv(){
        $handle = fopen("../../.env", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                putenv(trim($line));
            }
            fclose($handle);
        } else {
            // error opening the file.
        } 
    }
}