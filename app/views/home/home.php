
<h1>PDO Transactions</h1>
<?php
if (isset($result['error'])) {
    echo "<div class='warning'><p>{$result['error']}</p></div>";
}
?>
<table>
    <tr>
        <th>Name</th>
        <th>Balance</th>
    </tr>
    <?php foreach ($result['balance'] as $row) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td>$<?php echo number_format($row['balance'], 2); ?></td>
    </tr>
    <?php } ?>
</table>