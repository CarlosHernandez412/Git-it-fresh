<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function get_connection() {
    static $connection;

    if (!isset($connection)) {
        $connection = mysqli_connect('localhost', 'gititfresh', 'hserftitig3420', 'gititfresh')
            or die(sqli_connect_error());
    }
    if ($connection === false) {
        echo "Unable to connect to database<br/>";
        echo mysqli_connect_error();
    }

    return $connection;

}
    if (isset($_POST['Query'])) {

        header('Content-type: application/json');

        $db = get_connection();
        $querytext = $_POST['query_text'];
        $result = mysqli_query($db, $querytext);

        $first_row = true;

        $result = array();

        echo '<table>';
        while ($row = mysqli_fetch_asoc($result)) {
            $results[] = $row;
        }

        echo json_oncode($results);
    }
?>