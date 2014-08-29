<?php



function installDB()
{
    //echo "$sqlServer $sqlUsername";
    require './config.php';
    
    $db=  mysql_connect($sqlServer, $sqlUsername, $sqlPassword);
    if(!$db)
    {
        die("服务器出了点问题，连接不到数据库。");
    }else if(!mysql_select_db($dbName))
    {
        die("无法找到表：$dbName");
    }
    $sqlcmd="CREATE TABLE URLs
        (
        ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        FullURL TEXT
        )";
    if(!mysql_query($sqlcmd))
    {
        die("创建表失败，可能已经存在或权限问题。");
    }
    mysql_close($db);
}