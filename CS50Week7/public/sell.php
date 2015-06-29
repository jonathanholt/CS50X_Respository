<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Validate the name
        if (empty($_POST["symbol"]))
        {
            apologize("Please enter the stock symbol.");
        }
        
        $s = lookup($_POST["symbol"]);
        
        if ($s === false)
        {
            apologize("Please select a valid stock ID.");
        }
        
        $query = query("SELECT shares FROM portfolio WHERE id = ? and symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        if ($query === false)
        {
           apologize("Error while selling shares.");
        }
        
        $value = $s["price"] * $query[0]["shares"];
        $transaction = "SELL";
        
        $rows = query("SELECT shares FROM portfolio WHERE id = ? and symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $amount = $rows[0]["shares"];
        
        
        
        query("UPDATE users set cash = cash + ? WHERE id = ?",
            $value, $_SESSION["id"]);
            
        query("INSERT INTO history (id, trans, symbol, shares, price) VALUES(?, ?, ?, ?, ?)",
            $_SESSION["id"], $transaction, $s["symbol"], $amount, $value);    
            
        query("DELETE FROM portfolio where id = ? and symbol = ?", $_SESSION["id"], $_POST["symbol"]); 
        
       
        
        redirect("index.php");
        
    }
    
    else
    {
        // else render form
        render("sell.php", ["title" => "Sell"]);
    }

?>
