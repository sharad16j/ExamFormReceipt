<?php
    $var = $_POST['roll'];
    require "connection.php";
        session_start();
        $fetch=mysqli_query($connection,"select * from std_detail where std_rollno='$var' ");
        $fetch1=mysqli_query($connection,"select * from std_detail where std_rollno='$var' ");
        if(mysqli_fetch_assoc($fetch1))
        {
            while($res=mysqli_fetch_assoc($fetch))
            {
                echo '<script>alert("Data found")</script>';
                echo '<button disabled=true; id="ajax_button" class="btn btn3">Get details <i class="fas fa-align-left"></i></button>';
            }
        }
        else
        {
            echo '<h6 style="color: red;">Data not found</h6>';
        }
?>