<?php
  include_once ('db/DB_CONNECTION.PHP');
  include_once ('check.php');
  if($type != 'teacher'){
    header("location: http://localhost/schoolproject/logout.php") ;
}

    

    $course_id = $_GET['id'];


  if ($_SERVER["REQUEST_METHOD"] == "POST") {







    


    

    // $teacher_id = $_POST["teacher_id"];

    $grade = $_POST["grade"];
    $student_id = $_POST["student_id"];

          $query = "insert into grade
        ( course_id , student_id ,grade) values
        ('$course_id', '$student_id' , '$grade' )" ;
        
        $result = mysqli_query($connection , $query);
    

        if($result){
            
            $status_add = true ;
        }else { $status_add = false ;}


    }

  
  
  


  ?> 

















<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
<?php 
    include_once("partial/sidebar2.html")
?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <!-- End of Topbar -->
                <?php 
    include_once("partial/nav.php")
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="d-flex">
                    <div class="mr-auto p-2"><h1 class="h3 mb-4 text-gray-800">Add Grade <?php  echo $_GET['id'] ?></h1></div>

                </div>


                    <?php
                if(isset($status_add)){
                    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                               <strong>SUCCESS -</strong> ADD Grade
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                               </button>
                         </div>';

                   }
                
                ?>



                    <form action="<?php echo $_SERVER['PHP_SELF']."?id=$course_id" ?>" class="mr-1" method="POST" enctype="multipart/form-data">

                                                          
                            <div class="form-group mt-3 ">
                              <label for="select_student">Select Student</label>
                                        <select class="custom-select" id="select_student" name="student_id" required>
                                          <option value="" disabled><strong>Student name:</strong></option>
                                          <?php
         $s_query ="select id , name from student where id not in (select student_id from grade where course_id = '$course_id');" ;
                                                $s_result = mysqli_query($connection ,$s_query);
                                                if (mysqli_num_rows($s_result)> 0){
                                                  while($row = mysqli_fetch_assoc($s_result)){                                                    
                                                    $s_id = $row['id'];
                                                    $s_name = $row['name'];
                                                    echo" <option value='$s_id'>$s_name</option> ";
                                                  }
                                                    }
                                                ?>
                                        </select>
                            </div>

                            <div class="form-group mt-3 ">
                              <label for="select_student">Select Grade</label>
                                        <select class="custom-select" id="select_student" name="grade" required>
                                          <option value="" disabled><strong>Grade:</strong></option>
                                          <option value="A+">A+</option>
                                          <option value="A" >A</option>
                                          <option value="B+">B+</option>
                                          <option value="B" >B</option>
                                          <option value="C+">C+</option>
                                          <option value="C" >C</option>
                                          </select>
                            </div>


                              <button type="submit" class="btn btn-primary m-1">Save</button>
                              <button type="reset" class="btn btn-danger btn-sm">Clear</button>
                   </form>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>