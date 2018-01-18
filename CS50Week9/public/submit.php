<?php

    // configuration
    require("../includes/config.php"); 
    
    
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            apologize("You need to log in to view this page");
        }
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["army1"]) || empty($_POST["army2"]))
        {
            apologize("There was an error processing your army data");
        }
        else if (empty($_POST["victory"]))
        {
            apologize("There was an error processing your result data.");
        }
 
       
        
       
        
        $check = query("INSERT INTO games (id, army1, outcome1, army2,  points, chapter1, chapter2) VALUES(?, ?, ?, ?, ?, ?, ?)", 
        $_SESSION["id"], $_POST["army1"], $_POST["victory"], $_POST["army2"], $_POST["points"], $_POST["chapter1"], $_POST["chapter2"]);
        
        redirect("index.php");
    }
    
    else
    {
        // else render form
        render("submit.php", ["title" => "Submit"]);
    }
    }
?>
