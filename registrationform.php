<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}
.error {color: #FF0000;}


/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */


/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>



<?php
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $retypepassErr = "";
$name = $email  = $rePassword = $password = "";
$flag=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
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
  
    
  
      
    $password = test_input($_POST["psw"]);
    if (strlen($password)>5){
      
        global $flag;
        $flag=1;
        $rePassword = test_input($_POST["psw-repeat"]);
   
        if ($password==$rePassword)
        {
            global $flag;
            $flag=1;
    
          }
          else
          {
             
              $retypepassErr = "Password Must Need To Be Matched";
              global $flag;
                $flag=0; 
          }


    }
    else
    {
        $passErr = "Password Contain more than 5 letters";
        global $flag;
          $flag=0; 
       
    }
  

   
  

  


      echo "Data Inserted ".$flag;
    


  
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

        $sql = "INSERT INTO signup(uname, emailid, pass)
        VALUES ('$name', '$email', '$password')";

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





<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <span class="error"><?php echo $nameErr;?></span>
    <input type="text" placeholder="Enter Name" name="name" required>
    

    <label for="email"><b>Email</b></label>
    <span class="error"><?php echo $emailErr;?></span>
    <input type="text" placeholder="Enter Email" name="email" required>
   


    <label for="psw"><b>Password</b></label>
    <span class="error"><?php echo $passErr;?></span>
    <input type="password" placeholder="Enter Password" name="psw" required>


    <label for="psw-repeat"><b>Repeat Password</b></label>
    <span class="error"><?php echo $retypepassErr;?></span>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>
