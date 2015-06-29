<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["email"]))
        {
            apologize("You must supply an email address.");
        }
        

        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
           query("UPDATE users set email = ? WHERE id = ?",
            $_POST["email"], $_SESSION["id"]);
            redirect("index.php");
        }
        else
        {
            apologize("You must supply a valid email address.");
        }
    }
        
    else
    {
        // else render quote_form
        render("email.php", ["title" => "Email"]);
    }
?>
