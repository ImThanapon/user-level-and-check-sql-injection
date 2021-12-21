<?php
require_once('../dbconnect.php');

$id = $_SESSION['id'];
if (empty($id)) {
    header('Location:login.php');
}
if ($_SESSION['level'] !== 'admin') {
    echo "<script type='text/javascript'>alert('You have no permission to access this page');
    window.location.href='index.php';</script>";
}
$sql = "SELECT * FROM users_info WHERE id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


$sqlp = "SELECT * FROM user_role  ";
$resultp = mysqli_query($con, $sqlp);

$order = 1;

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php
    if (isset($_POST['but_update'])) { //ถ้ามีการกดปุ่ม savedata
        if (isset($_POST['update'])) { //ถ้ามีการกด checkbox[]
            foreach ($_POST['update'] as $updateid) { //รันค่า id ที่เลือกมาจาก checkbox[] ของแต่ละตัว 

                $role = implode(",", $_POST['role']); //แยกค่าข้อมูลที่อยู่ใน array ของ role 

                $update = "UPDATE user_role SET 
                        role='" . $role . "'
                    WHERE id=" . $updateid;
                mysqli_query($con, $update);
                header('location:control.php');
            }
        }
    }

    ?>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-lightblue navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <!-- Message Start -->
                        <!-- Message End -->
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light" style="margin-left: 20px; text-transform: uppercase;"><?php echo $row['level']; ?> Managment</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../img/<?php echo $row['img']; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h5 style="color:white; margin-left: 10px;"><?php echo $row['username']; ?></h5>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php
                        while ($rowp = mysqli_fetch_assoc($resultp)) {
                            $idp = $rowp['id'];
                            if ($_SESSION['level'] == 'admin') {
                                $role = explode(",", $rowp['role']); //array
                                $result_array = array_search("admin$idp", $role); //array
                                if ($result_array !== false) {
                                    echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                <i class='$rowp[icon]'></i>
                <p>
                $rowp[page]
                </p>
                </a>
              </li> ";
                                }
                            }
                            if ($_SESSION['level'] == 'member') {
                                $role = explode(",", $rowp['role']); //array
                                $result_array = array_search("member$idp", $role); //array
                                if ($result_array !== false) {
                                    echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                  <i class='$rowp[icon]'></i>
                  <p>
                  $rowp[page]
                  </p>
                  </a>
                </li> ";
                                }
                            }
                            if ($_SESSION['level'] == 'employee') {
                                $role = explode(",", $rowp['role']); //array
                                $result_array = array_search("employee$idp", $role); //array
                                if ($result_array !== false) {
                                    echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                <i class='$rowp[icon]'></i>
                <p>
                $rowp[page]
                </p>
                </a>
              </li> ";
                                }
                            }
                        }

                        ?>


                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="text-transform: uppercase">Control Setting</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="control.php" style="text-transform: uppercase">Control Setting</a></li>
                                <li class="breadcrumb-item active" style="text-transform: uppercase">Control Setting</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="offset-1 col-10">
                            <form action="" method="post">
                                <div class="card card-dark">
                                    <div class=" card-header">
                                        <h3 class="card-title ">Setting Roles</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover text-md-center">
                                            <thead>
                                                <tr>
                                                    <th><input type='checkbox' id='checkAll'> CheckAll</th>
                                                    <th>No</th>
                                                    <th>Page</th>
                                                    <th>Admin</th>
                                                    <th>Employee</th>
                                                    <th>Member</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div class="form-group">
                                                    <?php
                                                    $sqlc = "SELECT * FROM user_role ";
                                                    $resultc = mysqli_query($con, $sqlc);
                                                    while ($rowc = mysqli_fetch_assoc($resultc)) {
                                                        $idr = $rowc['id'];
                                                        $role_arr = array("admin$idr", "employee$idr", "member$idr");
                                                    ?>

                                                        <tr>
                                                            <td><input type='checkbox' name='update[]' value='<?= $idr ?>'></td>
                                                            <td><?php echo $order++; ?></td>
                                                            <td><label for="page"><?php echo $rowc['page']; ?></label></td>
                                                            <?php
                                                            $role = explode(",", $rowc['role']); //array
                                                            foreach ($role_arr as $value) {
                                                                if (in_array($value, $role)) {
                                                                    echo " <td><input  type='checkbox' name='role[]' value='$value' checked></td>";
                                                                    echo " <input type='hidden' name='role[]' value='0'>";
                                                                } else {
                                                                    echo " <td><input  type='checkbox' name='role[]' value='$value' ></td>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php  } ?>
                                                </div>
                                            </tbody>
                                            <input type="submit" name="but_update" class="btn btn-warning mb-3 d-block" value="Save Data">
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            </section>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->


        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap4.min.js"></script>
        <script src="../js/dataTables.responsive.min.js"></script>
        <script src="../js/responsive.bootstrap4.min.js"></script>
        <script src="../js/dataTables.buttons.min.js"></script>
        <script src="../js/buttons.bootstrap4.min.js"></script>
        <script src="../js/buttons.html5.min.js"></script>
        <script src="../js/buttons.print.min.js"></script>
        <script src="../js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../js/demo.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <script>
            $(document).ready(function() {

                // Check/Uncheck ALl
                $('#checkAll').change(function() {
                    if ($(this).is(':checked')) {
                        $('input[name="update[]"]').prop('checked', true);
                    } else {
                        $('input[name="update[]"]').each(function() {
                            $(this).prop('checked', false);
                        });
                    }
                });

                // Checkbox click
                $('input[name="update[]"]').click(function() {
                    var total_checkboxes = $('input[name="update[]"]').length;
                    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

                    if (total_checkboxes_checked == total_checkboxes) {
                        $('#checkAll').prop('checked', true);
                    } else {
                        $('#checkAll').prop('checked', false);
                    }
                });
            });
        </script>
</body>

</html>