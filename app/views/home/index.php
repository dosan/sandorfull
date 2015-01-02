<h1>PDO Prepared Statement: Named Parameters</h1>
<?php if (!empty($result['error'])) {
    echo "<div class='warning'><p>{$result['error']}</p></div>";
}else{ 
    $row = $result['result']; 
}
?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Search for Cars</legend>
    <p>
        <label for="make">Make: </label>
        <input type="text" name="make" id="make">
        <label for="yearmade">Year (minimum): </label>
        <select name="yearmade" id="yearmade">
            <?php for ($y = 1970; $y <= 2010; $y+=5) {
                echo "<option>$y</option>";
            } ?>
        </select>
        <label for="price">Price (maximum): </label>
        <select name="price" id="price">
            <?php for ($p = 5000; $p <= 30000; $p+=5000) {
                echo "<option value='$p'";
                if ($p == 30000) {
                    echo ' selected';
                }
                echo '>$' . number_format($p) . '</option>';
            } ?>
        </select>
        <input type="submit" name="search" value="Search">
    </p>
    </fieldset>
</form>
<?php if (isset($_GET['search'])) {
    if ($row) {
    ?>
<table>
    <tr>
        <th>Make</th>
        <th>Year</th>
        <th>Mileage</th>
        <th>Price</th>
        <th>Description</th>
    </tr>
    <?php foreach ($row as $key => $row) {?>
    <tr>
        <td><?php echo $row['make']; ?></td>
        <td><?php echo $row['yearmade']; ?></td>
        <td><?php echo number_format($row['mileage']); ?></td>
        <td>$<?php echo number_format($row['price'], 2); ?></td>
        <td><?php echo $row['description']; ?></td>
    </tr>
    <?php } ?>
</table>
<?php } else {
        echo '<p>No results found.</p>';
    } } ?>