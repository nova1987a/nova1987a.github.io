<?php
//Initialize the session
session_start();
// Check if the user is already logged in, if yes => redirect to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: manage.php");
    exit;
}

require "functions/header.php";
require_once("functions/config.php");
$username = $passwd = "";
$username_err = $passwd_err = $login_err = "";



if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check if username-password is empty
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } else {
        $username = trim($_POST["username"]);
    }
    // Check password
    if(empty(trim($_POST["passwd"]))) {
        $passwd_err = "Please enter a valid password";
    } else {
        $passwd = trim($_POST["passwd"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($passwd_err)) {
        // Prepare a SELECT statement
        $sql = "SELECT id, username, passwd FROM users WHERE username = :username";
        if($stmt = $pdo->prepare($sql)) {
            // Bind variables for statement
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            // Set Params.
            $param_username = trim($_POST["username"]);
            if($stmt->execute()) {
                // Check if username exists
                if($stmt->rowCount() == 1) {
                    if($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $username = $row['username'];
                        $hashed_passwd = $row['passwd'];
                        //echo "$passwd $hashed_passwd";
                        if(password_verify($passwd, $hashed_passwd)) {
                            // password correct -> start a new session
                                // If the session is not set...
                             if(!isset($_SESSION)) { 
                                 session_start();
                             }
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //Rediredct the user to manage page
                            header("Location: manage.php");
                        } else {
                            // password invalid -> error msg
                            $login_err = "Invalid username or password";
                        }
                    } 
                } else {
                    // Username non-exists, display Err Msg
                    $login_err = "Invalid username";
                } 
            } else {
                    echo "Ouch! Something went wrong, please try latter...";
            }
            // CLose statement
            unset($stmt);
        }
    }
    //Close connection
    unset($pdo);
}
?>
    <div class="container mt-3">
        <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <?php
            if(!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
        <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3 row">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label">Password</label>
                 <div class="col-sm-10">
                    <input type="password" name="passwd" class="form-control <?php echo (!empty($passwd_err)) ? 'is-invalid' : ''; ?>" >
                    <span class="invalid-feedback"><?php echo $passwd_err; ?></span>
                </div>
            </div>
            <div calss="mb-3">
                <input type="submit" class="btn btn-primary mb-3" value="Login">
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>
    </div>
    </body>
</html>