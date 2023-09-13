<?php

function redirect($location){


    header("Location:" . $location);
    exit;

}

function randToken($n) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

function empCount() {
    global $connection;
    $query = "SELECT * FROM users ORDER BY id DESC";
    $select_users = mysqli_query($connection,$query); 
    $count = mysqli_num_rows($select_users);
  
    return $count;

}
function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['usertype'])){

        return true;


    }


   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }
}





function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));

}



function set_message($msg){

if(!$msg) {

$_SESSION['message']= $msg;

} else {

$msg = "";

    }
}


function display_message() {

    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}




function users_online() {



    if(isset($_GET['onlineusers'])) {

    global $connection;

    if(!$connection) {

        session_start();

        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


            }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


    }






    } // get request isset()


}

users_online();








function insert_categories(){
    
    global $connection;

        if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
        
             echo "This Field should not be empty";
    
    } else {





    $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");

    mysqli_stmt_bind_param($stmt, 's', $cat_title);

    mysqli_stmt_execute($stmt);


        if(!$stmt) {
        die('QUERY FAILED'. mysqli_error($connection));
        
                  }


        
             }

             
    mysqli_stmt_close($stmt);
   
        
       }

}





function deleteCategories(){
global $connection;

    if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: categories.php");


    }
}



function UnApprove() {
global $connection;
if(isset($_GET['unapprove'])){
    
    $the_comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");  
    }
}

//working start


function farmer_view($aadhar){
    global $connection;

    $query = "SELECT name FROM farmers WHERE aadhar = '$aadhar' ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result ;
}



function farmer_exists($aadhar){
    global $connection;

    $query = "SELECT name FROM farmers WHERE aadhar = '$aadhar'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function farmer_data(){
    global $connection;

    $query = "SELECT * FROM material WHERE paymentstatus = 'unpaid' ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}


//Use by




function user_exists($email){
    global $connection;

    $query = "SELECT name FROM team WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function confirmQuery($result) {
    
    global $connection;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($connection));
          
      }
}

function role($email) {

    global $connection; 

    $query = "SELECT role FROM team WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);

    return $row['role'];
}


function UpdatePass($email,$password){
    global $connection;
    $result = mysqli_query($connection, "UPDATE team SET pass = '$password' WHERE email = '$email'");
    confirmQuery($result);

    return true;

}


function team_count(){
    global $connection;

    $query = "SELECT name FROM team";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result) ;
}

function sub_count(){
    global $connection;

    $query = "SELECT subject FROM subject";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result) ;
}

function course_count(){
    global $connection;

    $query = "SELECT name FROM courses";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result) ;
}

function course_viewid($id){
    global $connection;

    $query = "SELECT name FROM courses WHERE course_id = '$id'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_fetch_array($result) ;
}

function sem_count(){
    global $connection;

    $query = "SELECT name FROM semester";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result) ;
}

function semester_count($id){
    global $connection;

    $query = "SELECT name FROM semester WHERE course_id = '$id'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_num_rows($result) ;
}

function registerHash($email){
    global $connection;
    $token = randToken(30);

    $query = "SELECT email FROM passgenerator WHERE token = '$token'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        registerHash($email);

    } else {

    
    $query = "INSERT INTO passgenerator ( email, token) ";
    $query .= "VALUES('{$email}', '{$token}' )";
    $register_hash_query = mysqli_query($connection, $query);

    confirmQuery($register_hash_query);
    }
    return $token;
}

function deleteToken($token){
    global $connection;
 
    $query = "DELETE FROM passgenerator WHERE token = {$token} ";
    $delete_query = mysqli_query($connection,$query);
}

function register_team($name, $email, $role){

    global $connection;

        $name = mysqli_real_escape_string($connection, $name);
        $email    = mysqli_real_escape_string($connection, $email);
        $role = mysqli_real_escape_string($connection, $role);
            
            
        $query = "INSERT INTO team (name, email, role) ";
        $query .= "VALUES('{$name}','{$email}', '{$role}')";
        $register_user_query = mysqli_query($connection, $query);

        confirmQuery($register_user_query);
}

function course_create($name,$user){

    global $connection;            
        $query = "INSERT INTO courses (name,user) ";
        $query .= "VALUES('{$name}','{$user}' )";
        $register_course_query = mysqli_query($connection, $query);

        confirmQuery($register_course_query);
}

function course_update($name,$id,$user){

    global $connection;            
        $query = "UPDATE courses SET name = '$name', user = '$user' WHERE course_id = $id";
        $update_course_query = mysqli_query($connection, $query);

        confirmQuery($update_course_query);
}

function village_delete($id){

    global $connection;            
    $query = "DELETE FROM village WHERE id = {$id} ";
    $delete_query = mysqli_query($connection,$query);


    confirmQuery($delete_query);
}

function course_view(){

    global $connection;

        $query = "SELECT * FROM courses ORDER BY course_id DESC";
        $view_course_query = mysqli_query($connection, $query);

        confirmQuery($view_course_query);
        
        return $view_course_query;
}

function sem_view(){

    global $connection;

        $query = "SELECT * FROM semester";
        $view_sem_query = mysqli_query($connection, $query);

        confirmQuery($view_sem_query);
        
        return $view_sem_query;
}

function sem_create($name,$cid,$user){

    global $connection;            
        $query = "INSERT INTO semester (name,course_id,user_id) ";
        $query .= "VALUES('{$name}','{$cid}','{$user}' )";
        $register_sem_query = mysqli_query($connection, $query);

        confirmQuery($register_sem_query);
}

function login_user($email, $password)
{
     global $connection;

     $email = trim($email);
     $password = trim($password);

     $username = mysqli_real_escape_string($connection, $email);
     $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM team WHERE email = '{$email}' ";
     $select_user_query = mysqli_query($connection, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));
     }
     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_email = $row['email'];
         $db_name = $row['name'];
         $db_user_role = $row['role'];
         $db_user_password = $row['pass'];


         if (password_verify($password,$db_user_password)) {

             $_SESSION['email'] = $db_email;
             $_SESSION['name'] = $db_name;
             $_SESSION['role'] = $db_user_role;

             redirect("/backend");
         } else {
             return false;
         }
     }
     return true;
}