<?php

/* 
 * Ryan Byrd
 * 10/16/2018
 * functions.php
 * A page for storing custom functions so the user does not gain access to them
 */

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}
