<?php if (isset($banner) && !empty($banner)): ?>
<section class="Banner" style="background-image: url(<?= $banner["image"] ?>)">
  <div class="Banner__container">
    <div class="BannerInfo">
      <?php if (!empty($banner["subtitle"])): ?>
        <div class="BannerInfo__label">
          <p><?= $banner["subtitle"] ?></p>
        </div>
      <?php endif; ?>

      <?php if (!empty($banner["title"])): ?>
        <div class="BannerInfo__title">
          <h1><?= $banner["title"] ?></h1>
        </div>
      <?php endif; ?>

      <?php if (!empty($banner["text"])): ?>
        <div class="BannerInfo__text">
          <p><?= $banner["text"] ?></p>
        </div>
      <?php endif; ?>

      <div class="BannerInfo__actions">
        <?php if (!empty($banner["button_primary"])): ?>
          <a href="<?= $banner["button_primary"]["link"] ?>" class="Button"><?= $banner["button_primary"]["label"] ?></a>
        <?php endif; ?>
        <?php if (!empty($banner["button_secondary"])): ?>
          <a href="<?= $banner["button_secondary"]["link"] ?>" class="Button Button--outline"><?= $banner["button_secondary"]["label"] ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
