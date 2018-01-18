<form action="batrep.php" method="post">
    <fieldset>
       <div class="form-group"> Army 1:
        <select id="myList" name="army1" onchange="favBrowser()">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select></div>
<div class="form-group"> Army 2:
        <select id="myList2" name="army2" onchange="favBrowser()">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select></div>
<div class="form-group" name="victory"><select>
<option>Draw</option>
<option id="idn"></option>
<option id="idm"></option>
</select></div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="register.php">register</a> for an account
</div>
