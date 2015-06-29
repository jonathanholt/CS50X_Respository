<?php

    // configuration
    require("../includes/config.php");
    

    $use = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $use[0]["cash"];
        
    $rows = query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total"  => money_format('$%i', ($row["shares"] * $stock["price"])),
            ];
        }
    }
    
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "cash" => $cash]);

?>
