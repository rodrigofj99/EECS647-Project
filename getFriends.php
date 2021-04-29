<?php
    include 'db_connect.php';
    $dbConnection = OpenCon();
    $stmt = $dbConnection->prepare("SELECT Name FROM user where UID in 
    (SELECT Friend2UID FROM userfriend WHERE Friend1UID=?)");
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($val = $result->fetch_row())
    {
        echo '<div style="text-align: center" class="pb-2">';
        echo '<a class="btn btn-outline-primary">'.($val[0]).'</a>';
        echo '</div>';
    }
?>