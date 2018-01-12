<?php
include 'connect.php';
    //print_r($_POST);

    $criterium = filter_var ( $_POST['criterium'], FILTER_SANITIZE_NUMBER_INT);
    $normering = filter_var ( $_POST['normering'], FILTER_SANITIZE_NUMBER_INT);
    $student = filter_var ( $_POST['student'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT beoordeling_id FROM beoordeling WHERE student_id = '" . $student . "' AND werkproces_criterium_id='" . $criterium . "'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // hij bestaat al. updaten:
        // criterium_normering_id
        $sql_update = "UPDATE beoordeling SET criterium_normering_id = '$normering' WHERE student_id='$student' AND werkproces_criterium_id = '$criterium'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Bestaat nog niet!";
        $sql_insert = "INSERT INTO beoordeling (student_id, werkproces_criterium_id, criterium_normering_id) VALUES ('$student','$criterium','$normering')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }