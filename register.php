<?php
session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Blood Pressure Diary</title>
  </head>

  <body>
    <?php
      if(!array_key_exists("username_to_register", $_SESSION)) {
        $_SESSION["username_to_register"] = htmlspecialchars($_POST["username_to_register"]);
      }
      if(!array_key_exists("password_to_register", $_SESSION)) {
        $_SESSION["password_to_register"] = htmlspecialchars($_POST["password_to_register"]);
      }
      if(!array_key_exists("firstname", $_SESSION)) {
        $_SESSION["firstname"] = htmlspecialchars($_POST["firstname"]);
      }
      if(!array_key_exists("lastname", $_SESSION)) {
        $_SESSION["lastname"] = htmlspecialchars($_POST["lastname"]);
      }

      $conn = new mysqli("localhost", "root", "", "blood_pressure_diary");
      if($conn->connect_errno) {
        echo "Connection failed: " . $conn->connect_error;
      }
      else {
        $sql = "INSERT INTO users (FirstName, LastName, Username, Password) VALUES("
          . "'" . $_SESSION["firstname"] . "', "
          . "'" . $_SESSION["lastname"] . "', "
          . "'" . $_SESSION["username_to_register"] . "', "
          . "'" . $_SESSION["password_to_register"] . "')";

        $conn->query($sql);
        
        if($conn->error) {
          echo "Error: " . $conn->error;
        }
        else {
          echo "<p>Welcome " . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "!</p>";
          echo "<p>You are successfully registered!</p>";
        }

        $conn->close();
      }
    ?>
  </body>

</html>
