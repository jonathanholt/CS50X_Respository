<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a valid stock ID.");
        }
        
     // retrieve stock from symbol and ensure it's valid
        $s = lookup($_POST["symbol"]);
        
        if ($_POST === false)
        {
            apologize("Invalid stock symbol");
        }
        // else render quote_price
        render("quote_display.php", ["title" => "Quote", "price" => $s["price"], "name" => $s["name"]]);

    }
    else
    {
        // else render quote_form
        render("quote_form.php", ["title" => "Quote"]);
    }
?>
