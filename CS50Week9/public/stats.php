<?php

    // configuration
    require("../includes/config.php"); 
    
    
    $howmany = query("select member, count(*) Total
from 
(
  select army1 as member
  from games 
  union all
  select army2
  from games
) d
group by member
order by total desc");

$wins = query("select outcome1, count(*) as c FROM games WHERE outcome1 != 'draw' GROUP BY outcome1 order by c desc");
$draws = query("select member, count(*) Total
from 
(
  select army1 as member
  from games WHERE outcome1 = 'draw'
  union all
  select army2
  from games WHERE outcome1 = 'draw'
) d
group by member
order by total desc");

$losses = query("select member, count(*) Total
from 
(
  select army1 as member
  from games WHERE outcome1 != 'draw' AND outcome1 != army1
  union all
  select army2
  from games WHERE outcome1 != 'draw' AND outcome1 != army2
) d
group by member
order by total desc");


     
        
   // render history
   render("stats.php", ["title" => "Statistics", "howmany" => $howmany, "losses" => $losses, "draws" => $draws, "wins" => $wins]);
   
   
?>
