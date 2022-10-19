<?php
  $email = $_POST['email'];
  $password = $_POST['password'];

  $con = new mysqli('localhost:3308', 'root', '', 'loginsite'); 
  
  if($con->connect_error){
    die("Failed connection: ".$con->connect_error);
  }else {
    $stmt = $con->prepare("select * from login where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0){
      $data = $stmt_result->fetch_assoc();
      if($data['password'] === $password){
        header('location: dashboard.html');
      }else{
        echo "Incorrect details";
      }
    }else{
      echo "<h2?>Invalid email or password</h2>";
    }
  }

?>