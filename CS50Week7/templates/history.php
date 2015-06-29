<div>
<table class="table table-striped">

    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            </tr>
    </thead>
    
    <tbody>
    <?php foreach ($rows as $row): ?>
    <tr>
            <td><?= $row["trans"] ?></td>
            <td><?= $row["time"] ?></td>
            <td><?= $row["symbol"] ?></td>
            <td><?= $row["shares"] ?></td>
            <td><?= money_format('$%i',$row["price"]); ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
        </table>
        </div>

