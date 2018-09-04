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
       <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 alert alert-info">
          <strong class="alert-link toggleFilters">More Filters</strong> to sort!
                  
          <form class="moreFilters">
            <br/>
              
              <div class="form-group">
                <label for="department">Institute Level/Department:</label>
                  <select class="form-control" id="department1" onchange="sortDepartment();">
                    <option disabled selected value=""> -- Select an option -- </option>
                    <option value="CSIT">CS/IT</option>
                    <option value="EnTc">EnTc</option>
                    <option value="Mech">Mech</option>
                    <option value="Civil">Civil</option>
                    <option value="Applied Science">Applied Science</option>
                    <option value="Reverb">Reverb</option>
                    <option value="EP2C">EP2C</option>
                    <option value="Techfest">Techfest</option>
                    <option value="CSR">CSR</option>
                    <option value="Other Club Activities">Other Club Activities</option>
                  </select>
              </div>
              
              <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" min="2008" max="2020" step="1" value="" id="year1" class="form-control" onkeyup="sortYear();"/>
              </div>
              
              <div class="form-group">
                <label for="date">Attendees:</label>
                <label class="checkbox-inline"><input type="checkbox" value="Staff" id="attendees1" name="attendees[]" onchange="sortAttendees(this.value);">&nbsp; Staff &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="Faculty" id="attendees1" name="attendees[]" onchange="sortAttendees(this.value);">&nbsp; Faculty &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="Student" id="attendees1" name="attendees[]" onchange="sortAttendees(this.value);">&nbsp; Student &nbsp;&nbsp;&nbsp;</label>
              </div>
              
              <div class="form-group">
                <label for="for">Event is for:</label>
                <label class="checkbox-inline"><input type="checkbox" value="B.Tech" id="B.Tech1" name="eventFor[]" onchange="sortEventFor(this.value);">&nbsp; B.Tech &nbsp;&nbsp;&nbsp;</label>
                <label class="checkbox-inline"><input type="checkbox" value="M.Tech" id="M.Tech1" name="eventFor[]" onchange="sortEventFor(this.value);">&nbsp; M.Tech &nbsp;&nbsp;&nbsp;</label>
              </div>
              
              <div class="form-group">
                <label for="type">Type:</label>
                  <select class="form-control" id="type1" onchange="sortType();">
                    <option disabled selected value=""> -- Select an option -- </option>
                    <option value="Curricular Activity">Curricular Activity</option>
                    <option value="Co-Curricular Activity">Co-Curricular Activity</option>
                  </select>
              </div>     
                       
              <div class="form-group">
                <label for="category">Category of event:</label>
                  <select class="form-control" id="category1" onchange="sortCategory();"> 
                    <option disabled selected value=""> -- Select an option -- </option>
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
              
              <button type="submit" class="btn btn-outline-primary" id="applyFilters">Apply Filters</button>  
          </form>  
         </div>
          
        <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
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
    
$('td:nth-child(6),th:nth-child(6)').hide();
$('td:nth-child(7),th:nth-child(7)').hide();
$('td:nth-child(8),th:nth-child(8)').hide();
$('td:nth-child(9),th:nth-child(9)').hide();
    
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
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
    
function sortDepartment() {
  var input, filter, table, tr, td, i;  
  var value=$('#department1').val();
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 
    
function sortCategory() {
  var input, filter, table, tr, td, i;  
  var value=$('#category1').val();
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 
    
function sortYear() {
  var input, filter, table, tr, td, i;  
  var value=$('#year1').val();
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
    
function sortType() {
  var input, filter, table, tr, td, i;  
  var value=$('#type1').val();
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[8];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}  
    
function sortAttendees(value) {
  var input, filter, table, tr, td, i;
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 
    
function sortEventFor(value) {
  var input, filter, table, tr, td, i;  
  input=value;
  filter = input.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 
 </script> 
</body>