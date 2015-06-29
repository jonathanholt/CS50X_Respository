<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your old password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your new password.");
        }
        
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
        
        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                query("UPDATE users set hash = ? WHERE id = ?",
                crypt($_POST["confirmation"]), $_SESSION["id"]);
                redirect("/");
            }
        }
    }
        
    else
    {
        // else render quote_form
        render("password.php", ["title" => "Password"]);
    }
?>
