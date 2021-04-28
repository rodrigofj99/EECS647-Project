<?php
    include 'db_connect.php';
    //echo "<h3>Puto</h3>";
    $dbConnection = OpenCon();
    //$query = "SELECT Friend2UID FROM user WHERE Friend1UID=?";
    $stmt = $dbConnection->prepare("SELECT Name FROM user where UID in 
    (SELECT Friend2UID FROM userfriend WHERE Friend1UID=?)");
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<label type='text'>Select a friend</label>";
    while($val = $result->fetch_row())
    {
        echo "<option value=".($val[0]).">".($val[0])."</option>";
    }
    
?>