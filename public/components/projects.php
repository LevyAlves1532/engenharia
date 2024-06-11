<section class="Projects">
  <div class="Projects__container">
    <div class="ProjectsHeader">
      <div class="ProjectsHeader__label">
        <p>Nossos Projetos</p>
      </div>

      <div class="ProjectsHeader__title">
        <h3>Oportunidade de Projetos de Qualidade</h3>
      </div>
    </div>

    <div class="ProjectsList">
      <?php if (isset($projects) && !empty($projects) && count($projects) > 0): ?>
        <?php 
          foreach ($projects as $project): 
          $price = floatval(str_replace(',', '.', $project['price']));
          $discount_percent = intval(str_replace(',', '.', $project['discount_percent']));
      
          $discount = ($price * $discount_percent) / 100;
          $total_price = $price - $discount;  
        ?>
          <a href="<?= BASE ?>projetos/produto/<?= $project['slug'] ?>" class="Project">
            <div class="Project__image">
              <img src="<?= $project['cover'] ?>" alt="">

              <?php if ($project['is_discount']): ?>
                <div class="Project__image_discount">
                  <p><?= $project['discount_percent'] ?>% de desconto!</p>
                </div>
              <?php endif; ?>

              <div class="Project__image_price">
                <?php if (!$project['is_discount']): ?>
                  <p>R$<?= number_format($total_price, 2, ',', '.') ?></p>
                <?php else: ?>
                  <p><strike>R$<?= number_format($price, 2, ',', '.') ?></strike> R$<?= number_format($total_price, 2, ',', '.') ?></p>
                <?php endif; ?>
              </div>
            </div>

            <div class="Project__info">
              <div class="Project__info_title">
                <p><?= $project['title'] ?></p>
              </div>

              <div class="Project__info_text">
                <p><?= $project['short_description'] ?></p>
              </div>
              
              <div class="Project__info_data">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 32C14.3 32 0 46.3 0 64v96c0 17.7 14.3 32 32 32s32-14.3 32-32V96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H32zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7 14.3 32 32 32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H64V352zM320 32c-17.7 0-32 14.3-32 32s14.3 32 32 32h64v64c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32H320zM448 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c17.7 0 32-14.3 32-32V352z"/></svg>
                  <p><?= str_replace('.', ',', strval($project['square_meters'])) ?>m²</p>
                </div>

                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 131.9C64 112.1 80.1 96 99.9 96c9.5 0 18.6 3.8 25.4 10.5l16.2 16.2c-21 38.9-17.4 87.5 10.9 123L151 247c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0L345 121c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-1.3 1.3c-35.5-28.3-84.2-31.9-123-10.9L170.5 61.3C151.8 42.5 126.4 32 99.9 32C44.7 32 0 76.7 0 131.9V448c0 17.7 14.3 32 32 32s32-14.3 32-32V131.9zM256 352a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm32-32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                  <p><?= $project['bathrooms'] ?></p>
                </div>

                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 32c17.7 0 32 14.3 32 32V320H288V160c0-17.7 14.3-32 32-32H544c53 0 96 43 96 96V448c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H352 320 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V64C0 46.3 14.3 32 32 32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>
                  <p><?= $project['bedrooms'] ?></p>
                </div>

                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                  <p><?= $project['garages'] ?></p>
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="ProjectsButton">
      <a href="<?= BASE ?>projetos" class="Button">Veja mais</a>
    </div>
  </div>
</section>
