<main class="WrapperProduct">
  <div class="WrapperProduct__container">
    <div class="WrapperProduct__container_info">
      <div class="ProductCarousel">
        <div class="ProductCarousel__images" id="slick-product-images">          
          <?php foreach($project['carousel'] as $carousel_item): ?>
            <img src="<?= $carousel_item['image'] ?>" alt="" />
          <?php endforeach; ?>
        </div>

        <div class="ProductCarousel__dots" id="dots-product">
          <?php foreach($project['carousel'] as $carousel_item): ?>
            <img src="<?= $carousel_item['image'] ?>" alt="" />
          <?php endforeach; ?>
        </div>
      </div>

      <div class="ProductDescription">
        <div class="ProductDescription__title">
          <h1><?= $project['title'] ?></h1>
        </div>

        <div class="ProductDescription__text">
          <?= $project['description'] ?>
        </div>
      </div>
    </div>

    <div class="WrapperProduct__container_form">
      <div class="ProductPrices">
        <?php 
          if ($project['is_discount']): 
            $price = ($project['price'] * $project['discount_percent']) / 100;
            $total_price = $project['price'] - $price;
        ?>
          <div class="ProductPrices__discount">
            <p><?= $project['discount_percent'] ?>%</p>
          </div>

          <div class="ProductPrices__price">
            <p>R$ <?= number_format($total_price, 2, ',', '.') ?> <strike>R$ <?= number_format($project['price'], 2, ',', '.') ?></strike></p>
          </div>
        <?php else: ?>
          <div class="ProductPrices__price">
            <p>R$ <?= number_format($project['price'], 2, ',', '.') ?></p>
          </div>
        <?php endif; ?>

        <div class="ProductPrices__button">
          <button class="Button" data-slug="<?= $slug ?>" <?= (!isset($buy_project) && $project['is_active'] === 1) ? 'id="add-cart"' : '' ?>>
            <?php if ($project['is_active'] === 1): ?>
              <?= !isset($buy_project) ? 'Adicionar ao Carrinho +' : 'Você adquiriu o projeto' ?>
            <?php else: ?>
              Projeto indisponível
            <?php endif; ?>
          </button>
        </div>

        <div class="ProductPrices__data">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 32C14.3 32 0 46.3 0 64v96c0 17.7 14.3 32 32 32s32-14.3 32-32V96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H32zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7 14.3 32 32 32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H64V352zM320 32c-17.7 0-32 14.3-32 32s14.3 32 32 32h64v64c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32H320zM448 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c17.7 0 32-14.3 32-32V352z"/></svg>
            <p><?= str_replace('.', ',', $project['square_meters']) ?>m²</p>
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

      <?php if (isset($buy_project)): ?>
        <div class="ProductFiles">
          <div class="ProductFiles__title">
            <h2>Arquivos do Projeto</h2>
          </div>

          <div class="ProductFiles__action">
            <a href="<?= BASE ?>projetos/baixar_arquivos/<?= $slug ?>" class="Button" id="download-files" data-slug="<?= $slug ?>">Baixar Arquivos</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>