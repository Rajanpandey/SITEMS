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

//Query to select the user
$sqlUserId="SELECT * FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];
$userName = $rowUserId['name'];

//Logic to count total pages for pagination
$num_rec_per_page=10;
$selecAllIssues = "SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' AND archive IS NULL";
$allIssues = mysqli_query($conn, $selecAllIssues);			  
$total_records =mysqli_num_rows($allIssues);  //count number of issues					  
$total_pages = ceil($total_records / $num_rec_per_page);   

//Fetch Issues Posted By All Users
if(isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else { 
    $page=1; 
}; 

//Query to select events awaiting approval
$sql="SELECT * FROM events WHERE approvalStatus IS NULL AND draft IS NULL ORDER BY date DESC";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array1 = array();
    while($row=mysqli_fetch_assoc($result)){
         $array1[]=$row;
    }
}
$totalUnapprovedEvents=mysqli_num_rows($result);

//Query to select events that are approved
$start_from=($page-1)*$num_rec_per_page; 
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' AND archive IS NULL ORDER BY date DESC LIMIT $start_from, $num_rec_per_page";
$result=mysqli_query($conn, $sql);
$array2=array();
while($row=$result->fetch_array()){
         $array2[]=$row;
}

mysqli_close($conn);
?>


<!DOCTYPE HTML>
<html>
<head>
    <!-- Meta Data -->
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    
    <!-- Bootstrap -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">	
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- My CSS -->  
	<link rel="stylesheet" href="../assets/mycss/sitLogo.css">
	<link rel="stylesheet" href="../assets/mycss/cards.css">
	<link rel="stylesheet" href="../assets/mycss/table.css">
	<link rel="stylesheet" href="../assets/mycss/thumbPostEvent.css">
	
	<title>Information Officer Home</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       <?php echo $userName; ?></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="profile.php"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->  

<!-- Submit Event Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Submit a new event data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header Ends -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="submitEvent.php" enctype='multipart/form-data'>
            <table class="table table-borderless table-striped">
                <tr>
                    <td>
                        <center>Name of the event:</center>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="event" name="name" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>Event In-charge (Name of faculty/staff):</center>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="incharge" name="incharge" required>
                    </td>
                </tr>                                         
                
                <tr>
                    <td>
                        <center>Attendees:</center>
                    </td>
                    <td>
                        <center><label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]">&nbsp; Student &nbsp;&nbsp;&nbsp;</label></center>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <center>Event is for:</center>
                    </td>
                    <td>
                        <center><label class="checkbox-inline"><input type="checkbox" value="B.Tech" name="for[]">&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input type="checkbox" value="M.Tech" name="for[]">&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label></center>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <center>Date of the event:</center>
                    </td>
                    <td>
                        <input type="date" class="form-control" id="date"  name="date" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>Type:</center>
                    </td>
                    <td>
                        <select class="form-control" id="type" name="type" required>
                            <option disabled selected value> -- Select an option -- </option>
                            <option value="Curricular Activity">Curricular Activity</option>
                            <option value="Co-Curricular Activity">Co-Curricular Activity</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <center>Institute Level/Department:</center>
                    </td>
                    <td>
                        <select class="form-control" id="department"  name="department" required>
                    <option disabled selected value> -- Select an option -- </option>
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
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <center>Category of event:</center>
                    </td>
                    <td>
                        <select class="form-control" id="category" name="category" required>
                    <option disabled selected value> -- Select an option -- </option>
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
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        A paragraph describing the event/activty:
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea class="form-control" rows="5" id="describe" maxlength="5000" name="describe" required></textarea>
                    </td>
                </tr>  
                <tr>
                    <td colspan="2">
                        Any Achievement/Awards won during the said activity:
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea class="form-control" rows="5" id="achievement" maxlength="1000" name="achievement" required></textarea>
                    </td>
                </tr>  
                
            </table>

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
                  
                <table class="table table-bordered" id="userTable">
                <thead  class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Designation</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="form-control" id="event" name="resourceName[]" required></td>
                    <td><input type="text" class="form-control" id="event" name="resourceDesignation[]" required></td>
                  </tr>
                </tbody>
                </table>
              </div>
              
              <div class="form-group">
                  <label for="media">Please upload 5/7 <b>high resolution pictures</b> and other documents of the said event:</label>
                  <div id="wrapper" style="margin-top: 20px;">
                     <label for="files" class="btn btn-primary">Select File(s)</label><p id="noOfFiles"></p>
                     <input style="visibility:hidden;" type="file" id="files" name="media[]" accept="file_extension|audio/*|video/*|image/*|media_type" multiple="multiple" class="form-control-file" required>
                      <output id="list"></output>
                  </div>
              </div>
              
              <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>              
          </form>
        </div>  
        <!-- Modal body Ends -->  
            
      </div>
    </div>
  </div>
<!-- Submit Event Modal Ends -->

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Reason for declining event data (optional):</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="form-group">
              <label for="comment"></label>
              <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Write a comment here"></textarea>
            </div>
            
            <button type="submit" class="btn btn-outline-danger decline" name="submit">Decline</button>
        </form>
      </div>     
    </div>
  </div>
