<!DOCTYPE html>
<html>

  <head>
    <title>Blood Pressure Diary</title>
  </head>

  <body>
    <?php
    $conn = new mysqli("localhost", "root", "", "blood_pressure_diary");
    if($conn->connect_errno) {
      echo "Connection failed: " . $conn->connect_error;
      exit();
    }

    $sql = "SELECT FirstName, LastName FROM users WHERE username='" . htmlspecialchars($_POST["username"])
           . "' AND password='" . htmlspecialchars($_POST["password"]) . "'";
    $result = $conn->query($sql);
    if($conn->error) {
      echo "Error: " . $conn->error;
      exit();
    }

    if($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      echo "Welcome " . $user["FirstName"] . " " . $user["LastName"] . "!</br>";
    }
    else {
      echo "Invalid username or password";
      exit();
    }
    ?>
  </body>

</html>