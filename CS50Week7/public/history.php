<?php

    // configuration
    require("../includes/config.php"); 
   
   
  
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
      
        
        
   // render history
   render("history.php", ["title" => "History", "rows" => $rows]);
?>
