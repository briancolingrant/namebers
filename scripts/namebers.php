<?php

  require_once('nameber.php');

    $response = array(
      "message" => "There was a problem with your submission, please try again.",
      "data" => array(
        "name" => NULL
      )
    );

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);

        // Check that data was sent.
        if ( empty($name) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            $response["message"] = "Oops! The name was empty.";
            exit;
        }

        $nameber = new Nameber($name);
        $response = json_encode($nameber);
        print_r($response);

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        print_r($response);
    }
