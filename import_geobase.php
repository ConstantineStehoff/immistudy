<?php
/*
* Template Name: Import geobase
*/
?>
<!DOCTYPE HTML>
<html>
<meta http-equiv="Content-Type" content="type/html"; charset= "utf-8"/>
<?php

require_once(IMMISTUDY_DIR . '/classes/Mysql.php');
$mysql = New Mysql();

set_time_limit(0); // указываем, чтобы скрипт не ограничивался временем по умолчанию
ignore_user_abort(1); // указываем, чтобы скрипт продолжал работать даже при разрыве

// проверяем наличие файла cities.txt в папке рядом с этим скриптом
if(file_exists(ROOT_DIR . '/geo/cities.txt'))
{
    $mysql->truncate_geocities();
    //mysql_query("TRUNCATE TABLE `geo_cities`"); // очищаем таблицу перед импортом актуальных данных
    $cities_handle = fopen(ROOT_DIR . '/geo/cities.txt', "rb");
    $pattern = '#(\d+)\s+(.*?)\t+(.*?)\t+(.*?)\t+(.*?)\s+(.*)#';
    while (!feof($cities_handle) ) {
        $line_of_cities = fgets($cities_handle); 
        $line_of_cities = iconv('windows-1251', 'utf-8', $line_of_cities);
        if( preg_match($pattern, $line_of_cities, $out) ){
            $mysql->import_geocities($out[1], $out[2], $out[3], $out[4], $out[5], $out[6]);
        }
    }
    fclose($cities_handle);
    echo mysql_error();
}else
{
    echo 'Ошибка! Файл cities.txt должен лежать рядом с этим файлом!';
}

// проверяем наличие файла cidr_optim.txt в папке рядом с этим скриптом
if(file_exists(ROOT_DIR . '/geo/cidr_optim.txt'))
{
    $mysql->truncate_geobase();
    //mysql_query("TRUNCATE TABLE `geo_base`"); // очищаем таблицу перед импортом актуальных данных
    $file_handle = fopen(ROOT_DIR . '/geo/cidr_optim.txt', "rb");
    $pattern = '#(\d+)\s+(\d+)\s+(\d+\.\d+\.\d+\.\d+)\s+-\s+(\d+\.\d+\.\d+\.\d+)\s+(\w+)\s+(\d+|-)#';
    while (!feof($file_handle) ) {
        $line_of_text = fgets($file_handle); //$line_data = fscanf($file_handle, "%s %s %s %s %s [%[^]]] %s\n");
        if( preg_match($pattern, $line_of_text, $out) ){
           $mysql->import_geobase($out[1], $out[2], $out[3], $out[4], $out[5], $out[6]);
        }
    }
    fclose($file_handle);
    echo mysql_error();
}else
{
    echo 'Ошибка! Файл cidr_optim.txt должен лежать рядом с этим файлом!';
}


?>