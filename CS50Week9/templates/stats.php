<div id="tableholder">
<table class="table table-striped" id = "table1">
    <thead>
        <tr>
            <th class="army">Army</th>
            <th>Times Played</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    
    foreach ($howmany as $row){
    $html = "<tr>";    
    $html .= "<td> " . $row["member"] . " </td>";
    $html .= "<td>" . $row["Total"] . "</td>";
    $html .= "</tr>";
    echo $html;
    }   
     ?>
        </tbody>
        </table> 
        
        <table class="table table-striped" id = "table3">
    <thead>
        <tr>
            <th class="army">Army</th>
            <th>Losses</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    
    
    foreach ($losses as $row){
        
        $html = "<tr>";    
        $html .= "<td> " . $row["member"] . " </td>";
        $html .= "<td>" . $row["Total"] . "</td>";
        $html .= "</tr>";
        echo $html;
    }   
     ?>
        </tbody>
        
        </table> 
    <table class="table table-striped" id = "table2">
    <thead>
        <tr>
            <th class="army">Army</th>
            <th>Wins</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    
    foreach ($wins as $row){
    $html = "<tr>";    
    $html .= "<td> " . $row["outcome1"] . " </td>";
    $html .= "<td>" . $row["c"] . "</td>";
    $html .= "</tr>";
    echo $html;
    }   
     ?>
        </tbody>
        
        </table>
        
        
        
<table class="table table-striped" id = "table4">
    <thead>
        <tr>
            <th class="army">Army</th>
            <th>Draws</th>
            </tr>
    </thead>
    
    <tbody>
    <?php 
    
    foreach ($draws as $row){
        if(!empty($row["member"])){
        
        $html = "<tr>";    
        $html .= "<td> " . $row["member"] . " </td>";
        $html .= "<td>" . $row["Total"] . "</td>";
        $html .= "</tr>";
        echo $html;
    }}
     ?>
        </tbody>
        </table></div>
         
        <div id="under">
        <form action="army.php" method="post">    
        <p>See detailed report on:</p>
        <select id="selectNumber" name="name">
    <option>Choose an army</option>
</select>

        <button type="submit" class="btn btn-default" id="submit">Submit</button>
        
        </form>
        </div>

