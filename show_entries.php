<?php
  $conn = new mysqli("localhost", "root", "", "blood_pressure_diary");
  if($conn->connect_errno) {
    echo "Connection failed: " . $conn->connect_error . "</br>";
  }
  else {
    $username = htmlspecialchars($_POST["username"]) ? htmlspecialchars($_POST["username"]) : htmlspecialchars($_POST["username_to_register"]);
    $password = htmlspecialchars($_POST["password"]) ? htmlspecialchars($_POST["password"]) : htmlspecialchars($_POST["password_to_register"]);

    $sql = "SELECT ID FROM users WHERE Username='" . $username . "' AND Password='" . $password . "'";
    $result = $conn->query($sql);
    if($conn->error) {
      echo "Error: " . $conn->error . "</br>";
    }
    else {
      if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $id = $user["ID"];
      }
    }
    
    $sql = "SELECT Date, Time, Systolic, Diastolic FROM monitor_entries WHERE UserIDf='" . $id . "'";
    $result = $conn->query($sql);
    if($conn->error) {
      echo "Error: " . $conn->error . "</br>";
    }
    else {
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "Date: " . $row["Date"] . " | Time: " . $row["Time"] . " | Blood Pressure: " . $row["Systolic"] . "/" . $row["Diastolic"] . "</br>";
        }
      }
    }


    $conn->close();
  }
?>
