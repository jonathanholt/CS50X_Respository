<div>
<?php    
    $price = $values["price"];
    $name = $values["name"];
    
    if ($price < 1.00)
    {
        $price = number_format($price, 4, '.', ' ');
    }
    else
    {
        $price = number_format($price, 2, '.', ' ');
    }
    
    print("A share of $name costs $price");
?>
</div>
