<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if ($_POST["name"] == "Choose an army")
        {
            apologize("You didn't select an army");
        }
        
        $display = $_POST["name"];
        
        $wins = query("SELECT COUNT( * ) as c 
FROM games
WHERE outcome1 = ?", $display);


$losses = query("SELECT count(*) as d
FROM `games` 
WHERE (outcome1 != 'Draw' AND army1 = ? AND outcome1 != ?)
union all
SELECT count(*)
FROM `games` 
WHERE (outcome1 != ? AND army2 = ? AND outcome1 != 'Chaos Daemons')", $display, $display, $display, $display);

$losses = query("SELECT count(*) as d
FROM `games` 
WHERE (outcome1 != 'Draw' AND army1 = ? AND outcome1 != ?)
union all
SELECT count(*)
FROM `games` 
WHERE (outcome1 != ? AND army2 = ? AND outcome1 != 'Chaos Daemons')", $display, $display, $display, $display);

$draws = query("SELECT count(*) as e
FROM `games` 
WHERE (outcome1 = 'Draw' AND army1 = ?)
union all
SELECT count(*)
FROM `games` 
WHERE (outcome1 = 'Draw' AND army2 = ?)", $display, $display);

$howmanychaps = query("select member, count(*) Total
from 
(
  select chapter1 as member
  from games 
  union all
  select chapter2
  from games
) d
group by member
order by total desc");

        
        
        if ($_POST["name"] == "Space Marines")
        {
            render("marine_form.php", ["title" => "$display", "howmanychaps" => $howmanychaps, "army" => $display, "win" => $wins, "loss" => $losses, "draw" => $draws]);
        }
        else{
        render("army_form.php", ["title" => "$display", "army" => $display, "win" => $wins, "loss" => $losses, "draw" => $draws]);
     }}

        
    else
    {
        // else render form
        render("login_form.php", ["title" => "Log In"]);
    }

?>
