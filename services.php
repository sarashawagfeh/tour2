<?php
// services.php
if (!function_exists('db_connect')) {
    require_once 'config.php';
}

$conn = db_connect();

// هل الصفحة مفتوحة مباشرة (services.php) ولا مضمَّنة من index؟
$standalone = (basename($_SERVER['SCRIPT_NAME']) === 'services.php');

$cards = get_home_services($conn);

if ($standalone) {
    include 'header.php';
    include 'mobileMenu.php';
    include 'nav.php';
}
?>

<?php if ($standalone): ?>
  <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h1 class="mb-0">Our Services</h1>
            <p class="text-white">Pick a service to see its travel packages.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<section id="services" class="untree_co-section">
  <div class="container">
    <?php if (!$standalone): ?>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-6 text-center">
          <h2 class="section-title text-center mb-3">Our Services</h2>
          <p>Pick a service to see its travel packages.</p>
        </div>
      </div>
    <?php endif; ?>

    <div class="row">
      <?php if (!$cards): ?>
        <div class="col-12">
          <div class="alert alert-light border rounded-20">
            No services available right now.
          </div>
        </div>
      <?php else: foreach ($cards as $s): ?>
        <div class="col-12 col-sm-6 col-lg-3 mb-5 d-flex">
          <div class="media-1 w-100 d-flex flex-column">
            <a href="packages.php?service_id=<?= $s['id'] ?>"
               class="d-block mb-3 overflow-hidden rounded-20"
               style="width:100%; aspect-ratio:4/3;">
              <img src="<?= $s['image_path'] ?>"
                   alt="<?= $s['title'] ?>"
                   class="img-fluid"
                   style="width:100%; height:100%; object-fit:cover;">
            </a>
            <h3 class="mb-1">
              <a href="packages.php?service_id=<?= $s['id'] ?>"><?= $s['title'] ?></a>
            </h3>
            <p class="mb-0"><?= $s['short_desc'] ?></p>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<?php
if ($standalone) {
    include 'footer.php';
    db_close($conn);
}
?>