</div>  

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <center><img class="logo" src="../assets/img/sitLogo.png"></center><br/>            
            <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#myModal">Submit a new event data</button><br/><br/>
        </div>        
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3>Event data awaiting my approval: <button onclick="location.href='approveAll.php';" class="btn btn-outline-dark">Approve All Event Data!</button> </h3>
            <br/>
        </div>
        <?php 
        if($totalUnapprovedEvents==0){
    ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success">
          <strong>Congrats!</strong> There is no unapproved event data left! 
        </div>
    <?php 
        }else{
            for($i=0; $i<$totalUnapprovedEvents; $i++){
    ?>
    
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">              
              <div class="posts" id="<?php echo $array1[$i]['eventId']; ?>">
              <a href="eventDetails.php/?url=<?php echo $array1[$i]['url']; ?>">
               <div class="image">
                <img class="articleImage" src="../assets/img/<?php echo $array1[$i]['category']; ?>.jpg">
               </div>
               </a>
               <div class="container" id="description">
                 <a href="eventDetails.php/?url=<?php echo $array1[$i]['url']; ?>">
                  <h4 class="card-title"><?php echo $array1[$i]['name']; ?></h4>
                  <p class="card-text">Held on: <?php echo $array1[$i]['date']; ?></p>
                 </a><br/>
                  <div class=" cardFooter">
                      <button class="btn btn-outline-success approve" id="approve-<?php echo $array1[$i]['eventId']; ?>" style="display:">Approve</button> 
                      <button class="btn btn-outline-danger commentDecline" id="decline-<?php echo $array1[$i]['eventId']; ?>" style="display:" data-toggle="modal" data-target="#myModal2">Decline</button> 
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success approved" id="approved-<?php echo $array1[$i]['eventId']; ?>" style="display:none">
                          <a class="alert-link">Approved!!</a>
                      </div>
                  </div>
                </div>
              </div>
              
        </div> 
    <?php 
            }
        }
    ?>        
   
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <hr/><br/>
        </div>
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-info">
          <a class="alert-link" href="allEvents.php">Click Here</a> to view all event data submitted by everyone!
        </div>  
        
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <h3>List of event data submitted by me: </h3>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
<?php  
    if($total_records!=0){
    //If page 1-3 is selected, show first 5 pages
    if($page<4){
?>
    <ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }    
        
    if($total_pages<=5) {
        for ($i=1; $i<=$total_pages; $i++) { 							 
            if($i == $page){	
                ?>
                <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
                <?php				   
            } else{
                ?>
                <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
            <?php	
            }							
        };
    }
        
    else {
        for ($i=1; $i<=5; $i++) { 							 
            if($i == $page){	
                ?>
                <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
                <?php				   
            } else{
                ?>
                <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
            <?php	
            }							
        };
    }
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 

<?php	
        }
    //If page selected is more than total-3, show last five pages
    elseif($page>$total_pages-3){
?>
<ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }
                             
    for ($i=$total_pages-4; $i<=$total_pages; $i++) { 							 
        if($i == $page){	
            ?>
            <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
            <?php				   
        } else{
            ?>
            <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
        <?php	
        }							
    };
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 

<?php	
        }
    //If any middle page is selected, show that page and left two and right two along with it
    else{
?>

<ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=1'> << </a></li>
    <?php
    }
                             
    for ($i=$page-2; $i<=$page+2; $i++) { 							 
        if($i == $page){	
            ?>
            <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
            <?php				   
        } else{
            ?>
            <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
        <?php	
        }							
    };
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 
<?php	
        }
?>
        </div>
        
        <div class="table-responsive" id="eventsTable">
        <table class="table table-bordered table-hover" id="myTable">
          <thead class="thead-dark">
            <tr>
              <th><a id="name">Name of the Event</a></th>
              <th><a id="category">Category</a></th>              
              <th><a id="eventDescribe">Description</a></th>
              <th><a id="date">Date</a></th>
              <th><a id="edit">Edit</a></th>
            </tr>
          </thead>
          <tbody>
          <?php
            if($page==$total_pages && ($total_records % 10)!=0){
                $n=$total_records % 10;
            }else{
                $n=10;
            }           
            
                for($i=0; $i<$n; $i=$i+1){
            ?>
                <div id="eventRows">
                 <tr class='clickable-row' data-href='eventDetails.php/?url=<?php echo $array2[$i]['url']; ?>'>
                  <td><?php echo $array2[$i]['name']; ?></td>
                  <td><?php echo $array2[$i]['category']; ?></td>
                  <td><?php echo $array2[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array2[$i]['date']; ?></td>
                  <td><a href="editEvent.php/?url=<?php echo $array2[$i]['url']; ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a></td>
                </tr>
                </div>
          <?php
                }  
            }else{
          ?> 
              <h3>No event data to show!</h3>
          <?php
            }
          ?> 
          </tbody>
        </table>  
        </div>
        
    </div>
    <br/><br/><br/>
</div>

<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  

<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

<script>      
function otherDepartment(){
    var x = $("#otherDepartmentText").val();
    document.getElementById("otherDepartmentDropdown").value=x;
}
    
function otherCategory(){
    var x = $("#otherCategoryText").val();
    document.getElementById("otherCategoryDropdown").value=x;
}

 $(document).ready(function(){  
      $(document).on('click', '.approve', function(){  
          var id = $(this).attr("id");  
          var eventId=id.substr(8);
           $.ajax({  
                url:"approve.php",  
                method:"POST",  
                data:{eventId:eventId},  
                success:function(data){  
                    
                }  
           })  
      });  
 });
    
$(".approve").click(function(){
    var id=this.id;
    var eventId=id.substr(8);
    
    $("#approve-"+eventId).hide();
    $("#decline-"+eventId).hide();
    $("#approved-"+eventId).show();    
});
    
    
var declineId;
$(".commentDecline").click(function(){
    var id=this.id;
    var eventId=id.substr(8);
    declineId=eventId;
});    
 $(document).ready(function(){  
      $(document).on('click', '.decline', function(){  
          var eventId=declineId;
          var comment = $('textarea#comment').val();
          
           $.ajax({  
                url:"decline.php",  
                method:"POST",  
                data:{eventId:eventId, comment:comment},  
                success:function(data){  
                    
                }  
           })  
      });  
 });
    
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
    
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