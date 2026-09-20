<?php
require_once 'config.php';
$conn = db_connect();

$service_id = 0;
if (isset($_GET['service_id'])) {
    $service_id = (int)$_GET['service_id'];
}

$service = null;
$packs   = array();

if ($service_id > 0) {
    $service = get_service($conn, $service_id);
    if ($service) {
        $packs = get_packages_by_service($conn, $service_id);
    }
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
            if ($service) {
                echo $service['title'];
            } else {
                echo "Packages";
            }
            ?>
          </h1>
          <p class="text-white">
            <?php
            if ($service) {
                echo $service['short_desc'];
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
    <a href="services.php#services" class="btn btn-sm btn-outline-secondary mb-4">&larr; Back</a>

    <div class="row">
      <?php if (!$service): ?>
        <div class="col-12">
          <div class="alert alert-light border rounded-20">Unknown service.</div>
        </div>

      <?php elseif (!$packs): ?>
        <div class="col-12">
          <div class="alert alert-light border rounded-20">No packages available right now.</div>
        </div>

      <?php else: foreach ($packs as $p): ?>
        <div class="col-12 col-sm-6 col-lg-3 mb-5 d-flex">
          <div class="media-1 h-100 d-flex flex-column">

            <?php
            $img = $service['image_path'];
            if ($p['image_path'] != "") {
                $img = $p['image_path'];
            }
            ?>

            <a href="package.php?package_id=<?= (int)$p['id'] ?>"
               class="d-block mb-3 overflow-hidden rounded-20"
               style="width:100%; aspect-ratio: 4 / 3;">
              <img
                src="<?= $img ?>"
                alt="<?= $p['name'] ?>"
                class="img-fluid"
                style="width:100%; height:100%; object-fit:cover;">
            </a>

            <?php
            $start_date = "";
            if (isset($p['start_date'])) {
                $start_date = $p['start_date'];
            }
            ?>

            <div class="small text-muted mb-1">
              <strong>Start:</strong> <?= $start_date ?>
              &nbsp;&middot;&nbsp;
              <strong>Nights:</strong> <?= (int)$p['nights'] ?>
            </div>

            <h3 class="mb-1">
              <a href="package.php?package_id=<?= (int)$p['id'] ?>">
                <?= $p['name'] ?>
              </a>
            </h3>

            <?php if ($p['hotel_name'] != ""): ?>
              <div class="text-muted small">Hotel: <strong><?= $p['hotel_name'] ?></strong></div>
            <?php endif; ?>

            <?php
              $incs = array();
              if ($p['includes'] != "") {
                  $incs = array_filter(array_map('trim', explode(',', $p['includes'])));
              }
            ?>
            <?php if ($incs): ?>
              <div class="mt-2">
                <?php foreach ($incs as $inc): ?>
                  <span class="badge badge-light border mr-1 mb-1"><?= $inc ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <div class="d-flex align-items-end mt-auto">
              <div class="text-muted small">Seats left: <?= (int)$p['seats_left'] ?></div>
              <div class="price ml-auto">
                <span>$<?= number_format((float)$p['price'], 2) ?></span>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>

<?php
include 'footer.php';
db_close($conn);
?>
