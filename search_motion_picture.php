<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Playlist Party</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style type="text/css">

.btn:active, .btn-outline-primary:active, .btn-primary:active{
  background-color: rgb(185,19,2);
  border-color: black;
  color:white;
}

.btn:hover , .btn-outline-primary:hover, .btn-primary:hover{
  background-color: rgb(185,19,2);
  border-color: black;
  color:white;
}

.btn, .btn-outline-primary, .btn-primary{
  color: rgb(185,19,2);
  border-color: white;
}

    body{
  margin-top:20px;
  color: #1a202c;
  text-align: left;
  background-color: rgb(20,20,20);
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

.form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
.logo{
	width:500px;
	display: block;
  	margin-left: auto;
  	margin-right: auto;
}
    </style>
</head>
<body>
<div><img class="logo" src="logo-removebg-preview.png" alt=""></div>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <div class="container">
        <div class="main-body">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add to Playlist</li>
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
                                        <input class="form-control form-control-lg form-control-borderless" name="search" type="text" placeholder="Search for movies or tv shows">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-outline-primary btn-lg" name="search_motion_picture" type="submit">Search</button>
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
$pid = $_SESSION['PID'];

if(isset($_POST['AddToPlaylist']))
{
  $movieID = $_POST['mid'];
  $stmt = $dbConnection->prepare("INSERT INTO playlisthasmotionpicture(PID,MID) values('$pid','$movieID')");
  $stmt->execute();
}

if(isset($_POST['search_motion_picture']))
{
  /*$foundMovies = true;
  $foundShows = true;
  $motion_picture_name = $_POST['search'];
  $stmt = $dbConnection->prepare("SELECT Name, Country, Duration, motionpicture.MID FROM motionpicture, motionpicturecountry, movie WHERE Name LIKE '%$motion_picture_name%' AND motionpicture.MID = motionpicturecountry.MID AND motionpicture.MID = movie.MID");
  $stmt->execute();
  $result = $stmt->get_result();
  $val = $result->fetch_row();
  if(!$val)
  {
    $foundMovies = false;
  }else
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result -> fetch_row())
    {*/
      
  $motion_picture_name = $_POST['search'];
  $motion_picture_name = str_ireplace(" ","%20", $motion_picture_name);
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://utelly-tv-shows-and-movies-availability-v1.p.rapidapi.com/lookup?term=$motion_picture_name&country=uk",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "x-rapidapi-host: utelly-tv-shows-and-movies-availability-v1.p.rapidapi.com",
      "x-rapidapi-key: 9aad936645mshe504bd3b5d3bc49p11bf41jsnc6e5a6e31b2f"
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) echo "cURL Error #:" . $err;
  else{ //echo $response;
  $answer = json_decode($response,true);
  for ($i=0; $i < count($answer['results']); $i++) { 
  //echo '<div style="color:white;">';echo $response;echo'</div>';
  echo '
  <hr>
  <div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                <div class="row">';
                if ($answer['results'][$i]['picture'] != "null") {
                  echo '<div class="col-lg-3"><img style="height:100%; width:100%;" class="ml-2 mt-n2" src="'.($answer['results'][$i]['picture']).'"></div>';}
                echo '
                    <div class="table-responsive col-lg-9">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                <th><span>Name</span></th>
                                <th><span>Platform</span></th>
                                <th><span>Info</span></th>
                                <th><span>Rating</span></th>
                                <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>';
                                          //echo($row[0]);
                                          //echo $response;
                                          if(!is_null($answer['results'][$i])) echo $answer['results'][$i]['name'];
                                          else echo 'Not found';
                                          echo '
                                    </td>
                                    <td>';
                                    //echo($row[1]);
                                    for ($j=0; $j < count($answer['results'][$i]['locations']); $j++) { 
                                      if(!is_null($answer['results'][$i]['locations'][$j])){
                                        echo '<a href="'.($answer['results'][$i]['locations'][$j]['url']).'">'
                                        .($answer['results'][$i]['locations'][$j]['display_name']).'</a><br>';}
                                      else echo 'Not found';
                                    }
                                    echo '
                                    </td>
                                    <td>';
                                    if (!is_null($answer['results'][$i]['external_ids']['wiki_data']))
                                      {echo '<a href="'.($answer['results'][$i]['external_ids']['wiki_data']['url']).'"> Wiki </a>';}
                                    else echo 'Wiki';
                                    //echo($row[2]);
                                    echo '
                                    </td>
                                    <td>';
                                    if(!is_null($answer['results'][$i]['external_ids'])) if(!is_null($answer['results'][$i]['external_ids']['imdb'])){
                                    echo '<a href="'.($answer['results'][$i]['external_ids']['imdb']['url']).'"> IMDb </a>';}
                                    else echo 'IMDb';
                                    echo'</td>
                                    <td style="width: 20%;">
                                    <form name="add_mp" action="" method="post">
                                      <input type="text" class="invisible" name="mid" value =';
                                       //echo($row[3]);
                                      echo '>
                                      </input>
                                    <a class="table-link danger">
                                    <button type="submit" name="AddToPlaylist" class="btn btn-outline-primary">
                                            <span class="fa-stack">
                                                Add
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
      </div>
    </div>';
    /*}
    $stmt = $dbConnection->prepare("SELECT Name, Country, Seasons, Episodes, motionpicture.MID FROM motionpicture, motionpicturecountry, shows 
    WHERE Name LIKE '%$motion_picture_name%' AND motionpicture.MID = motionpicturecountry.MID AND motionpicture.MID = shows.MID");
    $stmt->execute();
    $result = $stmt->get_result();
    $val = $result->fetch_row();
    if(!$val)
    {
    $foundShows = false;
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
                                    <form name="add_mp" action="" method="post">
                                      <input type="text" class="invisible" name="mid" value =';
                                      echo($row[4]);
                                      echo '>
                                      </input>
                                    <a class="table-link danger">
                                    <button type="submit" name="AddToPlaylist" class="btn btn-outline-primary">
                                            <span class="fa-stack">
                                                Add
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
  if(!$foundShows && !$foundMovies)
  {
    echo("Sorry, we couldn't find anything related. Try to search for another movie or show");
  }*/
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
<footer class="pt-2 my-2 border-top text-center" style="color:white">
		Copyright &copy; 2021: Rodrigo Figueroa Justiniano, Victoria Maldonado.
		<a href="https://github.com/rodrigofj99/EECS647-Project" class="ml-2">GitHub Repository</a>
</footer>
</body>
</html>
