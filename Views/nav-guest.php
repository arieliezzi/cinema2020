<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container"> 
    <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar12"> 
      <a class="navbar-brand d-none d-md-block" href="<?php echo FRONT_ROOT ?>Home/index">
        <i class="fa d-inline fa-lg fa-circle"></i>
        <b>MoviePass</b>
      </a>
      <ul class="navbar-nav mx-auto">
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item"> <a class="nav-link text-primary" href="<?php echo FRONT_ROOT ?>Cinema/showAddView">Add Cinema</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/showListView">List Cinema</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Api/showListView">API Movies</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/showListView">Internal Movies</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/showListView">Shows</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Api/showUserListView">User Screening</a> </li>

 
      </ul>
    </div>
  </div>
</nav>