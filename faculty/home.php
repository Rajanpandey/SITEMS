<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "sitems");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

//Query to select the user
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

//Logic to count total pages for pagination
$num_rec_per_page=10;
$selecAllIssues = "SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' AND archive IS NULL ";
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
$issues=0;
$start_from=($page-1)*$num_rec_per_page; 
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus IS NULL ORDER BY date DESC";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array1 = array();
    while($row=mysqli_fetch_assoc($result)){
         $array1[]=$row;
         $issues++;
    }
}
$totalUnapprovedEvents=mysqli_num_rows($result);

//Query to select events that are approved
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' AND archive IS NULL ORDER BY date DESC LIMIT $start_from, $num_rec_per_page";
$result=mysqli_query($conn, $sql);
$array2=array();
while($row=$result->fetch_array()){
         $array2[]=$row;
}

//Query to select number of new messages
$sql="SELECT * FROM events WHERE userId='$userId' AND declineReply IS NOT NULL AND viewedNotification IS NULL";
$result=mysqli_query($conn, $sql);
$array3=array();
while($row=$result->fetch_array()){
         $array3[]=$row;
}
$data=mysqli_num_rows($result);

//Query to select number of rejected events
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='-1'";
$result=mysqli_query($conn, $sql);
$rejected=mysqli_num_rows($result);

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
	<link rel="stylesheet" href="../assets/mycss/facultyHome.css">
	
	<title>Faculty Home</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="rejectedEvents.php"><i class="far fa-calendar"></i>   Rejected Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
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
       <?php
        for($i=0; $i<$data; $i=$i+1){
       ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo $array3[$i]['declineReply']; ?></a>
      <?php
        }
      ?>
      </div>
  <?php
    } 
  ?>  
</li>
    
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       Profile</i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../profile.php?u=<?php echo $userId; ?>"><i class="fas fa-user-alt"></i>   My Profile</a>
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
          <h4 class="modal-title">Submit a new event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header Ends -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="submitEvent.php" enctype='multipart/form-data' >
             <div class="form-group">
                <label for="event">Name of the event:</label>
                <input type="text" class="form-control" id="event" name="name" required>
              </div>
              
              <div class="form-group">
                <label for="sedepartmentl1">Institute Level/Department:</label>
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
              </div>
              
              <div class="form-group">
                  <label for="incharge">Event In-charge (Name of faculty/staff):</label>
                  <input type="text" class="form-control" id="incharge" name="incharge" required>
              </div>
              
              <div class="form-group">
                <label for="date">Date of the event:</label>
                <input type="date" class="form-control" id="date"  name="date" required>
              </div>
              
              <div class="form-group">
                <label for="date">Attendees:</label>
                <label class="checkbox-inline"><input type="checkbox" value="Staff" name="attendees[]">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="Faculty" name="attendees[]">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="Student" name="attendees[]">&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
              </div>
              
              <div class="form-group">
                <label for="for">Event is for:</label>
                <label class="checkbox-inline"><input type="checkbox" value="B.Tech" name="for[]">&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="M.Tech" name="for[]">&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label>
              </div>
              
              <div class="form-group">
                <label for="type">Type:</label>
                  <select class="form-control" id="type" name="type" required>
                    <option disabled selected value> -- Select an option -- </option>
                    <option value="Curricular Activity">Curricular Activity</option>
                    <option value="Co-Curricular Activity">Co-Curricular Activity</option>
                  </select>
              </div>     
                       
              <div class="form-group">
                <label for="category">Category of event:</label>
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
              </div>
              
              <div class="form-group">
                  <label for="resource">Mention the Name and Designation of Resource person(s):</label>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-primary" id="add">Add a new row</a>
                  <table class="table" id="userTable">
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
                  <label for="describe">A paragraph describing the event/activty:</label>
                  <textarea class="form-control" rows="5" id="describe" maxlength="5000" name="describe" required></textarea>
              </div>
              
              <div class="form-group">
                  <label for="achievement">Any Achievement/Awards won during the said activity:</label>
                  <textarea class="form-control" rows="5" id="achievement" maxlength="1000" name="achievement" required></textarea>
              </div>
              
              <div class="form-group">
                  <label for="media">Please upload 5/7 <b>high resolution pictures</b> of the said event; and also mail the same to Information Officer:</label>
                  <input type="file" name="media[]" accept="file_extension|audio/*|video/*|image/*|media_type" multiple="multiple" class="form-control-file" required>
              </div>
              
              <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>              
          </form>
        </div>  
        <!-- Modal body Ends -->  
            
      </div>
    </div>
  </div>
