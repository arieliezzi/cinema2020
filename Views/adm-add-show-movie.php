<?php
include("validate-session.php");
include('header.php');
include('nav-guest.php');
?>

<div class="py-5 text-center" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">
      <div class="mx-auto col-md-6 col-10 bg-white p-5">
        <h1 class="mb-4">Add Show<br></h1>
        <div class="card">
          <div class="card-body">
            <h4 class="mb-4">Select Movie<br></h1>
              <?php if ($message != NULL) { ?>
                <div class="alert alert-info" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                  <h4 class="alert-heading"><?php echo $message; ?></h4>
                </div>
              <?php } ?>
              <form action="<?php echo FRONT_ROOT ?>Show/showAddViewScheduleSelect" method="post">
                <div class="form-group"> <input type="hidden" class="form-control" name="idCinema" id="idCinema" value=<?php echo $idCinema ?>> </div>
                <div class="form-group"> <input type="hidden" class="form-control" name="idRoom" id="idRoom" value=<?php echo $idRoom ?>> </div>

                <div class="form-group">
                  <select class="form-control" id="idMovie" name="rooms">
                    <?php foreach ($movieList as $movie) { ?>
                      <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                    <?php } ?>
                  </select>
                </div>

                <button type="submit" class="btn btn-success">Next ><br></button>
              </form>
              <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>