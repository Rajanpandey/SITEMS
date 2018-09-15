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

//Query to select events that are approved
$sql="SELECT * FROM events WHERE approvalStatus='1' AND archive IS NULL ORDER BY date DESC";
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
	<link rel="stylesheet" href="../assets/mycss/facultyHome.css">
	
	<title>Events List</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       <?php echo $userName; ?></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../profile.php?u=<?php echo $userId; ?>"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->  

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
          </form>  
         </div>
          
        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
            <h3>List of all the Past Events: </h3>
            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names.." title="Type in a name">
        
        <div class="table-responsive" id="eventsTable">
        <table class="table table-bordered table-hover allEventsTable" id="myTable">
          <thead class="thead-dark">
            <tr>
              <th><a id="name">Name of the Event</a></th>
              <th><a id="department">Department</a></th>    
              <th><a id="category">Category</a></th>              
              <th><a id="eventDescribe">Description</a></th>
              <th><a id="date">Date</a></th>
              <th><a id="attendees">Attendees</a></th>
              <th><a id="eventFor">Event For</a></th>
              <th><a id="type">Type</a></th>
            </tr>
          </thead>
          <tbody>
          <?php
            for($i=0; $i<$totalEvents; $i=$i+1){
            ?>
                <div id="eventRows">
                 <tr class='clickable-row' data-href='../eventDetails.php/?url=<?php echo $array[$i]['url']; ?>'>
                  <td><?php echo $array[$i]['name']; ?></td>
                  <td><?php echo $array[$i]['department']; ?></td>
                  <td><?php echo $array[$i]['category']; ?></td>
                  <td><?php echo $array[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array[$i]['date']; ?></td>
                  <td><?php echo $array[$i]['attendees']; ?></td>
                  <td><?php echo $array[$i]['eventFor']; ?></td>
                  <td><?php echo $array[$i]['type']; ?></td>
                </tr>
                </div>
          <?php
            }  
          ?> 
          </tbody>
        </table> 
        </div> 
          <button onclick="exportToExcel();" class="btn btn-outline-info" id="generateReport">Generate and Download Report</button>  
          <button onclick="print();" class="btn btn-outline-info" id="printReport">Print Report</button>  
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
$("#department1").change(function(){
    sort();
});    
$("#category1").change(function(){
    sort();
});    
$("#year1").change(function(){
    sort();
});    
$("#type1").change(function(){
    sort();
});    
$("#attendees1").change(function(){
    sort();
});    
$("#eventFor1").change(function(){
    sort();
});   
    
function sort(){
    var department, category, year, type, attendees, eventFor;
    department=$('#department1').val();
    category=$('#category1').val();
    year=$('#year1').val();
    type=$('#type1').val();
    attendees=$('#attendees1').val();
    eventFor=$('#eventFor1').val();
    
    $.ajax({  
        url:"sort.php",  
        method:"POST",  
        data:{department:department, category:category, year:year, type:type, attendees:attendees, eventFor:eventFor},  
        success:function(data){  
            $('#eventsTable').html(data);  
        }  
    })       
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
        tr[i].style.display = "";        
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 
    
function reset(){
    var department, category, year, type, attendees, eventFor;
    department=$('#department1').val()="";
    category=$('#category1').val()="";
    year=$('#year1').val()="";
    type=$('#type1').val()="";
    attendees=$('#attendees1').val()="";
    eventFor=$('#eventFor1').val()="";
} 
    
function exportToExcel(){
    var tableID=$('.allEventsTable').attr('id');
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
    var textRange; var i=0;
    tab = document.getElementById(tableID); // id of table

    for(i = 0 ; i < tab.rows.length ; i++)
    {

        tab_text=tab_text;
        if(tab.rows[i].style.display != "none"){
            tab_text=tab_text+tab.rows[i].innerHTML+"</tr>";
        }
        
        //tab_text=tab_text+"</tr>";
    }

    tab_text= tab_text+"</table>";

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write( 'sep=,\r\n' + tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa=txtArea1.document.execCommand("SaveAs",true,"report.txt");
    }
    else {
       sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }
    
    return (sa);
}
    
function print()
{
    var tableID=$('.allEventsTable').attr('id');
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
    var textRange; var i=0;
    tab = document.getElementById(tableID); // id of table

    for(i = 0 ; i < tab.rows.length ; i++)
    {

        tab_text=tab_text;
        if(tab.rows[i].style.display != "none"){
            tab_text=tab_text+tab.rows[i].innerHTML+"</tr>";
        }
        
        //tab_text=tab_text+"</tr>";
    }
    tab_text= tab_text+"</table>";
    
    newWin= window.open("");
    newWin.document.write(tab_text);
    newWin.print();
    newWin.close();
}

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
 </script> 
</body>