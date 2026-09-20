<?php
require_once 'config.php';
$conn = db_connect();

$dest_id   = 0;
$daterange = '';
$people    = 1;

if (isset($_GET['dest_id'])) {
    $dest_id = (int)$_GET['dest_id'];
}
if (isset($_GET['daterange'])) {
    $daterange = trim($_GET['daterange']);
}
if (isset($_GET['people'])) {
    $people = (int)$_GET['people'];
}

list($date_from, $date_to) = parse_daterange_to_ymd($daterange);

$dest_name = '';
if ($dest_id > 0) {
    $q = "SELECT name FROM destinations WHERE id=$dest_id";
    $r = mysqli_query($conn, $q);
    $row = mysqli_fetch_row($r);
    if ($row) {
        $dest_name = $row[0];
    }
}

$errors = array();
if ($dest_id <= 0) {
    $errors[] = "Please choose a destination.";
}
if ($people < 1) {
    $errors[] = "People must be at least 1.";
}

$offers = array();
if (!$errors) {
    $offers = search_dest_offers($conn, $dest_id, $date_from, $date_to, $people);
}

include 'header.php';
include 'mobileMenu.php';
include 'nav.php';
?>

<div class="hero hero-inner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 mx-auto text_center text-center">
        <div class="intro-wrap">
          <h1 class="mb-2">Search Results</h1>
          <p class="text-white mb-1">
            <?php if ($dest_name != ""): ?>
              <strong>Destination:</strong> <?= $dest_name ?>
              &nbsp;|&nbsp;
            <?php endif; ?>
            <?php if ($daterange != ""): ?>
              <strong>Dates:</strong> <?= $daterange ?>
              &nbsp;|&nbsp;
            <?php endif; ?>
            <strong>People:</strong> <?= $people ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="untree_co-section">
  <div class="container">
    <a href="index.php" class="btn btn-sm btn-outline-secondary mb-4">&larr; Back to search</a>

    <?php if ($errors): ?>
      <div class="row"><div class="col-12">
        <div class="alert alert-warning border rounded-20">
          <?php foreach ($errors as $e): ?>
            <div><?= $e ?></div>
          <?php endforeach; ?>
        </div>
      </div></div>

    <?php elseif (!$offers): ?>
      <div class="row"><div class="col-12">
        <div class="alert alert-light border rounded-20">
          No offers found for your filters.
        </div>
      </div></div>

    <?php else: ?>
      <div class="row">
        <?php foreach ($offers as $o): ?>
          <div class="col-12 col-sm-6 col-lg-3 mb-5 d-flex">
            <div class="media-1 w-100 d-flex flex-column">

              <?php
              $img = 'images/hero-slider-1.jpg';
              if ($o['image_path'] != "") {
                  $img = $o['image_path'];
              }
              ?>

              <div class="mb-3 overflow-hidden rounded-20"
                   style="width:100%; aspect-ratio: 4 / 3;">
                <img src="<?= $img ?>"
                     alt="<?= $o['title'] ?>"
                     class="img-fluid"
                     style="width:100%; height:100%; object-fit:cover;">
              </div>

              <span class="d-flex align-items-center loc mb-2">
                <span class="icon-room mr-3"></span>
                <span><?= $o['destination'] ?></span>
              </span>

              <div class="d-flex align-items-start mt-auto">
                <div class="pr-3">
                  <h3 class="mb-1"><?= $o['title'] ?></h3>

                  <?php if ($o['hotel_name'] != ""): ?>
                    <div class="text-muted small">
                      Hotel: <strong><?= $o['hotel_name'] ?></strong>
                    </div>
                  <?php endif; ?>

                  <div class="text-muted small">
                    <?php if ($o['start_date'] != ""): ?>
                      <strong>Start:</strong> <?= $o['start_date'] ?>&nbsp;&middot;&nbsp;
                    <?php endif; ?>
                    <strong>Nights:</strong> <?= $o['nights'] ?>
                    &nbsp;&middot;&nbsp;
                    <strong>Seats left:</strong> <?= $o['seats_left'] ?>
                  </div>

                  <?php
                  $incs = array();
                  if ($o['includes'] != "") {
                      $incs = array_filter(array_map('trim', explode(',', $o['includes'])));
                  }
                  ?>
                  <?php if ($incs): ?>
                    <div class="mt-2">
                      <?php foreach ($incs as $inc): ?>
                        <span class="badge badge-light border mr-1 mb-1"><?= $inc ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="price ml-auto">
                  <span>$<?= number_format((float)$o['price'], 2) ?></span>
                </div>
              </div>

              <?php if ($o['details'] != ""): ?>
                <div class="mt-3 small text-muted">
                  <?= nl2br($o['details']) ?>
                </div>
              <?php endif; ?>

              <div class="mt-3">
                <a href="#" class="btn btn-primary btn-block">Book (Interest)</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</div>

<?php
include 'footer.php';
db_close($conn);
?>
