<?php

    // configuration
    require("../includes/config.php"); 
   
   
  
    $rows = query("SELECT * FROM games ORDER BY time DESC LIMIT 10;");
      
        
        
   // render history
   render("games.php", ["title" => "Games", "rows" => $rows]);
?>
