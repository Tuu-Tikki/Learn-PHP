<?php
session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Blood Pressure Diary</title>

    <style>
      #new_entry {
        width: 600px;
        height: 100px;
        margin: 10px;
        padding: 10px;
        border-style: solid;
      }
    </style>
  </head>

  <body>
    <?php
      if(!array_key_exists("username", $_SESSION)) {
        $_SESSION["username"] = htmlspecialchars($_POST["username"]);
      }
      if(!array_key_exists("password", $_SESSION)) {
        $_SESSION["password"] = htmlspecialchars($_POST["password"]);
      }

      $conn = new mysqli("localhost", "root", "", "blood_pressure_diary");
      if($conn->connect_errno) {
        echo "Connection failed: " . $conn->connect_error;
      }
      else {
        $sql = "SELECT FirstName, LastName FROM users 
                WHERE username='" . $_SESSION["username"] . "' AND password='" . $_SESSION["password"] . "'";
        $result = $conn->query($sql);

        if($conn->error) {
          echo "Error: " . $conn->error . "</br>";
        }
        else {
          if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "<p>Welcome " . $user["FirstName"] . " " . $user["LastName"] . "!</p></br>";
          }
          else {
            echo "Invalid username or password";
          }
        }

        $conn->close();
      }
    ?>
    <?php include "new_entry.php"; ?>
    <?php include "show_entries.php"; ?>
  </body>

</html>
