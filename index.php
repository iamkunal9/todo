<?php
$name = $_POST["nname"];
$todo = $_POST["todo"];

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "data";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$time = date("Y-m-d",time());
// Check connection
if(isset($name) && isset($todo)){
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO tododata VALUES('{$name}', '{$todo}', '{$time}')";
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();	
}
?>
<html>
<head>
<title>To DO</title>
<style>
.container {
    position: fixed;
    left: 350px;
    padding: 0;
    margin: 0;
}

.left-element {
    display: inline-block;
    float: left;
}

.right-element {
  width: 250px;
  height: 170px;
  border: 5px solid black;
  padding: 50px;
  margin: 20px;
  display: inline-block;
  float: left;
}

</style>
</head>
<body>
<div class="container">
<div class="left-element">
<form action="/index.php" method="POST">
<p>enter your name</p>
<input type="text" id="name" name="nname" placeholder="Enter your name">
<p id="kunal">Todo:-</p>
<input type="text" id="todo" name="todo" placeholder="Enter todo">
<input type="Submit" name="Submit" value="Submit">
</div>
<div class="right-element">
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "data";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT name, todo, time FROM tododata";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $out = "[{$row["name"]}]~".$row["todo"]." --{$row["time"]}". "<br>";
    //echo htmlspecialchars($out); secured
    //unsecured 
    echo $out;
    
  }
} else {
}
$conn->close();
?>
</div>
</div>
</body>
</html>


