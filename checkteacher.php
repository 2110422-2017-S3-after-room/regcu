   <?php
   $role = $_SESSION['user_role'];
   if(!isset($_SESSION['user_role']) | $_SESSION['user_role'] != 'staff' ){
      header("Location: login.php");
   }
  ?>