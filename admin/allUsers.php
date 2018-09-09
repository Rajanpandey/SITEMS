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
$sql="SELECT * FROM users ORDER BY type";
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
      <a class="nav-link disabled"><i class="fas fa-users"></i>   All Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
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

<!-- Add User Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new users</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header Ends -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="addUser.php" enctype='multipart/form-data' >
            <table class="table" id="userTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="form-control" id="event" name="name[]" required></td>
                    <td><input type="email" class="form-control" id="event" name="email[]" required></td>
                    <td><input type="text" class="form-control" id="event" name="password[]" required></td>
                    <td>
                      <select class="form-control" id="event" name="type[]" required>
                        <option value="faculty" selected>Faculty</option>
                        <option value="informationOfficer">Information Officer</option>
                        <option value="admin">Admin</option>                
                      </select>
                  </tr>
                </tbody>
            </table>
            <a class="btn btn-outline-primary" id="add">Add a new row</a><br/><br/>                
            <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>              
          </form>
        </div>  
        <!-- Modal body Ends -->  
            
      </div>
    </div>
  </div>
<!-- Add User Modal Ends -->

<!-- Edit User Modal -->
<div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit user details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header Ends -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="editUser.php" enctype='multipart/form-data' >
            <table class="table" id="userTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="form-control" id="eName" name="name" value="" required></td>
                    <td><input type="email" class="form-control" id="eEmail" name="email" value="" required></td>
                    <td><input type="text" class="form-control" id="ePassword" name="password" value="" required></td>
                    <td>
                      <select class="form-control" id="eType" name="type" value="" required>
                        <option value="faculty" selected>Faculty</option>
                        <option value="informationOfficer">Information Officer</option>
                        <option value="admin">Admin</option>                
                      </select>
                  </tr>
                </tbody>
            </table>         
            <input type="text" class="form-control" id="eUserId" name="userId" value="" style="display: none">
            <button type="submit" class="btn btn-outline-primary" name="submit">Submit Changes</button>              
          </form>
        </div>  
        <!-- Modal body Ends -->  
            
      </div>
    </div>
  </div>
<!-- Add User Modal Ends -->

<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3>List of all Users: <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Add new users</button><br/></h3>

            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names.." title="Type in a name">            
        
        <table class="table table-bordered table-hover allEventsTable" id="myTable">
          <thead>
            <tr>
              <th><a data-order="desc" href="#">User ID</a></th>
              <th><a data-order="desc" href="#">Name</a></th>    
              <th><a data-order="desc" href="#">EMail</a></th>              
              <th><a data-order="desc" href="#">Password</a></th>
              <th><a data-order="desc" href="#">Role</a></th>
              <th><a data-order="desc" href="#">Edit</a></th>
              <th><a data-order="desc" href="#">Delete</a></th>
            </tr>
          </thead>
          <tbody>
          <?php
            for($i=0; $i<$totalEvents; $i=$i+1){
            ?>
                <div id="userRows">
                 <tr>
                  <td class="userId"><?php echo $array[$i]['userId']; ?></td>
                  <td class="name"><?php echo $array[$i]['name']; ?></td>
                  <td class="email"><?php echo $array[$i]['email']; ?></td>
                  <td class="password"><?php echo $array[$i]['password']; ?></td>
                  <td class="type"><?php echo $array[$i]['type']; ?></td>
                  <td><button type="button" class="btn btn-outline-info edit" data-toggle="modal" data-target="#myModal2">Edit</button></td>
                  <td><a href="deleteUser.php/?userId=<?php echo $array[$i]['userId']; ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
                </tr>
                </div>
          <?php
            }  
          ?> 
          </tbody>
        </table>           
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
    
function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
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
 
$(".edit").click(function() {
    var userId=$(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".userId")     // Gets a descendent with class="nr"
                       .text();         // Retrieves the text within <td>
    
     var name=$(this).closest("tr").find(".name").text();
     var email=$(this).closest("tr").find(".email").text();     
     var password=$(this).closest("tr").find(".password").text();
     var type=$(this).closest("tr").find(".type").text();    
    
     document.getElementById('eUserId').value=userId;
     document.getElementById('eName').value=name;
     document.getElementById('eEmail').value=email;
     document.getElementById('ePassword').value=password;
     document.getElementById('eType').value=type;
});
 </script> 
</body>