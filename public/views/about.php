<main class="WrapperAbout">
  <?php include 'components/about.php' ?>

  <section class="AboutMe">
    <div class="AboutMe__container">
      <div class="AboutMe__container_image">
        <picture>
          <source type="image/webp" srcset="<?= BASE ?>assets/images/user.webp" />
          <img src="<?= BASE ?>assets/images/user.jpg" loading="lazy" alt="Fundador da Empresa">
        </picture>
      </div>

      <div class="AboutMe__container_info">
        <span>Sobre Mim</span>
        <h1>Pedro Alvarez</h1>
        <p>Engenheiro Civil</p>
      </div>

      <div class="AboutMe__container_text">
        <p>Nosso fundador, Pedro Alvarez, é um engenheiro visionário com mais de 20 anos de experiência no setor. Formado pela renomada Universidade de Engenharia de São Paulo, Pedro sempre teve uma paixão inabalável por transformar ideias complexas em realidades concretas. Ao longo de sua carreira, ele liderou inúmeros projetos inovadores, sempre com um foco incansável na qualidade, sustentabilidade e inovação.</p>
        <p>Pedro fundou nossa empresa com a missão de criar soluções de engenharia que não só atendam, mas superem as expectativas dos clientes. Sua liderança é marcada por um compromisso com a excelência e um desejo de promover um impacto positivo no meio ambiente e na sociedade. Com uma visão clara e estratégica, ele continua a inspirar nossa equipe a alcançar novos patamares e a construir um futuro mais sustentável e tecnológico.</p>
        <p>Sob sua orientação, nossa empresa tornou-se sinônimo de confiança e competência, entregando projetos que são verdadeiros marcos de engenharia. Pedro Alvarez acredita que com dedicação, integridade e inovação, é possível construir um mundo melhor, um projeto de cada vez.</p>
      </div>
    </div>
  </section>

  <?php include 'components/goals.php'; ?>
  
  <?php include 'components/values.php'; ?>

  <section class="AboutProject">
    <div class="AboutProject__container">
      <div class="AboutProject__container_title">
        <h3>Nosso Time</h3>
      </div>

      <div class="AboutProject__container_list">
        <?php if (isset($team) && !empty($team) && count($team) > 0): ?>
          <?php foreach ($team as $team_item): ?>
            <div class="Project">
              <div class="Project__image">
                <img src="<?= $team_item['photo'] ?>" alt="">
              </div>

              <div class="Project__info">
                <div class="Project__info_title">
                  <p><?= $team_item['name'] ?></p>
                </div>

                <div class="Project__info_text">
                  <p><?= $team_item['profession'] ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
