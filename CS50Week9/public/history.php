<?php

    // configuration
    require("../includes/config.php"); 
    
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            apologize("You need to log in to view this page");
        }
   
   
  
    $rows = query("SELECT * FROM games WHERE id = ?", $_SESSION["id"]);
      
        
        
   // render history
   render("history.php", ["title" => "History", "rows" => $rows]);
   
   }
?>
