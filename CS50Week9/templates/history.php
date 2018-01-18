<div>
<br><br>
<p> Your battle report history:</p>
<table class="table table-striped">

    <thead>
        <tr>
            <th>Army 1</th>
            <th>Army 2</th>
            <th>Victor</th>
            <th>Points</th>
            <th>Time</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    
    foreach ($rows as $row){
    $html = "<tr>";    
    $html .= "<td> " . (empty($row["chapter1"]) ? $row["army1"] : $row["chapter1"] ) . " </td>";
    $html .= "<td>" . (empty($row["chapter2"]) ? $row["army2"] : $row["chapter2"] ) . " </td>";
        $html .= "<td>" . $row["outcome1"] . "</td>";
    $html .= "<td>" . $row["points"] . "</td>";
    $html .= "<td>" . $row["time"] . "</td>";
    $html .= "</tr>";
    echo $html;
    }
    
        
        
         ?>
        </tbody>
        </table>
        </div>

