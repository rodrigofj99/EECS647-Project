<?php
    include 'db_connect.php';
    $dbConnection = OpenCon();
    /*echo '<script type="text/javascript">';
    echo 'alert("puto1")';
    echo 'document.getElementById("playlistForm").remove();';
    //echo 'location.replace("profile.php");';
    echo '</script>';*/
    //if(isset($_POST['playlist_button'])){
    $stmt = $dbConnection->prepare("SELECT Name, Date, PID FROM playlist where PID in 
    (SELECT PID FROM userhasplaylist WHERE UID=?)");
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($val = $result->fetch_row())
    {
        echo '<tr>';
        echo '<td><a class="btn btn-outline-primary" name="playlist_button" id="'.($val[2]).'">'.($val[0]).'</a></td>';
        echo '<td>'.($val[1]).'</td>';
        echo '<td class=text-center><span class=label label-default>New</span></td>';
        echo '</tr>';
    }
    echo '<script type="text/javascript">';
    echo 'alert("puto")';
    //echo 'document.getElementById("playlistForm").remove();';
    echo 'location.replace("profile.php");';
    echo '</script>';
/*let playlist_button = document.getElementsByName("playlist_button");
alert(playlist_button.length);
for (let i = 0; i < playlist_button.length; i++) {
  playlist_button[i].addEventListener("click", function() {
    
    location.replace("inside_playlist.php?q="+this[i].id);
  });
}*/

    CloseCon($dbConnection);
?>