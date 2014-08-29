<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Toby's 短网址</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <?php
            $ok=false;
            $r=$_SERVER["HTTP_HOST"];
            if(isset($_GET["s"]))
            {
                require './config.php';
                $db=mysql_connect($sqlServer,$sqlUsername,$sqlPassword);
                if((!$db)||(!mysql_select_db($dbName)))
                {
                    die("数据库故障。如果这是第一运行请配置好config.php，执行install_web.php！");
                }
                $result=mysql_query("SELECT * FROM URLs WHERE ID=" . $_GET["s"]);
                if($row=mysql_fetch_array($result))
                {
                    $r=$row["FullURL"];
                    echo "<meta http-equiv=\"refresh\" content=\"1;url=$r\">";
                    $ok=true;
                }
            }
        ?>
    </head>
    <body>
        <?php
            if(!isset($_GET["s"]))
            {
                echo "<p class='info'>没有指定短网址跳转参数！</p><p class='info'>制作短网址请前往<a href='add.html'>此处</a></p>";
            }
            if($ok)
            {
                echo "<p class='info'>正跳转至$r</p>";
            }
        ?>
    </body>
</html>
