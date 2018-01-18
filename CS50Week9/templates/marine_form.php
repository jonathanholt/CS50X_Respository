<div id="wrapper">


<div id="intro">
<?php 
    $price = $values["army"];
    $html = "<h1 id='ablurb'> You are now viewing information about <br> $price </h1>"; 
    echo $html; 
    ?>  
    <img id="armypic" src="http://www.gravatar.com/avatar/fb93f95ae98819753c2a778397c9313a?d=http%3A%2F%2Fcdn.dreamincode.net%2Fforums%2Fpublic%2Fstyle_avatars%2Fblank_avatar.gif&s=64"/>
    </div>
    <div id="morecontent">
    <?php
    $wins = $values["win"];
    $losses = $values["loss"];
    $draws = $values["draw"];
    
    
    foreach ($wins as $row){
    $yo =$row["c"];
    $html = "<br> This army has won $yo times. <br>";
    }  
    echo $html;
    
    $tote = 0;
    foreach ($losses as $row){
    $hey =$row["d"];  
    $tote = $tote + $hey;
    $html2 = "This army has lost $tote times. <br>";
    }  
    echo $html2; 
    
    $total = 0;
    foreach ($draws as $row){
    $hi =$row["e"];  
    $total = $total + $hi;
    $html3 = "This army has drawn $total times.";
    }  
    echo $html3; 
    
    
    
    
    
        ?>
        <table class="table table-striped" id = "table1">
        <thead>
        <tr>
            <th class="army">Chapter</th>
            <th>Times Played</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    $chap = $values["howmanychaps"];
    foreach ($chap as $row)
    {
    if(!empty($row["member"])){
    $html4 = "<tr>";    
    $html4 .= "<td> " . $row["member"] . " </td>";
    $html4 .= "<td>" . $row["Total"] . "</td>";
    $html4 .= "</tr>";
    echo $html4;
    }   }
     ?> </tbody>
        
        </table>
        
        </div>
        </div>

