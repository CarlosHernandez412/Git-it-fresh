<?php

require_once ".config.php";

// Get all products and their categories
if(isset($_POST['GetProducts'])) {
	$db = get_connection();
	$query = $db->prepare("SELECT * FROM Product NATURAL JOIN ProductCategory");
	$query->execute();
	$products = $query->get_result();

	$results = [];

	while($row = $products->fetch_assoc()) {
		$results [] = $row;
	}

	echo json_encode($results);

}

// User registeration with validation
if (isset($_POST['StartRegister'])) {
    unset($_POST['StartRegister']);
    $db = get_connection();
    $Fname = $_POST['first'];
    $MI = $_POST['mid'];
    $LName = $_POST['last'];
    $PhoneNumber = $_POST['number'];
    $Street = $_POST['address'];
    $Zipcode = $_POST['zip'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    if (strlen($Fname) == 0 || strlen($LName) == 0 || strlen($PhoneNumber) == 0 || strlen($Street) == 0 ||
    strlen($Zipcode) == 0 || strlen($City) == 0 || strlen($State) == 0 || strlen($Email) == 0 || strlen($Password) == 0) {
        $_SESSION["error"] = "Please fill out all (*) required fields!";
        header("Location: customer.html");
    }
    $validation = $db->prepare("SELECT Email FROM Client Where Email =?");
    if (!$validation) {
        echo "Error getting result: " . mysqli_error($db);
        die();
    }
    $validation->bind_param('s', $Email);
    if ($validation->execute()) {
        if (mysqli_stmt_bind_result($validation, $res_Email)) {
            $result_count = 0;
            while ($validation->fetch()) {
                $result_count++;
            }
            if($result_count > 0) {
                $_SESSION["error"] = "Error: Email " . $Email . " already registered";
                header("Location: error.php");
            } else {
                echo "Registering!";
                $hash = password_hash($Password, PASSWORD_DEFAULT);
                $statement = $db->prepare("CALL customerRegister(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $statement->bind_param('ssssssssis', $Email, $hash, $Fname, $MI, $LName,
                    $PhoneNumber, $State, $City, $Zipcode, $Street);
                if ($statement->execute()) {
                    echo "Registered!";
                    header("Location: customer.html");
                } else {
                    echo "Registration failed: " . mysqli_error($db);
                    die();
                }
            }
        } else {
            echo "Error getting results: " . mysqli_error($db);
            die();
        }
    } else {
        echo "Error executing query: " . mysqli_error($db);
        die();
    } 
}

// Customer login
if (isset($_POST['customerlogin'])) {
    unset($_POST['customerlogin']);
    $db = get_connection();
    $Email = $_POST['log_email'];
    $Password = $_POST['log_password'];
    $validation = $db->prepare("SELECT Client.Customer_ID, Client.Email, Person.Password, Person.Fname FROM Person NATURAL JOIN Client Where Email =?");
    $validation->bind_param('s', $Email);
    if ($validation->execute()) {
        if (mysqli_stmt_bind_result($validation, $res_Customer_ID, $res_Email, $res_Password, $res_Fname)) {
            
            $result_count = 0;

            while ($validation->fetch()) {
                $result_count++;
            }

            if ($result_count == 0) {
                $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                header("Location: error.php");
            } else {
                //Verify user with password
                //Uncomment following two lines to verify hashed passwords
                $pass = password_verify($Password, $res_Password);
                if ($pass) {
                /*if ($Password == $res_Password) {*/
                    $_SESSION['Customer_ID'] = $res_Customer_ID;
                    $_SESSION['Fname'] = $res_Fname;
                    $_SESSION['Email'] = $res_Email;
                
                    header("Location: index.html");
                } else {
                    $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                    header("Location: error.php");
                }
            }
        } else {
            echo "Error getting results: " . mysqli_error($db);
            die();
        }
    } else {
        echo "Error executing query: " . mysqli_error($db);
        die();
    }
}

// Employee login
if (isset($_POST['emp_login'])) {
    unset($_POST['emp_login']);
    $db = get_connection();
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $validation = $db->prepare("SELECT Employee.Employee_ID, Employee.Email, Person.Password, Person.Fname FROM Person NATURAL JOIN Employee Where Email =?");
    $validation->bind_param('s', $Email);
    if ($validation->execute()) {
        if (mysqli_stmt_bind_result($validation, $res_Employee_ID, $res_Email, $res_Password, $res_Fname)) {
            
            $result_count = 0;

            while ($validation->fetch()) {
                $result_count++;
            }

            if ($result_count == 0) {
                $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                header("Location: error.php");
            } else {
                //Verify user with password
                //Uncomment following two lines to verify hashed passwords
                $pass = password_verify($Password, $res_Password);
                if ($pass) {
                //if ($Password == $res_Password) {
                    $_SESSION['Employee_ID'] = $res_Employee_ID;
                    $_SESSION['Fname'] = $res_Fname;
                    $_SESSION['Email'] = $res_Email;
                
                    header("Location: index.html");
                } else {
                    $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                    header("Location: error.php");
                }
            }
        } else {
            echo "Error getting results: " . mysqli_error($db);
            die();
        }
    } else {
        echo "Error executing query: " . mysqli_error($db);
        die();
    }
}

?>
