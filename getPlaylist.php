<?php
    include 'db_connect.php';
    $dbConnection = OpenCon();
    $stmt = $dbConnection->prepare("SELECT Name, Date FROM playlist where PID in 
    (SELECT PID FROM userhasplaylist WHERE UID=?)");
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($val = $result->fetch_row())
    {
        echo "<tr>";
        echo "<td><a>".($val[0])."</a></td>";
        echo "<td>".($val[1])."</td>";
        echo "<td class=text-center><span class=label label-default>New</span></td>";
        echo "</tr>";
    }
?>