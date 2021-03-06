<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin DB</title>
</head>
<body>
    <?php
    // 接続情報
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "lesson1";
    // インプット値
    $i_user = (string)filter_input(INPUT_POST, 'user');
    $i_newpass = (string)filter_input(INPUT_POST, 'newpass');

    try {
    	$pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // SQL発行
        $stmt = $pdo->prepare("UPDATE login SET pass = ? WHERE user = ?");
        $stmt->bindValue(1, $i_newpass);
        $stmt->bindValue(2, $i_user);
        $stmt->execute();
        if ($stmt->rowCount()===0) {
            print "指定したユーザは存在しません";
        }else{
            print "パスワードを変更しました。";
        }
    }
    catch(PDOException $e){
        print "Connection failed: " . $e->getMessage();
    }

    // close the connection
    $conn = null;
    ?>
    <a href="./"><input type="button" value="戻る"></a>
</body>
</html>