
<?php 
 require('../db/databaseTable.php');
 ?>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary" >
  <a class="navbar-brand" href="#"><img src="../logo/logo.jpg" id="logo" style="width: 30%;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- for category section -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         	Category
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
           <?php 
          
            require('../db/database.php');
            $statement= new DatabaseTable($pdo, 'categories');//new database table for statements.
            $statements =$statement->searchAll();
            foreach ($statements as $row)
            {
            echo '  <a class="dropdown-item" href="category.php?id='.$row['category_id'].'">'.$row['category'].'</a>';
            }
            ?>
        </div>
      </li>
      <!-- for classification section -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Classification
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
          <?php 
           
            require('../db/database.php');
            $statement= new DatabaseTable($pdo, 'classification');//new database table for statements.
            $statements =$statement->searchAll();
            foreach ($statements as $row)
            {
            echo'  <a class="dropdown-item" href="classification.php?id='.$row['classification_id'].'">'.$row['classification'].'</a>';
            }
            ?>
        </div>
      </li>
<!-- for login and apply form section -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../layouts/login.php">Admin Login</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../layouts/applied.php">Applicatoin Form</a>

        </div>
      </li>
     
    </ul>

    <form class="form-inline my-2 my-lg-0">
         <input class="form-control" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
       <div class="dropdown-menu" id="back_result" style=""></div>     
      <a href="search.php" class="btn btn-outline-light my-2 my-sm-0" >Search</a>

    </form>
  </div>

</nav>
    
  <style>

  	.navbar:hover {box-shadow: 1px 4px 3px lightgrey}
  	#logo:hover  {box-shadow: 1px 4px 4px lightgrey}

    #back_result{
      margin-left: 74%;
      width: 20%;
      height: 300px;
      overflow-y: scroll;
    }

    @media (max-width: 800%){
      #back_result{
        margin-left: 2%;
        width: 30%;
        height: 200px;

      }
    }
  </style>



   <script>
    $(document).ready(function(){
    
      // TO SEARCH live
      $('#search').keyup(function(){
        var name = $(this).val();
          // alert("hello");
        $.ajax({
        url: "../Include/searchs.php",
        method: "POST",
        data: {name:name},
        success:function(data){
          // alert(data);
            $('#back_result').html(data);
            $('#back_result').css({'display':'block'});
         
          
          }
        })        
      });

 });
 </script>
