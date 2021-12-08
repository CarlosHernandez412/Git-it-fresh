<?php

require_once ".config.php";

if(!$_SESSION["Employee_ID"])
{
    die();
}

if (isset($_SESSION["error"])) {
    echo $_SESSION["error"] . "<br><br>";
    unset($_SESSION["error"]);
    die();
}

if (isset($_POST["Employee"])) {
    header('Content-type: applicaiton/json');
    $post_id = $_POST['Email'];
    $db = get_connection();
    $result;
    if ($_POST['action'] == 'approve') {
        if ($approval = $db->prepare("UPDATE Employee SET Employee_ID=? WHERE Email=?")) {
            $approval->bind_param('i', $Email);
            if ($approval->execute()) {
                $result = array("data"=>"Employee Registered");
            }
            else {
                $result = array("data"=>mysqli_error($db));
            }
        }
        else {
            $result = array("data"=>mysqli_error($db));
        }
    }
    else if ($_POST['action'] == 'delete') {
        if ($deletion = $db->prepare("DELETE FROM Employee WHERE Email=?")) {
            $deletion->bind_param('i', $Email);
            if ($deletion->execute()) {
                $result = array("data"=>"Employee deleted");
            }
            else {
                $result = array("data"=>mysqli_error($db));
            }
        }
        else {
            $result = array("data"=>mysqli_error($db));
        }
    }

    echo json_encode($result);
}
else {
    header("Location: index.html");
}
?>