<?php
session_start(); 
    require 'config.php'; 


$sql = "SELECT id, title FROM news ORDER BY read_cnt DESC LIMIT 5";
$result = $conn->query($sql);

$mostRead = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mostRead[] = $row;
    }
}

for ($i = 0; $i < count($mostRead); $i++) {
    echo '<a href="details.php?id=' . $mostRead[$i]['id'] . '" style="color: inherit; text-decoration: none;"> 
        <div class="one-new">
            <p>' . $mostRead[$i]['title'] . '</p>
            <h2 class="numbers">' . ($i + 1) . '</h2>
        </div> <hr>
    </a>';
}
?>
