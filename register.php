
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";
$flag=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    global $flag;
    $flag=0;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
      global $flag;
        $flag=0;
    }
    else
    {
        global $flag;
        $flag=1;
    }
    
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    global $flag;
    $flag=0;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
      global $flag;
        $flag=0;
    }
    else
    {
        global $flag;
        $flag=1;
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
      
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
      global $flag;
        $flag=0; 
    }
    else
    {
        global $flag;
        $flag=1;
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
   

  } else {
    $comment = test_input($_POST["comment"]);
   
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    global $flag;
    $flag=0;
  
  } else {
    
    $gender = test_input($_POST["gender"]);
    global $flag;
    $flag=1;
  }



  
  if($flag==1)
  {


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "INSERT INTO register(uname, email, website,comment,gender)
        VALUES ('$name', '$email', '$website','$comment','$gender')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
/*echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;*/
?>

<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO register(uname, email, website,comment,gender)
VALUES ('$name', '$email', '$website','$comment','$gender')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();*/
?>


<?php
/*function NewUser() 
{
     $fullname = $_POST['name']; 
     $userName = $_POST['user'];
      $email = $_POST['email'];
       $password = $_POST['pass'];
        $query = "INSERT INTO websiteusers (fullname,userName,email,pass) VALUES ('$fullname','$userName','$email','$password')";
         $data = mysql_query ($query)or die(mysql_error()); 
         if($data) 
         { 
             echo "YOUR REGISTRATION IS COMPLETED..."; 
          } 
} 
function SignUp() 
{
     if(!empty($_POST['user'])) 
     //checking the 'user' name which is from Sign-Up.html, is it empty or have some text 
     {
          $query = mysql_query("SELECT * FROM websiteusers WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error()); 
          if(!$row = mysql_fetch_array($query) or die(mysql_error())) 
          { 
              newuser(); 
            } 
            else 
            {
                 echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
            
             }
        } 
        if(isset($_POST['submit'])) 
        { 
            SignUp(); 
        }

}*/
?>


</body>
</html>





