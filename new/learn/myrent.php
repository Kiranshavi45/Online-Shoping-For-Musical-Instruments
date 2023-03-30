<?php 
include("renthead.php");
 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
             <h1>
                 My Cart
             </h1>
            </div>
  <div class="col-lg-9">
    <table class="table">
 <thead class="text-center">
    <tr>
      <th scope="col">Serial No</th>
      <th scope="col">Item Name</th>
      <th scope="col">Item Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
      <th> </th>
    </tr>
  </thead>
  <tbody class="text-center">
   <?php
    $sr=0;
   if(isset($_SESSION['cart']))
   {
       foreach($_SESSION['cart'] as $key => $value)
        {
            $sr=$sr+1;
       echo"
           <tr>
              
              <td>$sr</td>
              <td>$value[Item_Name]</td>
              <td>$value[price]<input type='hidden' class='iprice' value='$value[price]'></td>
              <td>
              <form action='managerent.php' method='POST'>
                <input class='text-center iquantity' name='mod_quan' onchange='this.form.submit();' type='number' value='$value[Quantity]'min='1' max='10'>
                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>

              </form> 
              </td>
             <td class='itotal' ></td>
              <td>
              <form action='managerent.php' method='POST'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>Remove</button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>
              </td>
              
           </tr>

           
          ";
    }
 
      }

   ?>

  
  </tbody>
</table>
  </div>
    <div class="col-lg-3">
    <div class="border bg-light rounded p-4">
        <h4> Grand Total:</h4>
        <h5 class="text-right" id="gtotal"></h5>
        <?php
          if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
          {
        ?>
         <form action='rentpur.php' method='POST'>
           <div class="form-group">
             <label>Full_Name</label>
             <input type="text" name="Name" class="form-control" required>
           </div>
           <div class="form-group">
             <label>PHONE_NO</label>
             <input type="number" name="Phone_no" class="form-control" required>
           </div>
           <div class="form-group">
             <label>ADDRESS</label>
             <input type="text" name="Address" class="form-control" required>
           </div>
           <br>
           
             <button class="btn btn-primary btn-block"  name="purch" >purchase</button>
         </form> 
         <?php
          }
          ?>
        </div>
    </div>
    <script>
      var gt=0;
      var iprice=document.getElementsByClassName('iprice');
      var iquantity=document.getElementsByClassName('iquantity');
      var itotal=document.getElementsByClassName('itotal');
       var gtotal=document.getElementById('gtotal');
      function subTotal()
        {
          gt=0;
          for(i=0;i<iprice.length;i++)
          {
              itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
              gt=gt+(iprice[i].value)*(iquantity[i].value);

          }
          gtotal.innerText=gt;
        }
        subTotal();
      </script>
         
</body>
</html>