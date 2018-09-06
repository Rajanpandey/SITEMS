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

//Query to select events that are approved
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' ORDER BY date DESC";
$result=mysqli_query($conn, $sql);
$array=array();
while($row=$result->fetch_array()){
         $array[]=$row;
}
$totalEvents=mysqli_num_rows($result);
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
	
	<link rel="stylesheet" href="../assets/mycss/navbar.css">
	<link rel="stylesheet" href="../assets/mycss/facultyHome.css">
	
	<title>Events List</title>
</head>

<body>

<!-- Side Navbar -->
<nav class="navbar navbar-expand-sm bg-light sticky-top">

 <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="home.php"><i class="fas fa-home"></i>   Home</a>
  <a href="myprofile.php"><i class="fas fa-user"></i>   My Events</a>
  <a href="myqueries.php"><i class="fas fa-question-circle"></i>   All Events</a>
  <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
</div>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link"><i class="fas fa-bars button-collapse" onclick="openNav()"></i></a>
    </li>
  </ul>  
</nav>
<!-- Side Navbar Ends -->
<br/>
<div class="container-fluid">
    <div class="row">
       <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 alert alert-info">
          <strong class="alert-link">Filters</strong> to sort!
                  
          <form class="moreFilters">
            <br/>
              
              <div class="form-group">
                <label for="department">Institute Level/Department:</label>
                  <select class="form-control" id="department1">
                    <option selected value=""> -- Select an option -- </option>
                    <option value="CSIT">CS/IT</option>
                    <option value="EnTc">EnTc</option>
                    <option value="Mech">Mech</option>
                    <option value="Civil">Civil</option>
                    <option value="Applied Science">Applied Science</option>
                    <option value="Reverb">Reverb</option>
                    <option value="EPIC">EPIC</option>
                    <option value="Techfest">Techfest</option>
                    <option value="CSR">CSR</option>
                    <option value="Other Club Activities">Other Club Activities</option>
                  </select>
              </div>
              
              <div class="form-group">
                <label for="department">Year:</label>
                  <select class="form-control" id="year1">
                    <option selected value=""> -- Select an option -- </option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                  </select>
              </div>
              
              <div class="form-group">
                <label for="department">Attendees:</label>
                  <select class="form-control" id="attendees1">
                    <option selected value=""> -- Select an option -- </option>
                    <option value="Staff">Staff</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Student">Student</option>
                    <option value="Staff,Faculty">Staff and Faculty</option>
                    <option value="Staff,Student">Staff and Student</option>
                    <option value="Faculty,Student">Faculty and Student</option>
                    <option value="Staff, Faculty,Student">Staff, Faculty and Student</option>
                  </select>
              </div>
              
              <div class="form-group">
                <label for="department">Event is for:</label>
                  <select class="form-control" id="eventFor1">
                    <option selected value=""> -- Select an option -- </option>
                    <option value="B.Tech">B.Tech</option>
                    <option value="M.Tech">M.Tech</option>
                    <option value="B.Tech,M.Tech">B.Tech and M.Tech</option>
                  </select>
              </div>
              
              <div class="form-group">
                <label for="type">Type:</label>
                  <select class="form-control" id="type1">
                    <option selected value=""> -- Select an option -- </option>
                    <option value="Curricular Activity">Curricular Activity</option>
                    <option value="Co-Curricular Activity">Co-Curricular Activity</option>
                  </select>
              </div>     
                       
              <div class="form-group">
                <label for="category">Category of event:</label>
                  <select class="form-control" id="category1"> 
                    <option selected value=""> -- Select an option -- </option>
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
                    <option value="">Any Other Activity:</option>
                  </select>
              </div>
              <button onclick="reset();" class="btn btn-outline-danger" id="resetFilters">Reset</button>  
              <button onmouseover="sort();" class="btn btn-outline-success" id="submitFilters">Hover over me to Sort</button>  
          </form>  
         </div>
          
        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
            <h3>List of all the Past Events: </h3>
            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names.." title="Type in a name">
        
        <table class="table table-bordered table-hover" id="myTable">
          <thead>
            <tr>
              <th><a id="name" data-order="desc" href="#">Name of the Event</a></th>
              <th><a id="department" data-order="desc" href="#">Department</a></th>    
              <th><a id="category" data-order="desc" href="#">Category</a></th>              
              <th><a id="eventDescribe" data-order="desc" href="#">Description</a></th>
              <th><a id="date" data-order="desc" href="#">Date</a></th>
              <th><a id="year" data-order="desc" href="#">Year</a></th>
              <th><a id="attendees" data-order="desc" href="#">Attendees</a></th>
              <th><a id="eventFor" data-order="desc" href="#">Event For</a></th>
              <th><a id="type" data-order="desc" href="#">Type</a></th>
              <th><a class="column_sort" id="url" data-order="" href="#">Details</a></th>
            </tr>
          </thead>
          <tbody>
          <?php
            for($i=0; $i<$totalEvents; $i=$i+1){
            ?>
                <div id="eventRows">
                 <tr>
                  <td><?php echo $array[$i]['name']; ?></td>
                  <td><?php echo $array[$i]['department']; ?></td>
                  <td><?php echo $array[$i]['category']; ?></td>
                  <td><?php echo $array[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array[$i]['date']; ?></td>
                  <td><?php echo substr($array[$i]['date'], 0,4); ?></td>
                  <td><?php echo $array[$i]['attendees']; ?></td>
                  <td><?php echo $array[$i]['eventFor']; ?></td>
                  <td><?php echo $array[$i]['type']; ?></td>
                  <td><a href="events.php/url=<?php echo $array[$i]['url']; ?>"><button  type="button" class="btn btn-outline-dark">View</button></a></td>
                </tr>
                </div>
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

<!-- My JS -->
<script src="../assets/myjs/navbar.js"></script>

<script>  

function sort(){
    var department, category, year, type, attendees, eventFor;
    department=$('#department1').val();
    category=$('#category1').val();
    year=$('#year1').val();
    type=$('#type1').val();
    attendees=$('#attendees1').val();
    eventFor=$('#eventFor1').val();
        
    reset();

    if(department!=""){
        sortTable(department, 1);
    }
    if(category!=""){
        sortTable(category, 2);
    }
    if(year!=""){
        sortTable(year, 5);
    }
    if(type!=""){
        sortTable(type, 8);
    }
    if(attendees!=""){
        sortTable(attendees, 6);
    }
    if(eventFor!=""){
        sortTable(eventFor, 7);
    }
}
    
function reset(){
  var table, tr, td, i, j;
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
      if(tr[i].style.display == "none"){
           tr[i].style.display = "";
        }   
  }
}
    
function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        if(tr[i].style.display == "none"){
           tr[i].style.display = "none";
        }else{
            tr[i].style.display = "";
        }
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
    
function sortTable(col, pos) {
  var input, filter, table, tr, td, i;
  filter = col.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[pos];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        if(tr[i].style.display == "none"){
           tr[i].style.display = "none";
        }else{
            tr[i].style.display = "";
        }
        
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 

$('#myInput').keydown(function(event) {
    if (event.keyCode == 8) {
        event.preventDefault();
    }
});
 </script> 
</body>