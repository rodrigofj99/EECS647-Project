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
    CloseCon($dbConnection);
?>