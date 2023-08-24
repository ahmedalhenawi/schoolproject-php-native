<?php
  include_once ('db/DB_CONNECTION.PHP');
  include_once ('check.php');
    $errors = [];
 
    if($type != 'admin'){
        header("location: http://localhost/schoolproject/logout.php") ;
    }
    


   
  
   
        
  
      if (isset($_GET['id'])) {
          $id = $_GET['id'] ;
         $query = "select * from course where course_id = '$id' limit 1" ;     
         $result = mysqli_query($connection , $query);
         if (mysqli_num_rows($result)> 0){
       
          $row = mysqli_fetch_assoc($result) ;
          $id = $row['course_id'] ;
          $name = $row['name'];
          $teacher_id = $row['teacher_id'];
         
       }
      }





  if ($_SERVER["REQUEST_METHOD"] == "POST") {






    $query = "select course_id from course " ;
    $result = mysqli_query($connection , $query);

    $courses_id = [];
    if (mysqli_num_rows($result)> 0){
    
    $action = $_SERVER['PHP_SELF'];
        while($row = mysqli_fetch_assoc($result)){
          
            $courses_id [] = $row['course_id'];

        }
    }


    // validate name "reqired"

    if(!empty($_POST['name'])){
        $name = $_POST['name'] ;
    }else{
       $errors['name'] = "name is reqired please fill it" ;
    }

    // validate id "reqired and not redundant"

    if(!empty($_POST['id']) && !in_array($_POST['id'] , $courses_id )){
        $id = $_POST['id'] ;
    }else{
        $errors['id'] = "id is reqired please fill not redundant id" ;
    }





    if(empty($errors)){

        $teacher_id = $_POST["teacher_id"];

          $query = "insert into course
        ( course_id , name ,teacher_id) values
        ('$id', '$name' , '$teacher_id' )" ;
        
        $result = mysqli_query($connection , $query);
    

        if($result){
            
            $status_add = true ;
        }else { $status_add = false ;}


    }

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
    include_once("partial/sidebar.html")
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add New Teacher</h1>


                    <?php
                if(isset($status_add)){
                    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                               <strong>SUCCESS -</strong> ADD
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                               </button>
                         </div>';

                   }
                
                ?>



                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="mr-1" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" class="form-control" id="id" placeholder="name" name="id"
                                 value="<?php
                                 if (isset($id)){
                                    echo "$id";
                                 }
                                  ?>">
                             
                                                       <?php
                                                          if (!empty($errors['id'])){
                                                              echo "<span class='text-danger'>".$errors['id']."</span>";
                                                          }?>
                               </div>

                               <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="name" name="name"
                                 value="<?php
                                 if (isset($name)){
                                    echo "$name";
                                 }
                                  ?>">
                             
                                                       <?php
                                                          if (!empty($errors['name'])){
                                                              echo "<span class='text-danger'>".$errors['name']."</span>";
                                                          }?>
  
  

                                                          
                            <div class="form-group mt-3 ">
                              <label for="select_teacher">Select Teacher</label>
                                        <select class="custom-select" id="select_teacher" name="teacher_id" required>
                                          <option value="" disabled><strong>Teacher name:</strong></option>
                                          <?php
                                                $t_query ='select id , name from teacher' ;
                                                $t_result = mysqli_query($connection ,$t_query);
                                                if (mysqli_num_rows($t_result)> 0){
                                            while($row = mysqli_fetch_assoc($t_result)){
                                            $t_id = $row['id'];
                                            $teacher_name = $row['name'];

                                            if($t_id == $teacher_id){
                                                echo " <option selected value='$t_id'>$teacher_name</option>";
                                            }else{
                                                echo " <option value='$t_id'>$teacher_name</option>";
                                            }

                                            
                                            } 
                                            
                                                    }
                                                   
                                                ?>
                                        </select>
                            </div>

                            
                            
                              <button type="submit" class="btn btn-primary m-1">ADD</button>
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