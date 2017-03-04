<?php
require 'vendor/autoload.php';
use pixel418\markdownify\ConverterExtra;

function connect_db($database_settings) {
    $mysqli = new mysqli($database_settings['server'], $database_settings['user'], $database_settings['password'], $database_settings['database']);
    if ($mysqli->connect_errno) {
        echo "Mysql connexion error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        die();
    }
    return $mysqli;
}

function tableExist($table, $mysqli) {
    $show_table_sql = 'SHOW TABLES LIKE "'.$table.'"';
    echo $show_table_sql.'<br />';

    $result = $mysqli->query($show_table_sql);
    if(mysqli_num_rows($result) == 1) {
        return true; // exist
    }
    else {
        return false; // not exist
    }
}
    
function deleteTable($table, $mysqli) {
    $delete_table_sql = 'DROP TABLE '.$table;
    echo $delete_table_sql.'<br />';
    
    if ($result = $mysqli->query($delete_table_sql)) {
        return true;
    }
    else {
        echo "Empty table ".$table." error: (" . $mysqli->errno . ") " . $mysqli->error;
        return false;
    }
}

function createTable($table, $create_table_sql, $mysqli) {
    echo $create_table_sql.'<br />';
    $result = $mysqli->query($create_table_sql);
    return true;
}

/* execute a query. If error then die(); else return $result */
function execQueryOrDie($sql, $mysqli) {
    if (!$result = $mysqli->query($sql)) {
        // error
        echo "Query error: (" . $mysqli->errno . ") " . $mysqli->error;
        echo "<br />";
    	echo $sql;
        echo "<br />";
        die();
    }
    else {
        return $result;
    }
}

/* prepareText :
    1 - decode
    2 - MD convert
    3 - espace string for mysql insert
*/
function prepareText($string, $mysqli) {   
    // word copy paste remove and special chars
    $find[] = 'â€œ';  // left side double smart quote
    $find[] = 'â€';  // right side double smart quote
    $find[] = 'â€˜';  // left side single smart quote
    $find[] = 'â€™';  // right side single smart quote
    $find[] = 'â€¦';  // elipsis
    $find[] = 'â€”';  // em dash
    $find[] = 'â€“';  // en dash
    
    $find[] = '&nbsp;';  // special char => space
    $find[] = '&rsquo;'; // special char => '
    
  
    $replace[] = '"';
    $replace[] = '"';
    $replace[] = "'";
    $replace[] = "'";
    $replace[] = "...";
    $replace[] = "-";
    $replace[] = "-";
    
    $replace[] = " ";  
    $replace[] = "'";

    $result = str_replace($find, $replace, $string);

    // remove html entities
    $result = html_entity_decode($result, ENT_QUOTES, "UTF-8");

    // delete html tag like <div> <span> <strong> <a href ...
    $result = strip_tags($result, '<p><br><h1><h2><h3><h4><h5><h6>');
        
    // convert to MD
    $converter = new Markdownify\ConverterExtra;
    $result = $converter->parseString($result);              
    
    // delete html tag like <p><br><h1>... not converted by the MD converter
    $result = strip_tags($result);
    
    // ' => \' ... for mysql command compatibility
    $result = $mysqli->real_escape_string($result);
    
    return $result;
}
?>