<?php
session_start();
$con=mysqli_connect("localhost","root","","users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
    <title>Order Details</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="/new/login/welcome.php">Home</a>
        </li>
      </ul>
   <div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="index.php">Product List</a>
        </li>
      </ul>
   <div>
     <?php
      $count=0;
      if(isset($_SESSION['cart']))
      {
        $count=count($_SESSION['cart']);
      }
      ?>
       <a href="mycart.php" class="btn btn-outline-success"> My Cart <?php echo $count; ?></a>
   </div> 
    </div>
  </div>
</nav>
    <div class="header">
        <h2>Order Details</h2>
       <form action="/login/logout.php" method="POST";>
       <button type= "submit" name="logout">Logout </button>
      </form>
    
    <?php     
    if(isset($_POST['logout']))
    {
        session_destroy();
        header("location=: index.php");
    }
    ?>
    </div>
    <div class="conatiner mt-5">
        <div class="row">
            <div col-lg-12>

            <table class="table table-dark">
  <thead>
  <tr >
     
      <th scope="col">Order Id</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Phone NO</th>
      <th scope="col">Address</th>
      <th scope="col">Orders</th>
      <th> </th>
    </tr>
  </thead>
 
  <tbody>

        <?php 
       $query="SELECT * FROM order_list where ord_id=(SELECT max(ord_id) from order_list )  ";

       $users=mysqli_query($con,$query);
       $seen=mysqli_fetch_assoc($users);
       while($seen)
       {
          echo "
          <tr>
          <td>$seen[ord_id] </td>
          <td>$seen[Name] </td>
          <td>$seen[Phone_no] </td>
          <td>$seen[Address] </td>
          <td>
            <table class='table text-centre table-dark'>
          <thead>
            <tr >
             
              <th scope='col'>Item_name</th>
              <th scope='col'>Price</th>
              <th scope='col'>Quantity</th>
              </tr>
           </thead>
         <tbody>
          ";
          $order_query="SELECT * FROM user_orders WHERE ords_id=$seen[ord_id]";
          $order_result=mysqli_query($con,$order_query);
          while($seen=mysqli_fetch_assoc($order_result))
          {
              echo "
              <tr>
                 <td>$seen[Item_Name]</td>
                 <td>$seen[price]</td>
                 <td>$seen[Quantity]</td>
                 </tr>
                 ";
          }
         echo"
                </tbody>
             </table>
             </td>
        </tr>
            ";

      }
      ?>  
  </tbody>
</table>
            </div>
        </div>
    </div>
</body>
</html>