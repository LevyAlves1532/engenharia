<main class="WrapperHome">
  <?php include 'components/banner.php'; ?>

  <?php include 'components/about.php'; ?>

  <?php include 'components/values.php'; ?>

  <?php include 'components/goals.php'; ?>

  <?php include 'components/projects.php'; ?>

  <section class="HomeFeedback">
    <div class="HomeFeedback__container">
      <div class="HomeFeedbackTitle">
        <h3>Nossas Avaliações</h3>
      </div>

      <div class="HomeFeedbackList">
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

      <div class="HomeFeedbackButton">
        <a href="<?= BASE ?>portfolio" class="Button Button--secondary">Acesse nosso Portfolio</a>
      </div>
    </div>
  </section>

  <?php include 'components/contact.php'; ?>
</main>