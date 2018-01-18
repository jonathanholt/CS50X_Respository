<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]) or ($_POST["confirmation"] !== $_POST["password"]))
        {
            apologize("You must confirm your password.");
        }
        
        $check = query("INSERT INTO users (username, hash, fav) VALUES(?, ?, ?)", 
        $_POST["username"], crypt($_POST["password"]), $_POST["fav"]);
        
        if ($check === false)
        {
            apologize("Username already taken.");    
        }
        else
        {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $row["id"];

            // redirect to portfolio
            redirect("/");
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
?>
    
