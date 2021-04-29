<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>bs4 search Bar - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">

    body{
  margin-top:20px;
  color: #1a202c;
  text-align: left;
  background-color: #f6f5f7;
}
.main-body {
  padding: 15px;
}
.people-nearby .google-maps{
  background: #f8f8f8;
  border-radius: 4px;
  border: 1px solid #f1f2f2;
  padding: 20px;
  margin-bottom: 20px;
}

.people-nearby .google-maps .map{
  height: 300px;
  width: 100%;
  border: none;
}

.people-nearby .nearby-user{
  padding: 20px 0;
  border-top: 1px solid #f1f2f2;
  border-bottom: 1px solid #f1f2f2;
  margin-bottom: 20px;
}

img.profile-photo-lg{
  height: 80px;
  width: 80px;
  border-radius: 50%;
}

.form-control-borderless {
    border: none;
}

.btn-primary {
    border: none;
    background: #B22222;
}

.btn-lg {
    border: none;
    background: #B22222;
}


.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
    </style>
</head>
<body>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <div class="container">
        <div class="main-body">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search for Friend</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->
  </div>
  </div>

<div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" action="" method="post">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" name="search" type="search" placeholder="Search for friends">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" name="search_friends" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
</div>

<?php
include 'db_connect.php';
$dbConnection = OpenCon();
//$uid = 1;
$uid = $_SESSION['UID'];

if(isset($_POST['AddAsFriend']))
{
  $friendUID = $_POST['friendUID'];
  $stmt = $dbConnection->prepare("INSERT INTO userfriend(Friend1UID,Friend2UID) VALUES($uid,$friendUID)");
  $stmt->execute();
  echo("Friend Added");
}

if(isset($_POST['search_friends']))
{
  $user_name = $_POST['search'];
  $stmt = $dbConnection->prepare("SELECT Name, UID FROM user WHERE Name LIKE '%$user_name%' AND UID <> '$uid'"); //looks up all users with that name but not yourself
  $stmt->execute();
  $result = $stmt->get_result();
  $val = $result->fetch_row();
  if(!$val)
  {
    echo("There is no users with that name");
  }else
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result -> fetch_row())
    {
  echo '
  <br>
  <div class="container">
      <div class="row">
          <div class="col-md-8">
              <div class="people-nearby">

                <div class="nearby-user">
                  <div class="row">
                    <div class="col-md-2 col-sm-2">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg">
                    </div>
                    <div class="col-md-7 col-sm-7">
                      <h5>';
                      echo($row[0]);
                      echo '
                      </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                    <form name="add_friend" action="" method="post">
                    <input type="text" class="invisible" name="friendUID" value =';
                     echo($row[1]);
                    echo '>
                    </input>
                      <button type="submit" class="btn btn-primary pull-right" name="AddAsFriend" >Add Friend</button>
                      </form>
                    </div>
                  </div>
                </div>
                </div>
              </div>
      	</div>
  </div>';
  }

}
}

CloseCon($dbConnection);
?>

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
