<!DOCTYPE html>
<html>

  <head>
    <title>Blood Pressure Diary</title>
  </head>

  <body>
    Welcome <?php echo htmlspecialchars($_POST["firstname"]) . " " . htmlspecialchars($_POST["lastname"]);?>!</br>

    <?php
      $conn = new mysqli("localhost", "root", "", "blood_pressure_diary");
      if($conn->connect_errno) {
        echo "Connection failed: " . $conn->connect_error;
        exit();
      }

      $sql = "INSERT INTO users (FirstName, LastName, Username, Password) VALUES("
        . "'" . htmlspecialchars($_POST["firstname"]) . "', "
        . "'" . htmlspecialchars($_POST["lastname"]) . "', "
        . "'" . htmlspecialchars($_POST["username_to_register"]) . "', "
        . "'" . htmlspecialchars($_POST["password_to_register"]). "')";

      $conn->query($sql);
      if($conn->error) {
        echo "Error: " . $conn->error;
      }
      else {
        echo "You are successfully registered! </br>";
      }

      $conn->close();
    ?>
  </body>

</html>
