<main class="WrapperPortfolio">
  <section class="PortfolioInstagram">
    <div class="PortfolioInstagram__container">
      <div class="PortfolioInstagram__container_title">
        <h1>Nossas Postagens</h1>
      </div>

      <div class="PortfolioInstagram__container_list">
        <?php if (isset($posts) && !empty($posts) && count($posts) > 0): ?>
          <?php foreach ($posts as $post): ?>
            <a href="<?= $post['link'] ?>" target="_blank">
              <img src="<?= $post['cover'] ?>" alt="">
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php include 'components/projects.php'; ?>

  <section class="PortfolioFeedback">
    <div class="PortfolioFeedback__container">
      <div class="PortfolioFeedback__container_title">
        <h2>Todas as Avaliações</h2>
      </div>

      <div class="PortfolioFeedback__container_list" id="slick-portfolio-feedbacks">
      <?php if (!empty($feedbacks) && count($feedbacks) > 0): ?>
          <?php foreach($feedbacks as $feedback): ?>
            <div class="Feedback">
              <div class="Feedback__image">
                <img src="<?= $feedback['cover'] ?>" alt="">

                <div>
                  <p><?= $feedback['name'] ?></p>
                  <span><?= number_format($feedback['assessment'], 1, ',', '.') ?></span>
                </div>
              </div>

              <div class="Feedback__info">
                <?= $feedback['short_description'] ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>