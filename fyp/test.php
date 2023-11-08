<?php 
include("includes/db.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Recommend </title>
  </head>
  <body>
   
    <div class="container">
        <h1>Recommend Company</h1>

        <form method="GET">
            <div class="row">
                <div class="col">
                    <select class="form-control" name="state">
                        <?php if(!empty($_GET["state"])) { ?>
                        <option value="<?php echo $_GET["state"]; ?>"><?php echo $_GET["state"]; ?></option>
                        <?php } else { ?>
                        <option value="">Choose State</option>
                        <?php } ?>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Putrajaya">Putrajaya</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" name="field">
                        <?php if(!empty($_GET["field"])) { ?>
                        <option value="<?php echo $_GET["field"]; ?>"><?php echo $_GET["field"]; ?></option>
                        <?php } else { ?>
                        <option value="">Pilih Bidang</option>
                        <?php } ?>
                        <?php 
                        $sqlBidang = "SELECT SPECIFIC_FIELD FROM data_intern
                        GROUP BY SPECIFIC_FIELD ORDER BY SPECIFIC_FIELD ASC";
                        $resultBidang = mysqli_query($conn, $sqlBidang);

                        while($row = mysqli_fetch_assoc($resultBidang)) {
                        ?>
                        <option value="<?php echo $row['SPECIFIC_FIELD']; ?>"><?php echo $row['SPECIFIC_FIELD']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="elaun" value="<?php echo !empty($_GET['allowance']) ? $_GET['allowance'] : ''; ?>" placeholder="Allowance">
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php 
        if(isset($_GET["state"]) || isset($_GET["field"]) || isset($_GET["allowance"])) {
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
                    WHERE (STATE = '".$_GET["STATE"]."')
                    OR (SPECIFIC_FIELD = '". $_GET["SPECIFIC_FIELD"] ."')
                    OR (MONTHLY_ALLOWANCE = '". $_GET["MONTHLY_ALLOWANCE"] ."')
                    ORDER BY 
                        CASE STATE
                            WHEN '".$_GET["state"]."' THEN 0 ELSE 1 END,
                        CASE SPECIFIC_FIELD
                            WHEN '".$_GET["field"]."' THEN 0 ELSE 1 END, 
                        CASE MONTHLY_ALLOWANCE
                            WHEN '".$_GET["allowance"]."' THEN 0 ELSE 1 END; 
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
                    <?php } } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Tiada Result</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>                   
        </div>
        <?php } ?>

    </div>

   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>