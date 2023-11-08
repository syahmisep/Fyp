<?php
include_once 'config.php';
$sql = "DELETE FROM data_intern WHERE NUM='" . $_GET["id"] . "'";
if (mysqli_query($conn2, $sql)) {
echo "Record deleted successfully";
?>
<script>
alert("Company deleted");
window.location.href = "recommend_admin.php";

</script>
<?php
// header("Location:recommend_admin.php");
} else {
echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>