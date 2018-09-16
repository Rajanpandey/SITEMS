<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
require('../connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$url=$_GET["url"]; 

//Query to select the user
$sqlUserId="SELECT * FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];
$userName = $rowUserId['name'];

//Query to select the user
$sqlUserId="SELECT type FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userType = $rowUserId['type'];

$sql="SELECT * FROM events WHERE url='$url'";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}

$resourcePersonArray=explode(',', $array[0]['resourceName']);
$resourceDesignationArray=explode(',', $array[0]['resourceDesignation']);
$noOfResource=count($resourcePersonArray);

$arrayOfMediaLoc=explode(",", $array[0]['media']);
$sizeOfArray=count($arrayOfMediaLoc);

//Query to select number of new messages
$sql="SELECT * FROM events WHERE userId='$userId' AND declineReply IS NOT NULL AND viewedNotification IS NULL";
$result=mysqli_query($conn, $sql);
$array3=array();
while($row=$result->fetch_array()){
         $array3[]=$row;
}
$data=mysqli_num_rows($result);
mysqli_close($conn);
?>

<!DOCTYPE HTML>

<html>
<head>
    <!-- Meta Data -->
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    
    <!-- Bootstrap -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">	
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- My CSS -->  
	
	<title>Edit Event Details</title>
</head>

<style>
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>
   
<body>      
    
