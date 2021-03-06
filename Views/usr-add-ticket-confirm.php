<?php
include("validate-session.php");
include('header.php');
include('nav-guest.php');
?>

<div class="py-5" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <?php if ($message != NULL) { ?>
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading"><?php echo $message; ?></h4>
          </div>
        <?php } ?>
      </div>

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 mb-5">
        <div class="card">
          <div class="card-body">
            <img class="card-img-top" src="<?php echo $show->GetMovie()->getImage(); ?>" alt="Card image cap">
          </div>
        </div>
      </div>
      <!-- Final de la tarjeta -->

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 mb-5">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $show->getMovie()->getTitle() ?></h5>
            <p class="card-text"><?php echo $show->getMovie()->getDescription() ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Cinema:</strong> <?php echo $show->getCinema()->getName(); ?> </li>
            <li class="list-group-item"><strong>Room:</strong> <?php echo $show->getRoom()->getName(); ?> </li>
            <li class="list-group-item"><strong>Hour:</strong> <?php echo date('H:m', strtotime($show->getStartTime())) ?> </li>
            <li class="list-group-item"><strong>Duration:</strong> <?php echo $show->getDuration() . " min" ?> </li>
            <li class="list-group-item"><strong>Price: </strong> <?php echo "$" . $show->getRoom()->getPrice() . " p/ticket" ?> </li>
          </ul>
        </div>
      </div>
      <!-- Final de la tarjeta -->

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 col-10 bg-white">
        <div class="card">
          <div class="card-body text-center">
            <h1 class="mb-4">Purchase Tickets<br></h1>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Date:</strong> <?php echo $date; ?> </li>
              <li class="list-group-item"><strong>Tickets:</strong> <?php echo $quantity; ?> </li>
              <li class="list-group-item"><strong>Price: </strong> <?php echo "$" . $show->getRoom()->getPrice() ?> </li>
              <?php if ($discount != 1) { ?>
              <li class="list-group-item"><strong>Discount: </strong> <?php echo "💰 -" .(100-$discount*100)."% OFF" ?> </li>
              <?php } ?>
              <li class="list-group-item"><strong>Grand Total:</strong> <?php echo "$" . ($quantity * $show->getRoom()->getPrice()) * $discount ?> </li>
            </ul>
            <form action="<?php echo FRONT_ROOT ?>Ticket/showDetailsView" method="">
              <div class="form-group"> <input type="hidden" class="form-control" placeholder="IDShow" name="idShow" id="idShow" value="<?php echo $show->getId(); ?>"> </div>
              <div class="form-group"> <input type="hidden" class="form-control" placeholder="Date" name="date" id="date" value="<?php echo $date; ?>"> </div>
              <div class="form-group"> <input type="hidden" class="form-control" placeholder="Quantity" name="quantity" id="quantity" value="<?php echo $quantity; ?>"> </div>
              <div class="form-group"> <input type="hidden" class="form-control" placeholder="Discount" name="discount" id="discount" value="<?php echo $discount; ?>"> </div>
              <div class="form-group">
                <select class="form-control" id="cardType" name="cardType"> 
                  <option value="VISA">VISA</option>
                  <option value="MASTERCARD">MASTERCARD</option>
                </select>
              </div>
              <div class="form-group"> <input required type="number" class="form-control" placeholder="Card Number" name="cardNumber" id="cardNumber"> </div>
              <button type="submit" class="btn btn-success">Confirm and buy tickets ><br></button>
            </form>
          </div>
        </div>
      </div>
      <!-- Final de la tarjeta -->

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>