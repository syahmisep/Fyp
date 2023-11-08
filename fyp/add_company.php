<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $COMPANY_NAME = $_POST['COMPANY_NAME'];
    $COMPANY_ADDRESS = $_POST['COMPANY_ADDRESS'];
    $POSCODE = $_POST['POSCODE'];
    $CITY = $_POST['CITY'];
    $STATE = $_POST['STATE'];
    $MONTHLY_ALLOWANCE = $_POST['MONTHLY_ALLOWANCE(RM)'];
    $SPECIFIC_FIELD = $_POST['SPECIFIC_FIELD'];
    $COMPANY_CATEGORY = $_POST['COMPANY_CATEGORY'];


    $query = "INSERT into data_intern (COMPANY_NAME, COMPANY_ADDRESS, POSCODE, CITY, STATE, MONTHLY_ALLOWANCE, SPECIFIC_FIELD, COMPANY_CATEGORY) VALUES ($COMPANY_NAME, $COMPANY_ADDRESS, $POSCODE, $CITY, $STATE, $MONTHLY_ALLOWANCE, $SPECIFIC_FIELD, $COMPANY_CATEGORY)";
  
    $result = mysqli_query($conn2, $query);

   if($result){

      echo "New company added";
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Company</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="banner">
   <div class="form-container">

      <form action="" method="post">
         <h3>Add company</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
         <div style="text-align:left"><label for="COMPANY_NAME">Company Name</label></div>
         <input type="text" name="COMPANY_NAME" required placeholder="">

         <div style="text-align:left"><label for="COMPANY_ADDRESS">Company Address</label></div>
         <input type="text" name="COMPANY_ADDRESS" required placeholder="" class="form-control">

         <div style="text-align:left"><label for="POSCODE">Poscode</label></div>
         <input type="number" name="POSCODE" required placeholder="">

         <div style="text-align:left"><label for="CITY">City</label></div>
         <input type="text" name="CITY" required placeholder="">

         <div style="text-align:left"><label for="STATE">state</label></div>
         <input type="text" name="STATE" required placeholder="">

         <div style="text-align:left"><label for="MONTHLY_ALLOWANCE(RM)">Allowance(RM)</label></div>
         <input type="number" name="MONTHLY_ALLOWANCE(RM)" required placeholder="">

         <div style="text-align:left"><label for="SPECIFIC_FIELD">specific field</label></div>
         <input type="text" name="SPECIFIC_FIELD" required placeholder=" ">

         <div style="text-align:left"><label for="COMPANY_CATEGORY">company category</label></div>
         <input type="text" name="COMPANY_CATEGORY" required placeholder=" ">



         <input type="submit" name="submit" value="submit" class="form-btn">
         <!-- <p>don't have an account? <a href="register_form.php">register now</a></p> -->
      </form>

   </div>
</div>

</body>
</html>