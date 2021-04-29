<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>table user list - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

  body{
  margin-top:20px;
  color: #1a202c;
  text-align: left;
  background-color: #B22222;
}
.main-body {
  padding: 15px;
}
.main-box.no-header {
    padding-top: 20px;
}
.main-box {
    background: #FFFFFF;
    -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
    box-shadow: 1px 1px 2px 0 #CCCCCC;
    margin-bottom: 16px;
    -webikt-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.table a.table-link.danger {
    color: #e74c3c;
}
.label {
    border-radius: 3px;
    font-size: 0.875em;
    font-weight: 600;
}
.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}
.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}
a {
    color: #3498db;
    outline: none!important;
}
.user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
}

.table thead tr th {
    text-transform: uppercase;
    font-size: 0.875em;
}
.table thead tr th {
    border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
    font-size: 1.125em;
    font-weight: 300;
    width: 350px;
}
.table tbody tr td {
    font-size: 0.875em;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
    padding: 12px 8px;
}
a:hover{
text-decoration:none;
}
.main-body {
    padding: 15px;
}

input.invisible {visibility:hidden;}
    </style>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">


  <div class="container">
      <div class="main-body">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
      <li class="breadcrumb-item active" aria-current="page">User Playlist</li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->
</div>
</div>

  <?php
  include 'db_connect.php';
  $dbConnection = OpenCon();

  if(isset($_POST['deleteMotionPicture']))
  {
    $movieID = $_POST['mid'];
    //echo($movieID);
    $stmt = $dbConnection->prepare("DELETE FROM playlisthasmotionpicture WHERE MID = $movieID");
    $stmt->execute();
  }


  //TODO change hardcoded value
  $pid = $_POST['q'];

  $stmt = $dbConnection->prepare("SELECT Name, Country, Duration, motionpicture.MID FROM playlisthasmotionpicture, motionpicture, motionpicturecountry, movie WHERE PID = $pid AND playlisthasmotionpicture.MID = motionpicture.MID AND motionpicture.MID = motionpicturecountry.MID AND motionpicture.MID = movie.MID");
  $stmt->execute();
  $result = $stmt->get_result();
  $val = $result->fetch_row();
  if(!$val)
  {
    echo "No movies found in this playlist";
  }else
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result -> fetch_row())
    {
  echo '
<hr>
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                <th><span>Name</span></th>
                                <th><span>Country</span></th>
                                <th><span>Duration</span></th>
                                <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>';
                                          echo($row[0]);
                                          echo '
                                    </td>
                                    <td>';
                                    echo($row[1]);
                                    echo '
                                    </td>
                                    <td>';
                                    echo($row[2]);
                                    echo '
                                    </td>
                                    </td>
                                    <td>
                                    </td>
                                    <td style="width: 20%;">
                                    <form name="delete_mp" action="" method="post">
                                      <input type="text" class="invisible" name="mid" value =';
                                       echo($row[3]);
                                      echo '>
                                      </input>
                                    <a class="table-link danger">
                                    <button type="submit" name="deleteMotionPicture">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                            </span>
                                      </button>
                                      </a>
                                    </form>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}
}
?>
<?php
//$pid = $_POST['playlistID'];
$pid = $_POST['q'];
$stmt = $dbConnection->prepare("SELECT Name, Country, Seasons, Episodes, motionpicture.MID FROM playlisthasmotionpicture, motionpicture, motionpicturecountry, shows WHERE PID = $pid AND playlisthasmotionpicture.MID = motionpicture.MID AND motionpicture.MID = motionpicturecountry.MID AND motionpicture.MID = shows.MID");
$stmt->execute();
$result = $stmt->get_result();
$val = $result->fetch_row();
if(!$val)
{
  echo "No tv shows found in this playlist";
}else
{
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result -> fetch_row())
  {
echo '
<hr>
<div class="container bootstrap snippets bootdey">
  <div class="row">
      <div class="col-lg-12">
          <div class="main-box no-header clearfix">
              <div class="main-box-body clearfix">
                  <div class="table-responsive">
                      <table class="table user-list">
                          <thead>
                              <tr>
                              <th><span>Name</span></th>
                              <th><span>Country</span></th>
                              <th><span>Seasons</span></th>
                              <th><span>Episodes</span></th>
                              <th>&nbsp;</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>';
                                        echo($row[0]);
                                        echo '
                                  </td>
                                  <td>';
                                  echo($row[1]);
                                  echo '
                                  </td>
                                  <td>';
                                  echo($row[2]);
                                  echo '
                                  </td>
                                  <td>';
                                  echo($row[3]);
                                  echo '
                                  </td>
                                  <td style="width: 20%;">
                                  <form name="delete_mp" action="" method="post">
                                    <input type="text" class="invisible" name="mid" value =';
                                     echo($row[4]);
                                    echo '>
                                    </input>
                                  <a class="table-link danger">
                                  <button type="submit" name="deleteMotionPicture">
                                          <span class="fa-stack">
                                              <i class="fa fa-square fa-stack-2x"></i>
                                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                          </span>
                                    </button>
                                    </a>
                                  </form>
                                  </td>
                              </tr>

                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>';
}
}
CloseCon($dbConnection);
?>
<div class="container">
    <div class="main-body">
<button onclick="window.location.href='search_motion_picture.php'">Add a movie or tv show to this playlist</button>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
