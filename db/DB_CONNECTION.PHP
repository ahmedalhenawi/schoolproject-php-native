<?PHP


$connection = mysqli_connect(
    'localhost',
    'root',
    '',
    'school',
);

if (!$connection){
    die('error'.mysqli_connect_error() );

}


?>