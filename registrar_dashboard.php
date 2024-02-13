<?php
 $server = "localhost";
 $username = "root";
 $password = "";
 $dbname = "graduation";
 
 //create connection
 $conn = new mysqli($server,$username,$password,$dbname);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <title>MajorAdvisor</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<img id="logo" src="./assets/css/images/bara-logo-a.png" alt="bara-logo-a">
<button style="margin-left: 20px; margin-top: 150px; border-radius: 5px; float:right; margin-right:20px;"><a href="index.php" style="text-decoration: none; color:#061f3a font-weight:700;">LOG OUT</a></button>
<h3 align="center"> REGISTAR APPROVAL DASHBOARD</h3>
<div class="container table-responsive-md"><br><br><br>
  <div>
        <h4>Student Application Data</h4>
        <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="table-success">
      <th scope="col">Date</th>
      <th scope="col">Studen Name</th>
      <th scope="col">Student ID</th>
      <th scope="col">Degree</th>
      <th scope="col">Bulletin</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $sql = "Select * from `graduation_data`";
  $result= mysqli_query($conn,$sql);

  if($result){
    while($row=mysqli_fetch_assoc($result)) {
        $date = $row['date']; 
        $fullname = $row['fullname'];
        $student_id = $row['student_id'];
        $degree = $row['degree'];
        $bulletin = $row['bulletin'];
        echo '
        <tr>
        <th scope="row">'.$date.'</th>
        <td>'.$fullname.'</td>
        <td>'.$student_id.'</td>
        <td>'.$degree.'</td>
        <td>'.$bulletin.'</td>
       <td>
        <form method="POST" action="r_accept.php">
            <input type="hidden" name="student_id" value="' . $student_id . '">
            <button type="submit" class="btn btn-success" name="accept">Accept</button>
        </form>
    </td>
    <td>
        <form method="POST" action="r_decline.php">
            <input type="hidden" name="student_id" value="' . $student_id . '">
            <button type="submit" class="btn btn-danger" name="decline">Decline</button>
        </form>
    </td>
      </tr>
            '
            ;
    }
  }
  ?> 
</tbody>
</table>
</div>
<br><br><br>
<div>
        <h4>First Semester Courses</h4>
        <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="table-success">
      <th scope="col">course</th>
      <th scope="col">number</th>
      <th scope="col">Title</th>
      <th scope="col">Sem_Crs</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $sql = "Select * from `first_sem`";
  $result= mysqli_query($conn,$sql);

  if($result){
    while($row=mysqli_fetch_assoc($result)) {
        $course = $row['course']; 
        $number = $row['number'];
        $title = $row['title'];
        $sem_crs = $row['sem_crs'];
        echo '
        <tr>
        <th scope="row">'.$course.'</th>
        <td>'.$number.'</td>
        <td>'.$title.'</td>
        <td>'.$sem_crs.'</td>
      </tr>
            '
            ;
    }
  }
  ?> 
<t/body>
</table>
</div>
<br><br><br>
<div>
        <h4>Second Semester Courses</h4>
        <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="table-success">
      <th scope="col">course</th>
      <th scope="col">number</th>
      <th scope="col">Title</th>
      <th scope="col">Sem_Crs</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $sql = "Select * from `second_sem`";
  $result= mysqli_query($conn,$sql);

  if($result){
    while($row=mysqli_fetch_assoc($result)) {
        $course = $row['course']; 
        $number = $row['number'];
        $title = $row['title'];
        $sem_crs = $row['sem_crs'];
        echo '
        <tr>
        <th scope="row">'.$course.'</th>
        <td>'.$number.'</td>
        <td>'.$title.'</td>
        <td>'.$sem_crs.'</td>
      </tr>
            '
            ;
    }
  }
  ?> 
<t/body>
</table>
</div>
<br><br><br>
<div>
        <h4>Inter Semester Courses</h4>
        <table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="table-success">
      <th scope="col">course</th>
      <th scope="col">number</th>
      <th scope="col">Title</th>
      <th scope="col">Sem_Crs</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $sql = "Select * from `inter_sem`";
  $result= mysqli_query($conn,$sql);

  if($result){
    while($row=mysqli_fetch_assoc($result)) {
        $course = $row['course']; 
        $number = $row['number'];
        $title = $row['title'];
        $sem_crs = $row['sem_crs'];
        echo '
        <tr>
        <th scope="row">'.$course.'</th>
        <td>'.$number.'</td>
        <td>'.$title.'</td>
        <td>'.$sem_crs.'</td>
      </tr>
            '
            ;
    }
  }
  ?> 
<t/body>
</table>
</div>
</div>

  <script src="js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- <button style="margin-left: 500px; margin-top: 360px; border-radius: 5px;"><a href="index.php" style="color: black; text-decoration: none;">LOG OUT</a></button> -->
</body>
</html>