<!-- Submit Event Modal Ends -->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <center><img class="logo" src="../assets/img/sitLogo.png"></center><br/>            
            <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#myModal">Submit a new event</button><br/><br/>
        </div>        
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3>Events awaiting approval: </h3><br/>
        </div>
        
    <?php 
        if($totalUnapprovedEvents==0){
    ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success">
          <strong>Congrats!</strong> There is no unapproved event!
        </div>
     <?php 
        if($rejected!=0){
    ?>     
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-danger">
          <strong>But,</strong> there are some declined events!
        </div>
     <?php 
        }
    ?>     
        </div>
    <?php 
        }else{
            for($i=0; $i<$totalUnapprovedEvents; $i++){
    ?>
    
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
              <div class="posts">
              <a href="../eventDetails.php/?url=<?php echo $array1[$i]['url']; ?>">
               <div class="image">
                <img class="articleImage" src="../assets/img/<?php echo $array1[$i]['category']; ?>.jpg">
               </div>
               <div class="container" id="description">
                  <h4 class="card-title"><?php echo $array1[$i]['name']; ?></h4>
                  <p class="card-text">Held on: <?php echo $array1[$i]['date']; ?></p>
                </div></a>
              </div>
        </div> 
    <?php 
            }
        }
    ?>       
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <hr/><br/>
        </div>
        
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <h3>Approved Events: </h3>
        </div>
        
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
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
          <thead  class="thead-dark">
            <tr>
              <th><a class="column_sort" id="name" data-order="desc" href="#">Name of the Event</a></th>
              <th><a class="column_sort" id="category" data-order="desc" href="#">Category</a></th>              
              <th><a class="column_sort" id="eventDescribe" data-order="desc" href="#">Description</a></th>
              <th><a class="column_sort" id="date" data-order="desc" href="#">Date</a></th>
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
                 <tr class='clickable-row' data-href='../eventDetails.php/?url=<?php echo $array2[$i]['url']; ?>'>
                  <td><?php echo $array2[$i]['name']; ?></td>
                  <td><?php echo $array2[$i]['category']; ?></td>
                  <td><?php echo $array2[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array2[$i]['date']; ?></td>
                </tr>
                </div>
          <?php
                }  
            }else{
          ?> 
              <h3>No Events to show!!</h3>
          <?php
            }
          ?> 
          </tbody>
        </table><br/>   
        </div>       
               
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-info">
          <a class="alert-link" href="allEvents.php">Click Here</a> to view all events at once!
        </div>          
    </div>
    <br/><br/>


<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  

<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = ''; 
           if(order == 'desc')  
           {  
                arrow = '&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i>';  
           }  
           else  
           {  
                arrow = '&nbsp;<i class="fa fa-chevron-up" aria-hidden="true"></i>';  
           }  
           $.ajax({  
                url:"sortColumns.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#eventsTable').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });
    
function otherDepartment(){
    var x = $("#otherDepartmentText").val();
    document.getElementById("otherDepartmentDropdown").value=x;
}
    
function otherCategory(){
    var x = $("#otherCategoryText").val();
    document.getElementById("otherCategoryDropdown").value=x;
}
    
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});    
    
$("#add").click(function () {
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
});
 </script> 
 

</body>