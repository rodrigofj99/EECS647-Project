<?php
    include 'db_connect.php';
    $dbConnection = OpenCon();

	if(isset($_POST['create_button']))
	{
		$name = $_POST['name'];
		$friends = $_POST['friends'];
        $user = $_POST['uid'];
        $date = getdate(date("U"));
        $stmt = $dbConnection->prepare("INSERT INTO playlist(Name, Date) VALUES('$name', '$date[year]-$date[mon]-$date[mday]');");
		$stmt->execute();

        $stmt = $dbConnection->prepare("SELECT PID FROM playlist WHERE Name='$name'");
		$stmt->execute();
        $result = $stmt->get_result();
        $val = $result->fetch_row();
        $stmt = $dbConnection->prepare("INSERT INTO userhasplaylist(UID, PID) VALUES($user, $val[0]);");
        $stmt->execute();

        foreach ($friends as $friend) {
            $stmt = $dbConnection->prepare("SELECT UID FROM user WHERE Name='$friend'");
            $stmt->execute();
            $result = $stmt->get_result();
            $x = $result->fetch_row();

            $stmt = $dbConnection->prepare("INSERT INTO userhasplaylist(UID, PID) VALUES($x[0], $val[0]);");
            $stmt->execute();
        }
        echo '<script type="text/javascript">
					location.replace("profile.php");
				  </script>';
	}
        
    $stmt = $dbConnection->prepare("SELECT Name FROM user where UID in 
    (SELECT Friend2UID FROM userfriend WHERE Friend1UID=?)");
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $result = $stmt->get_result();
    echo '<label type="text">Select a friend</label>';
    while($val = $result->fetch_row())
    {
        echo '<option value="'.($val[0]).'">'.($val[0]).'</option>';
    }
    CloseCon($dbConnection);
?>