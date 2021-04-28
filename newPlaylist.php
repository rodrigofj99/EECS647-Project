<?php
    include 'db_connect.php';
    $dbConnection = OpenCon();

	if(isset($_POST['create_button']))
	{
		$name = $_POST['name'];
		$friends = $_POST['friends'];
        $date = getdate();
        echo '<script language="javascript">';
        echo 'alert("Hello")';
        echo 'alert("'.($date).'")';
        echo '</script>';
        //$stmt = $dbConnection->prepare("INSERT INTO playlist(Name, Date) VALUES($name, ".($date['year'])."-".($date['mon'])."-".($date['mday']).");");
		//$stmt->execute();
        foreach ($friends as $friend) {
            /*echo '<script language="javascript">';
            echo 'alert("Hello")';
            echo '</script>';
            $stmt = $dbConnection->prepare("INSERT INTO playlist(Name, Date) VALUES($name, ".($date[year])."-".($date[mon])."-".($date[mday]).")");
			$stmt->execute();
			$result = $stmt->get_result();
			$val = $result->fetch_row();
			/*if(!$val)
			{
				echo "Wrong email or password";
			}else
			{
				echo '<script type="text/javascript">
				location.replace("profile.php");
			  </script>';
				exit();
			}*/
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