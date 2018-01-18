
<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group"> Army 1:
        <select id="myList" name="army1" onchange="favBrowser()">
  <option>Chaos Daemons</option>
  <option>Chaos Space Marines</option>
  <option>Dark Eldar</option>
  <option>Eldar</option>
  <option>Grey Knights</option>
  <option>Imperial Guard</option>
  <option>Necrons</option>
  <option>Orks</option>
  <option>Sisters of Battle</option>
  <option>Space Marines</option>
  <option>Tau</option>
  <option>Tyranids</option>
</select></div>
<input autofocus class="form-control" name="chapter1" placeholder="Please enter Space Marine Chapter" type="text" id="chapter1"
onchange="validateChapter()"/>
        </div>
        
<div class="form-group"> Army 2:
        <select id="myList2" name="army2" onchange="favBrowser()">
  <option>Chaos Daemons</option>
  <option>Chaos Space Marines</option>
  <option>Dark Eldar</option>
  <option>Eldar</option>
  <option>Grey Knights</option>
  <option>Imperial Guard</option>
  <option>Necrons</option>
  <option>Orks</option>
  <option>Sisters of Battle</option>
  <option>Space Marines</option>
  <option>Tau</option>
  <option>Tyranids</option>
</select><br>
<input autofocus class="form-control" name="chapter2" placeholder="Please enter Space Marine Chapter" type="text" id="chapter2"
onchange="validateChapter()"/><br>
        <div class="form-group"> Victor:
        <select id="myList3" name="victory" onchange="favBrowser()">
  <option value="Draw">Draw</option>
  <option id="idn"></option>
  <option id="idm"></option>
</select></div>

<div class="form-group"> Points:
        <select id="myList3" name="points">
  <option>250</option>
  <option>500</option>
  <option>600</option>
  <option>700</option>
  <option>750</option>
  <option>800</option>
  <option>850</option>
  <option>900</option>
  <option>950</option>
  <option>1000</option>
  <option>1100</option>
  <option>1200</option>
  <option>1250</option>
  <option>1300</option>
  <option>1400</option>
  <option>1500</option>
  <option>1600</option>
  <option>1700</option>
  <option>1750</option>
</select><br>

        
            <button type="submit" class="btn btn-default" id="submit">Submit</button>
        



    </fieldset>
</form>
