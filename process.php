<!-- Form database receive -->
<?php
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

include('dbConnect.php');

$sql = "select * from admin where username=:username";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":username",$username);
$stmt->execute();

if($stmt->rowCount()>0){
    $row = $stmt->fetch();
    if($row['password']==$password){
        $_SESSION['id']=$row['id'];
        $_SESSION['admin_id']=$username;
        $_SESSION['name']=$row['name'];
        header("location:admin-dashboard.php");
    }else{
        $_SESSION['error']="Wrong Password";
        header("location:admin-login.php");
    }
}else{
    $_SESSION['error']="Wrong User ID";
    header("location:admin-login.php");
}

?>