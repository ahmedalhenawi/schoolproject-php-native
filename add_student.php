<?php
  include_once ('db/DB_CONNECTION.PHP');
  include_once ('check.php');
    $errors = [];
 
    if($type != 'admin'){
        header("location: http://localhost/schoolproject/logout.php") ;
    }
    



  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // validate name "reqired"

    if(!empty($_POST['name'])){
        $name = $_POST['name'] ;
    }else{
       $errors['name'] = "name is reqired please fill it" ;
    }


    // validate email format 
    if(!empty($_POST['email']) && filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
        $email = $_POST['email'] ;
    }else{
    $errors['email'] = "email is reqired please enter a valid format" ;
    }


    // validate required password and lateast 6 char
    if(!empty($_POST['password']) && strlen($_POST['password'] >= 6)){
        $password = $_POST['password'] ;
        $enc_password = md5($password) ;
    }else{
    $errors['password'] = "enter a password of at least 6 characters" ;
    }


    // validate  to phone number 
    
    if(!empty($_POST['phone']) && filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT)){
        $phone = $_POST['phone'] ;
    }else{
        $errors['phone'] = "please inter valid phone number" ;
    }

    // validate type of image  png + jpg 

    if (!empty($_FILES['img']['name'])){

        $file_name = $_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_ext == "png" || $file_ext == "jpg"){

            $img_new_name = "student_".strval(time()+rand(1,1000)) . ".$file_ext" ;
            $upload_path = 'uploads/' . $img_new_name ;
            // move_uploaded_file($file_tmp, $upload_path);

        }else{
            $errors['img'] = "please inter valid image (png , jpg)" ;
        }
    }else{
        $errors['img'] = "please inter valid image (png , jpg)" ;
    }



    if(empty($errors)){

          $query = "insert into student
        ( name , email ,password , phone , img) values
        ('$name', '$email' , '$password' , '$phone'  , '$img_new_name')" ;
        
        $result = mysqli_query($connection , $query);
          move_uploaded_file($file_tmp, $upload_path);

        if($result){
            
            $status_add = true ;
        }else { $status_add = false ;}


    }

//   $name = $_POST['name'] ;
//   $email = $_POST['email'] ;


//   $password = $_POST['password'] ;
//   $enc_password = md5($password) ;
//   $phone = $_POST['phone'] ;




//   $file_name = $_FILES['img']['name'];    #  img4784-5745sfs.png
//   $file_size = $_FILES[ 'img']['size'];
//   $file_tmp = $_FILES['img']['tmp_name'];
//   $type = $_FILES['img']['type'];
//   $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                         
//   $img_new_name = "student_".strval(time()+rand(1,1000)) . ".$file_ext" ;
//   $upload_path = 'uploads/' . $img_new_name ;
//   move_uploaded_file($file_tmp, $upload_path);

  
// //  var_dump($_POST);


//   if (empty($name)) {
//     $errors['name_error'] = "name is required please fill it";
// }

//   $query = "insert into student
//   ( name , email ,password , phone , img) values
//   ('$name', '$email' , '$enc_password' , '$phone'  , '$img_new_name')" ;
  
//   $result = mysqli_query($connection , $query);
  
//   if($result){
  
//     $status_add = true ;
// }else { $status_add = false ;}

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
                    <div class="d-flex">
                    <div class="mr-auto p-2"><h1 class="h3 mb-4 text-gray-800">Add New Student</h1></div>
                    <div class="p-2"><a href="show_students.php" class=" btn btn-primary mr-4">show all Students</a></div>
                    </div>


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
                               </div>

                               <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" placeholder="aaa@example.com" 
                                value="<?php
                                 if (isset($email)){
                                    echo "$email";
                                 }
                                  ?>"
                                ></input>
                                                       <?php
                                                          if (!empty($errors['email'])){
                                                              echo "<span class='text-danger'>".$errors['email']."</span>";
                                                          }?>
                              </div>

                        
                        <div class="form-group">
                            <label for="user_password">Password:</label>
                            <div class="input-group">

                        <input type="password" name="password" id="user_password" placeholder="Password" class="form-control" data-toggle="password" value="<?php
                                 if (isset($password)){
                                    echo "$password";
                                 }
                                 ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-eye"></i></span>
                             </div>
                                 </div>
                                                          <?php
                                                          if (!empty($errors['password'])){
                                                              echo "<span class='text-danger'>".$errors['password']."</span>";
                                                          }?>
                                     </div>


                                     
                              
                              <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" placeholder="+1(555)000 000" 
                                value="<?php
                                 if (isset($phone)){
                                    echo "$phone";
                                 }
                                 ?>">
                                </input>
                                                        <?php
                                                          if (!empty($errors['phone'])){
                                                              echo "<span class='text-danger'>".$errors['phone']."</span>";
                                                          }?>
                              </div>


                              <label for="file">upload image</label>
                              <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="img" id="validatedCustomFile" >
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                        <?php
                                                          if (!empty($errors['img'])){
                                                              echo "<span class='text-danger'>".$errors['img']."</span>";
                                                          }?>
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