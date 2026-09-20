<?php
require_once 'config.php';
$conn   = db_connect();

$pkg_id = 0;
if (isset($_GET['package_id'])) {
    $pkg_id = (int)$_GET['package_id'];
}

$pkg = null;
if ($pkg_id > 0) {
    $pkg = get_package($conn, $pkg_id);
}

include 'header.php';
include 'mobileMenu.php';
include 'nav.php';
?>

<div class="hero hero-inner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mx-auto text-center">
        <div class="intro-wrap">
          <h1 class="mb-0">
            <?php
            if ($pkg) {
                echo $pkg['name'];
            } else {
                echo "Package";
            }
            ?>
          </h1>
          <p class="text-white">
            <?php
            if ($pkg) {
                echo $pkg['service_title'];
            }
            ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="untree_co-section">
  <div class="container">
    <?php if (!$pkg): ?>
      <div class="alert alert-light border rounded-20">Package not found.</div>
    <?php else: ?>

      <a href="packages.php?service_id=<?= (int)$pkg['service_id'] ?>"
         class="btn btn-sm btn-outline-secondary mb-4">&larr; Back to packages</a>

      <div class="row align-items-start">
        <div class="col-lg-6 mb-3">
          <?php
          $img = $pkg['service_image'];
          if ($pkg['image_path'] != "") {
              $img = $pkg['image_path'];
          }
          ?>
          <img src="<?= $img ?>"
               class="img-fluid rounded-20"
               style="width:100%; height:360px; object-fit:cover;">
        </div>

        <div class="col-lg-6">
          <ul class="list-unstyled">
            <li>Hotel: <strong><?= $pkg['hotel_name'] ?></strong></li>
            <li>Start date: <strong><?= $pkg['start_date'] ?></strong></li>
            <li>Nights: <strong><?= (int)$pkg['nights'] ?></strong></li>
            <li>Price: <strong>$<?= number_format((float)$pkg['price'], 2) ?></strong></li>
            <li>Seats left : <strong><?= (int)$pkg['seats_left'] ?> </strong></li>
          </ul>

          <?php
            $incs = array();
            if ($pkg['includes'] != "") {
                $incs = array_filter(array_map('trim', explode(',', $pkg['includes'])));
            }
          ?>
          <?php if ($incs): ?>
            <div class="mb-3">
              <?php foreach ($incs as $inc): ?>
                <span class="badge badge-light border mr-1 mb-1"><?= $inc ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if ($pkg['details'] != ""): ?>
            <p><?= nl2br($pkg['details']); ?></p>
          <?php endif; ?>

          <form method="POST" action="package.php?package_id=<?= (int)$pkg['id'] ?>" class="mt-3">
            <input type="hidden" name="pkg_id" value="<?= (int)$pkg['id'] ?>">
            <button type="submit" name="book_now" class="btn btn-primary">Book (interest)</button>
          </form>
          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_now'])) {
              echo '<div class="alert alert-success mt-3 rounded-20">Your interest has been recorded.</div>';
          }
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php
include 'footer.php';
db_close($conn);
?>
