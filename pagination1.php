
<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;
        require 'config.php';

        $total_pages_sql = "SELECT * FROM cars";
        $result =$pdo->prepare($total_pages_sql);
        $result->execute();
        $total_rows = $result ->rowCount();
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM cars ORDER BY carIndex LIMIT $offset, $no_of_records_per_page";
        $res_data = $pdo->prepare($sql);
        $res_data ->execute();
        echo '<table>';
        echo '<tbody>';
        while($row = $res_data->fetch()){
            echo "<TR>";
            echo "<TD >".$row['carIndex']."</TD>";
            echo "<TD>".$row['make']."</TD>";
            echo "<TD>".$row['model']."</TD>";
            echo "<TD>".$row['Reg']."</TD>";
            echo "<TD>".$row['colour']."</TD>";
            echo "<TD>".$row['miles']."</TD>";
            echo "<TD>".$row['price']."</TD>";
            echo "<TD><img src='images/".$row['picture']."' width=160 height=80></TD>";
            echo "<TD><a  href='viewCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-info'>More</a></TD>";
            echo "<TD><a href='editCarDetails.php?carIndex=".$row['carIndex']."' class='btn btn-success'>Edit</a></TD>";
            echo "<TD><a href='deleteCar.php?carIndex=".$row['carIndex']."' class='btn btn-danger'>Delete</a></TD>";
        echo "</TR>";
        }
        echo '</tbody>';
        echo '</table>';
        
    ?>
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</body>
</html>