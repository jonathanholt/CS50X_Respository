<ul class="nav nav-pills">
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="logout.php"><strong>Log Out</strong></a></li>
    <li><a href="password.php"><strong>Change Password</strong></a></li>
</ul>

<div>
    
    <table class="table table-striped">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody>

    
    <?php foreach ($positions as $position): ?>
    <?php $cash = $values["cash"]; ?>
    
        <tr>
            <td><?= $position["symbol"] ?></td>
            <td><?= $position["name"] ?></td>
            <td><?= $position["shares"] ?></td>
            <td><?= $position["price"] ?></td>
            <td><?= $position["total"] ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
        <td colspan="4">Your total cash:</td>
        <td><?= money_format('$%i', $cash) ?></td>
    </tr>
    

    </tbody>
    </table>
</div>
