

        <nav class="navbar navbar-expand-lg bg-body-secondary" >
          <div class="container-fluid">
            <a class="navbar-brand" href="displaycake.php"> Cake List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <span class="menuSpan"><a class="menuAnchor btn btn-outline-secondary btn-sm" href="cakesearch.php" style="margin-top: 10px;"><i class="fa-solid fa-magnifying-glass"></i>Cake Search</a></span>
                </li>
                <li class="nav-item">
                <span class="menuSpan"><a class="menuAnchor btn btn-outline-secondary btn-sm" href="index.php"  style="margin-top: 10px;"><i class="fa-solid fa-pencil"></i> &nbsp; Blog page</a>
                </li>
                <li class="nav-item">
               <span class="menuSpan"><a class="menuAnchor btn btn-outline-secondary btn-sm" href="subscribe.php" style="margin-top: 10px;"><i class="fa-solid fa-file-pen"></i> &nbsp; Subscribe</a></span>
                </li>
               
 
       <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<span class="menuSpan"><a class="menuAnchor btn btn-outline-secondary btn-sm" href="addcake.php" style="margin-top: 5px;"><i class="fa-solid fa-cake-candles"> </i>&nbsp; Add Cake</a></span>';
           echo '<span class="menuSpan"><a class="menuAnchor btn btn-outline-secondary btn-sm" href="admin.php" style="margin-top: 5px;"><i class="fa-solid fa-table-list"></i> &nbsp; Add Blog Post</a></span>';
            echo '<span class="menuSpan"><a class="menuAnchor btn btn-outline-warning btn-sm" id="loginButton" href="logout.php" style="margin-top: 5px;">
            <i class="fa-solid fa-right-to-bracket fa-rotate-180"></i>&nbsp; Logout
                </a></span>';

      }else {
        echo '<span class="menuSpan"><a class="menuAnchor btn btn-outline-success btn-sm" id="loginButton" href="login.php" style="margin-left: 25rem;margin-top: 5px;">
        <i class="fa-solid fa-right-to-bracket" ></i> &nbsp; Login
            </a></span>';
      }
    ?>
    </nav>
    </div>
    </div>
    <br/>