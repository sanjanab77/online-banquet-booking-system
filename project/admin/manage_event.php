<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid']==0)) {
  header('location:logout.php');
  } else{

// Code for deleting product from cart
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tbleventtype where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage_event.php'</script>";     


}

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include '../components/admin_header.php'; ?>
    <!-- header section ends -->

    <!-- register section starts  -->

    <div class="content">
        <h2 class="heading"><span>Manage </span> Event-Type</h2>



        <!-- Dynamic Table Full Pagination -->
        <div class="block">
            
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">S.NO</th>
                            <th style="width: 15%;">Event Name</th>
                            <th style="width: 15%;">Creation Date</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Creation Date</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$sql="SELECT * from tbleventtype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        <tr>
                            <td class="text-center" style="width: 10%;"><?php echo htmlentities($cnt);?></td>
                            <td class="font-w600" style="width: 15%;"><?php  echo htmlentities($row->EventType);?></td>
                            <td class="d-none d-sm-table-cell" style="width: 15%;"><?php  echo htmlentities($row->CreationDate);?>
                            </td>
                            <td class="d-none d-sm-table-cell" style="width: 15%;">
                                <span class="badge badge-primary"><?php  echo htmlentities($row->CreationDate);?></span>
                            </td>
                            <td class="d-none d-sm-table-cell" style="width: 15%;"><a
                                    href="manage_event.php?delid=<?php echo ($row->ID);?>"
                                    onclick="return confirm('Do you really want to Delete ?');"><i
                                        class="fa fa-trash fa-delete" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php $cnt=$cnt+1;}} ?>



                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->

        <!-- END Dynamic Table Simple -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/message.php'; ?>

</body>

</html>
<?php }  ?>