<?php 
    ob_start();
?>


<!DOCTYPE html>
<html lang="en">

<?php 
    $title = "Individual Post";
    $page = "posts";
    session_start();
    include_once("includes/header.php");
    include_once("includes/db.php");
    include_once("admin/functions.php");
?>
<body>

    <!-- Navigation -->
    <?php 
        include_once("includes/navigation.php");
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

               <?php 
                    if(isset($_GET['p_id'] ) ) {
                        $post_id = $_GET['p_id'];
                        $query = "SELECT * FROM posts, users WHERE posts.post_author = users.user_id AND posts.post_id = $post_id";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['user_firstname'] . " " . $row['user_lastname'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            $post_author_id = $row['post_author'];
                ?>
               
               
                <!-- Title -->
                <div class="post-title">
                <h1><?php echo $post_title?></h1>
                
               <?php 
                    if( isset( $_SESSION['user_id'] ) ){
                        $user_id = $_SESSION['user_id'];
                        if($user_id == $post_author_id){
                ?>
                <a href="admin/posts.php?source=edit_post&p_id=<?php echo $post_id; ?>" class="fa fa-pencil btn btn-warning">Edit Post</a>
                <?php 
                        }
                    }
                ?>
                </div>
                <!-- Author -->
                <p>
                    by <a href="#"><?php echo $post_author?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="<?php echo $post_title?>">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post_content?></p>

                <hr>

           <?php 
                        }//end of while
                    }// end of if
        
           //COMMENTS BELONG HERE
                include_once("comments.php");
           
          ?> 
            </div>

            <?php 
                include_once("includes/sidebar.php");
            ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!--footer-->
        <?php 
            include_once("includes/footer.php");
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>