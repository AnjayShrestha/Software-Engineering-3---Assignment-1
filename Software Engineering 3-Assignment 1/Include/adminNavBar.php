<nav class="navbar navbar-expand-lg navbar-light bg-secondary" >
  <a class="navbar-brand" href="#"><img src="../logo/logo.jpg" id="logo" style="width: 30%;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../MAIN/admins.php?admin=adminIndex">Home <span class="sr-only">(current)</span></a>
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
            echo '  <a class="dropdown-item" href="admins.php?admin=category&id='.$row['category_id'].'">'.$row['category'].'</a>';
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
            echo'  <a class="dropdown-item" href="admins.php?admin=classification&id='.$row['classification_id'].'">'.$row['classification'].'</a>';
            }
            ?>
        </div>
      </li>
<!-- for login and apply form section -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../MAIN/admins.php?admin=adminDetails">Admin</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=adminCategory">Category</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=adminClassification">Classification</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=auctions">Auction</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=archived">Archived Auction</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=clients">Clients</a>
          <a class="dropdown-item" href="../MAIN/admins.php?admin=application">Application</a>


          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../Include/logout.php">Logout</a>
        </div>
      </li>
     
    </ul>

    <form class="form-inline my-2 my-lg-0">
     <input class="form-control" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
       <div class="dropdown-menu" id="back_result" style=""></div>    
      <a class="btn btn-outline-light my-2 my-sm-0" href="../admins-template/search-Templates.php">Search</a>
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
        url: "../Include/adminSearchs.php",
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
