<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  align: center;
  padding: 0;
  border: 1px solid #888;
  width: 20%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}



    </style>



</head>
<body>
  <?php
  $userID = $_SESSION['UID'];
  echo '<p id="UserID">';
    echo($userID);
  echo '
  </p>';
   ?>
<script>
  document.addEventListener("DOMContentLoaded",()=>{

    let uid = document.getElementById("UserID").innerHTML;

    document.getElementById("myBtn").addEventListener("click", function() {
      document.getElementById("myModal").style.display = "block";
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("friendsList").innerHTML += this.responseText;
      }};
      xhttp.open("GET", "newPlaylist.php?q="+uid, true);
      xhttp.send();
    });

    document.getElementsByClassName("close")[0].addEventListener("click", function() {
      document.getElementById("myModal").style.display = "none";
    });

    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        document.getElementById("myModal").style.display = "none";
      }
    });

    //Load Playlists
    let playlist_xhttp = new XMLHttpRequest();
    playlist_xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("playlists").innerHTML += this.responseText;
      }};
      playlist_xhttp.open("GET", "getPlaylist.php?q="+uid, true);
      playlist_xhttp.send();

    //Load friends
    let friends_xhttp = new XMLHttpRequest();
    friends_xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("friends").innerHTML += this.responseText;
      }};
      friends_xhttp.open("GET", "getFriends.php?q="+uid, true);
      friends_xhttp.send();

  });
</script>



<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>
                        <?php
                          include 'db_connect.php';
                          $dbConnection = OpenCon();
                          $stmt = $dbConnection->prepare("SELECT Name FROM user WHERE UID= $userID");
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $val = $result->fetch_row();
                          echo $val[0];
                        ?>
                      </h4>
                      <button class="btn btn-primary" style="display:none">Follow</button>
                      <button class="btn btn-outline-primary" id="myBtn">Create Playlist</button>


                        <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="close">&times;</span>
  </div>
  <div class="modal-body">
  <h3 class="text-center">New Playlist</h3>
    <div class="col" style="padding-left:30%; padding-right:25%">
      <form action="newPlaylist.php" name="newPlaylist" method="post">

        <div class="row pb-2">
          <input type="text" placeholder="Name" name="name" require/>
        </div>
        <div>
          <label>Select friend(s)</label>
          <select name="friends[]" id="friendsList" multiple="multiple"></select>
        </div>
        <div class="row pt-3">
          <button type="submit" name="create_button">Create</button>
        </div>
        <input type="text" class="invisible" name="uid" value="1"></input>
      </form>
    </div>
  </div>
  <div class="modal-footer" id="x"></div>
</div>

</div>



                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <?php
                          $dbConnection = OpenCon();
                          $stmt = $dbConnection->prepare("SELECT Name FROM user WHERE UID= $userID");
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $val = $result->fetch_row();
                          echo $val[0];
                        ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                          $dbConnection = OpenCon();
                          $stmt = $dbConnection->prepare("SELECT Email FROM user WHERE UID= $userID");
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $val = $result->fetch_row();
                          echo $val[0];
                        ?>
                    </div>
                  </div>
                  <hr>
                  <div style="text-align: center">
                    <h4>Friends</h4>
                    <div id="friends"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 mb-3" style="text-align: center">
              <div class="card">
                <h4 class="pt-3">Playlists</h4>
                <div class="card-body">









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
                                <th><span>Created</span></th>
                                <th><span>Status</span></th>
                              </tr>
                            </thead>
                            <tbody id="playlists"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

















                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
