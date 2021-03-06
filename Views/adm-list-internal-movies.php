<!DOCTYPE html>
<?php
include("validate-session.php");
include('header.php');
include('nav-guest.php');
?>
<html>

<body>
  <div class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-2">Internal Movies</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php if ($message != NULL) { ?>
            <div class="alert alert-info" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
              <h4 class="alert-heading"><?php echo $message; ?></h4>
            </div>
          <?php } ?>

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Poster</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th style="text-align: center">-</th>
                </tr>
              </thead>
              <tbody>
                <?php $id = 0;
                foreach ($movieList as $movie) {
                  $id++ ?>
                  <tr>
                    <th style="vertical-align: middle"><?php echo $id; ?></th>
                    <td style="vertical-align: middle">
                      <center> <img src="<?php echo $movie->getImage(); ?>" alt="Malefica Poster" height="300" width="200"> </center>
                    </td>
                    <td style="vertical-align: middle"><?php echo $movie->getTitle(); ?></td>
                    <td style="vertical-align: middle"><?php echo $movie->getDescription(); ?></td>
                    <form action="<?php echo FRONT_ROOT . "Movie/Remove" ?>" method="">
                      <td style="text-align: center; vertical-align: middle"><button type="submit" name="id" class="btn btn-danger" value="<?php echo $movie->getId() ?>"> Delete </button>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>