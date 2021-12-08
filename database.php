<?php

require_once "config.php";

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
    if (strlen($Email) == 0 || strlen($Password) == 0) {
        $_SESSION["error"] = "Email and/or Password cannot be empty!";
        header("Location: customer.html");
    }
    $validation = $db->prepare("SELECT Client.Customer_ID, Person .* FROM Person NATURAL JOIN Client Where Email =?");
    if (!$validation) {
        echo "Error getting result: " . mysqli_error($db);
        die();
    }
    $validation->bind_param('s', $Email);
    if ($validation->execute()) {
        if (mysqli_stmt_bind_result($validation, $res_Customer_ID, $res_Email, $res_Password, $res_Fname, $res_MI,
		$res_LName, $res_PhoneNumber, $res_State, $res_City, $res_Zipcode, $res_Street)) {

            $result_count = 0;

            while ($validation->fetch()) {
                $result_count++;
            }

            if ($result_count > 0) {
                $_SESSION["error"] = "Error: Email " . $Email . "already registred";
                header("Location: error.php");
            }
            else {
                echo "Registering!";
                $hash = password_hash($Password, PASSWORD_DEFAULT);
				$statement = $db->prepare("CALL customerRegister(?,?,?,?,?,?,?,?,?,?)");
                $statement->bind_param('ss', $Email, $hash, $res_Fname, $res_MI,
				$res_LName, $res_PhoneNumber, $res_State, $res_City, $res_Zipcode, $res_Street);
                if ($statment->execute()) {
                    echo "Registered!";
                    header("Location: error.php");
                }
                else {
                    echo "Registration failed: " . mysqli_error($db);
                    die();
                }
            }
        }
		else {
			echo "Error executing query from registration: " . mysqli_error($db);
			die();
		}
	}
}

// Customer login
if (isset($_POST['login'])) {
    unset($_POST['login']);
    $db = get_connection();
	$Email = $_POST['email'];
    $Password = $_POST['pw'];
    $validation = $db->prepare("SELECT Client.Email, Person.Password FROM Person NATURAL JOIN Client Where Email =?");
    $validation->bind_param('s', $Email);
    if ($validation->execute()) {
        if (mysqli_stmt_bind_result($validation, $res_Customer_ID, $res_Email, $res_Password, $res_Fname, $res_MI,
		$res_LName, $res_PhoneNumber)) {

            $result_count = 0;

            while ($validation->fetch()) {
                $result_count++;
            }

            if ($result_count == 0) {
                $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                header("Location: error.php");
            }
            else {
                //Verify user with password
                $pass = password_verify($Password, $res_Password);
				if ($pass) {
					$_SESSION['Customer_ID'] = $res_Customer_ID;
					$_SESSION['Email'] = $res_Email;

					header("Location: index.html");
				}
                else {
                    $_SESSION["error"] = "Error: Email and/or password is incorrect!";
                    header("Location: error.php");
                }
            }
        }
		else {
			echo "Error executing query from Customer login: " . mysqli_error($db);
			die();
		}
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
                //$pass = password_verify($Password, $res_Password);
                //if ($pass) {
                if ($Password == $res_Password) {
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
