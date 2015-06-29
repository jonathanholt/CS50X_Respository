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
        
        // Validate the name
        if (empty($_POST["amount"]) || !is_numeric($_POST["amount"]))
        {
            apologize("Please enter valid amount.");
        }
        
        $s = lookup($_POST["symbol"]);
        
        if ($s === false)
        {
            apologize("Please select a valid stock ID.");
        }
        
        $rows = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $rows[0]["cash"];
        
        $cost = $s["price"] * $_POST["amount"];
        $transaction = "BUY";
        
        if($cost <= $cash)
        {
            query("UPDATE users set cash = cash - ? WHERE id = ?",
            $cost, $_SESSION["id"]);
            
            query("INSERT INTO history (id, trans, symbol, shares, price) VALUES(?, ?, ?, ?, ?)",
            $_SESSION["id"], $transaction, $s["symbol"], $_POST["amount"], $cost);
            
            query("INSERT INTO portfolio (id, symbol, shares) VALUES(?, ?, ?) 
            ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)",
            $_SESSION["id"], $s["symbol"], $_POST["amount"]);
            
            redirect("index.php"); 
        }        
        else
        {
            apologize("You don't have sufficient funds for that transaction");
        }
    }
    
    else
    {
        // else render form
        render("buy.php", ["title" => "Buy"]);
    }

?>