<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="../home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../drafts.php"><i class="fas fa-bookmark"></i>   Drafts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../rejectedEvents.php"><i class="far fa-calendar"></i>   Rejected Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="../allEvents.php"><i class="fas fa-calendar-alt"></i>   Approved Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
  <?php
    if($data==0){
  ?>
    <a class="nav-link"><i class="far fa-bell"> No New Message</i></a>
  <?php
    }else{
  ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-bell"> New Message (<?php echo $data ?>)</i></a>
      <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="clearNotifications.php/?url=<?php echo $userId; ?>" style="text-align:right;">Clear all notification</a>
       <?php
        if($data<=10){
        for($i=0; $i<$data; $i=$i+1){
            if($i%2==0){
       ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php
            }else{
      ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>" style="background-color:#C7BBF0;"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php  
            }
        }
       }else{
            for($i=0; $i<10; $i=$i+1){
            if($i%2==0){
       ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php
            }else{
      ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>" style="background-color:#C7BBF0;"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php  
            }
          }
       ?>
            <a class="dropdown-item" href="../allNotifications.php/?url=<?php echo $userId; ?>" style="text-align:right;">View all notifications</a>
      <?php  
        }
      ?>
      </div>
  <?php
    } 
  ?>  
    
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       <?php echo $userName; ?></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../profile.php"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->  
       
        <br/><div class="container">
        
        <?php
        if($array[0]['declineReply']!=""){
        ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-danger">          
              <h5>The Information Officer says:</h5>
              <?php echo $array[0]['declineReply']; ?>
            </div>
        <?php
        }
        ?>          
           
        
        
         <h3>Edit Event Details: </h3><hr/>
          <form method="POST" action="../submitEditedEvent.php" enctype='multipart/form-data' >
             <div class="form-group">
                <label for="event">Name of the event:</label>
                <input type="text" class="form-control" id="event" name="name" required value="<?php echo $array[0]['name']; ?>">
              </div>
              
              <div class="form-group">
                <label for="departmentl1">Institute Level/Department:</label>
                  <select class="form-control" id="department"  name="department" required>
                    <option selected value="<?php echo $array[0]['department']; ?>"><?php echo $array[0]['department']; ?></option>
                    <option value="CSIT">CS/IT</option>
                    <option value="EnTc">EnTc</option>
                    <option value="Mech">Mech</option>
                    <option value="Civil">Civil</option>
                    <option value="Applied Science">Applied Science</option>
                    <option value="Reverb">Reverb</option>
                    <option value="EPIC">EPIC</option>
                    <option value="Techfest">Techfest</option>
                    <option value="CSR">CSR</option>
                    <option value="" id="otherDepartmentDropdown">Other Club Activities</option><br/>                    
                  </select>
                  <input type="text" class="form-control" id="otherDepartmentText" placeholder="For Other Club Activities (Leave blank if not applicable)" onkeyup="otherDepartment()" value="">
              </div>
              
              <div class="form-group">
                  <label for="incharge">Event In-charge (Name of faculty/staff):</label>
                  <textarea class="form-control" rows="5" id="incharge" maxlength="1000" name="incharge" required><?php echo $array[0]['incharge']; ?></textarea>
              </div>
              
              <div class="form-group">
                <label for="date">Date of the event:</label>
                <input type="date" class="form-control" id="date"  name="date" required value="<?php echo $array[0]['date']; ?>">
              </div>
              
              <div class="form-group">
                <label for="date">Attendees:</label>
                <?php
                if($array[0]['attendees']=="Staff"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]" checked>&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]">&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['attendees']=="Faculty"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]" checked>&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]">&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['attendees']=="Student"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]" checked>&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['attendees']=="Staff,Faculty"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]" checked>&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]" checked>&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]">&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['attendees']=="Staff,Student"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]" checked>&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]" checked>&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['attendees']=="Faculty,Student"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]" checked>&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]" checked>&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }else{
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]" checked>&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]" checked>&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]" checked>&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
                <?php
                }
                ?>
              </div>
              
              <div class="form-group">
                <label for="for">Event is for:</label>
                <?php
                if($array[0]['eventFor']=="B.Tech"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="B.Tech" name="for[]" checked>&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="M.Tech" name="for[]">&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label>
                <?php
                }elseif($array[0]['eventFor']=="M.Tech"){
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="B.Tech" name="for[]">&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="M.Tech" name="for[]" checked>&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label>
                <?php
                }else{
                ?>
                    <label class="checkbox-inline"><input type="checkbox" value="B.Tech" name="for[]" checked>&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                    <label class="checkbox-inline"><input type="checkbox" value="M.Tech" name="for[]" checked>&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label>
                <?php
                }
                ?>
              </div>
              
              <div class="form-group">
                <label for="type">Type:</label>
                  <select class="form-control" id="type" name="type" required>
                    <option selected value="<?php echo $array[0]['type']; ?>"><?php echo $array[0]['type']; ?></option>
                    <option value="Curricular Activity">Curricular Activity</option>
                    <option value="Co-Curricular Activity">Co-Curricular Activity</option>
                  </select>
              </div>     
                       
              <div class="form-group">
                <label for="category">Category of event:</label>
                  <select class="form-control" id="category" name="category" required>
                    <option selected value="<?php echo $array[0]['category']; ?>"><?php echo $array[0]['category']; ?></option>
                    <option value="Guest Lecture">Guest Lecture</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Workshop-Student Training">Workshop/Student Training</option>
                    <option value="Faculty Development Programme">FDP</option>
                    <option value="Industrial Visit">Industrial Visit</option>
                    <option value="Industry-Institute Interaction Activity">Industry-Institute Interaction Activity</option>
                    <option value="Alumni Activity">Alumni Activity</option>
                    <option value="Entrepreneurship Initiatives">Entrepreneurship Initiatives</option>
                    <option value="Cultural Events">Cultural Events</option>
                    <option value="Spons Activity Event">Spons Activity Event</option>
                    <option value="Annual College Gathering Fest">Annual College Gathering Fest</option>
                    <option value="Annual College Technical Fest">Annual College Technical Fest</option>
                    <option value="Conference">Conference</option>
                    <option value="" id="otherCategoryDropdown">Any Other Activity:</option>
                  </select>
                  <input type="text" class="form-control" id="otherCategoryText" placeholder="For Other Category of event (Leave blank if not applicable)" onkeyup="otherCategory()" value="">
              </div>
              
              <div class="form-group">
                  <label for="resource">Mention the Name and Designation of Resource person(s):</label><br/>
                  
                <table class="table">
                <tbody>
                  <tr>
                    <td>
                        <select class="form-control" id="noOfRowsToAdd">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>                
                    <option value="4">4</option>                
                    <option value="5">5</option>                
                    <option value="6">6</option>                
                    <option value="7">7</option>                
                    <option value="8">8</option>                
                    <option value="9">9</option>                
                    <option value="10">10</option>                
                      </select>  
                    </td>
                    <td>
                        <a class="btn btn-outline-primary" id="add"> <<- Add these many rows</a>                        
                    </td>
                    <td>
                        <select class="form-control" id="noOfRowsToDelete">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>                
                    <option value="4">4</option>                
                    <option value="5">5</option>                
                    <option value="6">6</option>                
                    <option value="7">7</option>                
                    <option value="8">8</option>                
                    <option value="9">9</option>                
                    <option value="10">10</option>                
                      </select>  
                    </td>
                    <td>
                        <a class="btn btn-outline-primary" id="remove"> <<- Delete these many rows</a>                        
                    </td>
                  </tr>
                </tbody>
                </table>                 
                  
                <table class="table" id="userTable">
                <thead  class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Designation</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                    for($i=0; $i<$noOfResource; $i=$i+1){
                 ?>
                        <tr>
                           <td><input type="text" class="form-control" id="event" name="resourceName[]" value="<?php echo $resourcePersonArray[$i]; ?>" required></td>
                           <td><input type="text" class="form-control" id="event" name="resourceDesignation[]" value="<?php echo $resourceDesignationArray[$i]; ?>" required></td>
                        </tr>
                 <?php
                    }
                 ?>
                </tbody>
                </table>
              </div>
              
              <div class="form-group">
                  <label for="describe">A paragraph describing the event/activty:</label>
                  <textarea class="form-control" rows="5" id="describe" maxlength="5000" name="describe" required><?php echo $array[0]['eventDescribe']; ?></textarea>
              </div>
              
              <div class="form-group">
                  <label for="achievement">Any Achievement/Awards won during the said activity:</label>
                  <textarea class="form-control" rows="5" id="achievement" maxlength="1000" name="achievement" required><?php echo $array[0]['achievements']; ?></textarea>
              </div>
              
              <div class="form-group">
                  <label for="media"><b>Add more files?</b></label>
                  <div id="wrapper" style="margin-top: 20px;">
                     <label for="files" class="btn btn-primary">Select File(s)</label><p id="noOfFiles"></p>
                     <input style="visibility:hidden;" type="file" id="files" name="media[]" accept="file_extension|audio/*|video/*|image/*|media_type" multiple="multiple" class="form-control-file">
                      <output id="list"></output>
                  </div>
              </div>
              
              <div class="form-group" style="display:none">
                <input type="text" class="form-control" id="eventId" name="eventId" value="<?php echo $array[0]['eventId']; ?>">
              </div>
              <?php
              if(substr($_SERVER['HTTP_REFERER'], -10)=='drafts.php'){
              ?>
                <button type="submit" class="btn btn-outline-dark" name="save" class="save">Save as a Draft &nbsp;&nbsp;<i  id="spin"></i></button>         
              <?php
              }
              ?>
              
              <button type="submit" class="btn btn-outline-primary" name="submit">Save Edits and Resubmit Event</button>      
          </form><br/> 
        </div>
        
        <!--Load scripts-->        
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        
        <!--Bootstrap-->
        <script src="../../assets/js/bootstrap.min.js"></script>  
        
        <script>
        function otherDepartment(){
            var x = $("#otherDepartmentText").val();
            document.getElementById("otherDepartmentDropdown").value=x;
        }
    
        function otherCategory(){
            var x = $("#otherCategoryText").val();
            document.getElementById("otherCategoryDropdown").value=x;
        }           
            
        $("#add").click(function () {
            var e = document.getElementById("noOfRowsToAdd");
            var noOfRowsToAdd = e.options[e.selectedIndex].value;
    
            var i;
    
            for(i=0; i<noOfRowsToAdd; i++){
                $("#userTable").each(function () {
                var tds = '<tr>';
                jQuery.each($('tr:last td', this), function () {
                    tds += '<td>' + $(this).html() + '</td>';
                });
                tds += '</tr>';
                if ($('tbody', this).length > 0) {
                    $('tbody', this).append(tds);
                } else {
                    $(this).append(tds);
                    }
                });
            }    
     
        });
            
        $('#remove').on("click", function(){
            var i;
            var e = document.getElementById("noOfRowsToDelete");
            
            var noOfRowsToDelete = e.options[e.selectedIndex].value;      
            var noOfRows = document.getElementById("userTable").rows.length-1;            
            
            for(i=0; i<noOfRowsToDelete; i++){
                if(noOfRows>noOfRowsToDelete){
                    $('#userTable tr:last').remove();
                }else{
                    alert("Can't remove the row!");
                    break;
                }
            }            
        })
            
      
function clearNoOfFile(){
    document.getElementById("noOfFiles").innerHTML = "0 File(s) Selected";
}

function handleFileSelect(evt) {
    document.getElementById("list").innerHTML ="";
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        if(f.type.substring(0, 5)=='image'){
            if(Math.round(f.size/1024)<1024){
                alert("Pictures smaller than 1mb are not allowed!");
                document.getElementById("list").innerHTML ="";
                setTimeout(clearNoOfFile, 100);                
                return;
            }
        }
        
      var reader = new FileReader();       

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
          
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
    
  
  $("#files").on('change', function(){
    var noOfFiles=0;
    var countFiles = $(this)[0].files.length;
    noOfFiles=noOfFiles+countFiles;
    document.getElementById("noOfFiles").innerHTML = noOfFiles+" File(s) Selected";
      
  })

        </script>
    
    </body>
    
    
</html>