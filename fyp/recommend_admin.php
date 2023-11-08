<?php 
include("includes/db.php");
include "navbar.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <title>Recommend </title>
  </head>
  <body>
   
    <div class="container">
        <h1>Recommend Company</h1>



        <?php 
        if(isset($_GET["state"]) || isset($_GET["SPECIFIC_FIELD"]) || isset($_GET["MONTHLY_ALLOWANCE"])) {   
        ?>

        <div style="margin-top:50px;">
            <h3 class="text-center">List Company</h3>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company</th>
                        <th scope="col">Adress</th>
                        <th scope="col">State</th>
                        <th scope="col">Allowance</th>
                        <th scope="col">Field</th>
                        <th scope="col">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM data_intern 
                    WHERE (STATE = '".$_GET["state"]."')
                    AND (SPECIFIC_FIELD = '". $_GET["specific_field"] ."')
                    AND (MONTHLY_ALLOWANCE= '". $_GET["MONTHLY_ALLOWANCE"] ."')
                    ORDER BY 
                        CASE STATE
                            WHEN '".$_GET["state"]."' THEN 0 ELSE 1 END,
                        CASE SPECIFIC_FIELD
                            WHEN '".$_GET["specific_field"]."' THEN 0 ELSE 1 END, 
                        CASE MONTHLY_ALLOWANCE
                            WHEN '".$_GET["MONTHLY_ALLOWANCE"]."' THEN 0 ELSE 1 END; 
                    ";

                    $result = mysqli_query($conn, $sql);
            
                    $counter = 1;
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $counter++; ?></th>
                        <td><?php echo $row["COMPANY_NAME"]; ?></td>
                        <td><?php echo $row["COMPANY_ADDRESS"]; ?></td>
                        <td><?php echo $row["STATE"]; ?></td>
                        <td>RM <?php echo $row["MONTHLY_ALLOWANCE"]; ?></td>
                        <td><?php echo $row["SPECIFIC_FIELD"]; ?></td>
                        <td><?php echo $row["COMPANY_CATEGORY"]; ?></td>
                   
                    </tr>
                    
                    <!-- <a href="recommend.php">reset</a> -->
                    <?php } } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">No Result</td>
                        </tr>
                        <!-- <tr><a href="recommend.php">reset</a></tr> -->
                    <?php } ?>
                    <tr><a href="recommend.php">reset</a></tr>
                </tbody>
            </table>                   
        </div>
        <?php } 
        
        else{
        ?>
        <div style="margin-top:50px;">
            <div class="tittle">
            <h3 class="text-center">List Company</h3>
            <h4 class="text-center" >
            <button type="button" class="btn btn-primary"><a href="add_company.php" style="text-decoration:none;color:white;">Add Company</a></button>
            </h4>   
            <!-- <a href="" class="text-center" style="color:black"></a> -->
            </div>
            <table class="table table-hover table-striped" id="sortTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company</th>
                        <th scope="col">Adress</th>
                        <th scope="col">State</th>
                        <th scope="col">Allowance</th>
                        <th scope="col">Field</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM data_intern";

                    // $sql = "SELECT * FROM data_intern WHERE SPECIFIC_FIELD = " . $_GET["specific_field"] ." AND MONTHLY_ALLOWANCE= ". $_GET["MONTHLY_ALLOWANCE"];
                    $result = mysqli_query($conn, $sql);
            
                    $counter = 1;
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $counter++; ?></th>
                        <td><?php echo $row["COMPANY_NAME"]; ?></td>
                        <td><?php echo $row["COMPANY_ADDRESS"]; ?></td>
                        <td><?php echo $row["STATE"]; ?></td>
                        <td>RM <?php echo $row["MONTHLY_ALLOWANCE"]; ?></td>
                        <td><?php echo $row["SPECIFIC_FIELD"]; ?></td>
                        <td><?php echo $row["COMPANY_CATEGORY"]; ?></td>
                        <td><a href="delete.php?id=<?php echo $row["NUM"]; ?>" class="launchConfirm" title='Delete Record'><i class='material-icons'></i></a></td>

                    </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">No Result</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>                   
        </div>
        <?php    
        }
        ?>

    </div>
    <script>
        $('#sortTable').DataTable();

    </script>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>