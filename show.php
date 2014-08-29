<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Toby's 短网址 - 缩短结果</title>
    </head>
    <body>
        <?php
            function shortCode($strURL)
            {
                require './config.php';
                $db=mysql_connect($sqlServer,$sqlUsername,$sqlPassword);
                if((!$db)||(!mysql_select_db($dbName)))
                {
                    die("数据库故障。如果这是第一运行请配置好config.php，执行install_web.php！");
                }
                //查找表中是否已有对应ShortCode，有则读取+返回 没有则建立+返回
                $result=mysql_query("SELECT * FROM URLs WHERE FullURL=\"$strURL\"");
                if($row=mysql_fetch_array($result))
                {
                    return $row["ID"];
                }else
                {
                    //没，建吧
                    $sqlcmd="INSERT INTO URLs (FullURL) VALUES ('$strURL')";
                    if(!mysql_query($sqlcmd))
                    {
                        die("数据库写入失败。");
                    }
                    return mysql_insert_id($db);
                }
            }
        
            if(isset($_GET["url"])||trim($_GET["url"])!="")
            {
                echo "<p>已将".htmlspecialchars($_GET["url"])."缩短为：</p>"
                        . "<p><strong>http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["REQUEST_URI"]) . "/?s=" . shortCode($_GET["url"]) . "</strong></p>";
            }
        ?>
    </body>
</html>
