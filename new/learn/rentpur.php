<?php
session_start();
$con=mysqli_connect("localhost","root","","users");
 if(mysqli_connect_error())
{
    echo "<script>
            alert('cannot connect to database');
           window.location.href='myrent.php';
            </script>";
            exit();
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['purch']))
    {
        $query1="INSERT INTO `rent_list`( `Nm`, `ph`, `ad`) VALUES ('$_POST[Name]','$_POST[Phone_no]','$_POST[Address]')";
        if(mysqli_query($con,$query1))
        {
          $ords_id=mysqli_insert_id($con);
          $query2="INSERT INTO `user_rent`(`ords_id`, `Item_Name`, `price`, `Quantity`) VALUES (?,?,?,?)";
           $stmt=mysqli_prepare($con,$query2);
           if($stmt)
           {
            mysqli_stmt_bind_param($stmt,"isii",$ords_id,$Item_Name,$price,$Quantity);
            foreach($_SESSION['cart'] as $key => $values)
            {
                $Item_Name=$values['Item_Name'];
                $price=$values['price'];
                $Quantity=$values['Quantity'];
                mysqli_stmt_execute($stmt);
            }
            unset($_SESSION['cart']);
            echo "<script>
            alert('order placed');
            window.location.href='rentde.php';
          </script>";
           }
           else
           {
            echo "<script>
            alert('sql error');
            window.location.href='myrent.php';
          </script>";
           }
        }
        else{
            echo "<script>
            alert('sql error');
            window.location.href='myrent.php';
          </script>";
        }
    }   
} 
?>