<?php
foreach ($this->pagination as $value) {
    echo '<a href=' . ROOT . 'mod/mod_points/transactions/' . $value . '/' . $this->count . '>' . $value . ', </a>';
}

echo '<br>Sort by type: ' . "<br>";
foreach ($this->transactionTypes as $value) {
    echo '<a href=' . ROOT . 'mod/mod_points/transactions/' . $this->page . '/' . $this->count . '/' . $value['type_id'] . '>' . $value['name'] . '</a>| |';
}
?>

<table border=1>
    <th>id</th>
    <th>type</th>
    <th>subject</th>
    <th>object</th>
    <th>points</th>
    <th>time</th>
    <?php
    for ($c = 0; $c < sizeof($this->transactions); $c++) {
        echo '<tr>';
        echo '<td>' . $this->transactions[$c]['transaction_id'] . '</td>';
        echo '<td>' . $this->transactions[$c]['transaction_type'] . '</td>';
        echo '<td>' . '<a href=' . ROOT . 'mod/mod_points/transactions/' . $this->page . '/' . $this->count . '/all/year/' . $this->transactions[$c]['subject'] . '>' . $this->transactions[$c]['subject'] . '</a></td>';
        echo '<td>' . '<a href=' . ROOT . 'mod/mod_points/transactions/' . $this->page . '/' . $this->count . '/all/year/' . $this->transactions[$c]['object'] . '>' . $this->transactions[$c]['object'] . '</a></td>';
        echo '<td>' . $this->transactions[$c]['points'] . '</td>';
        echo '<td>' . date('M d Y G:i', $this->transactions[$c]['time']) . '</td>';
        echo '</tr>';
    }
    ?>
</table>