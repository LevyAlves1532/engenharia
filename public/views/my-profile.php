<main class="WrapperMyProfile">
  <div class="WrapperMyProfile__container">
    <div class="WrapperMyProfile__container_title">
      <h1>My Profile</h1>
    </div>

    <div class="WrapperMyProfile__container_content">
      <div class="MyProfileTabBox" id="tab-box-my-profile">
        <div class="MyProfileTabBox__tabs">
          <button class="active-tab" data-tab="profile">Perfil</button>
          <button data-tab="historic">Histórico</button>
        </div>

        <div class="MyProfileTabBox__content">
          <div class="MyProfileTabBox__content_item active-tab" data-tab-name="profile">
            <div class="ProfileForm">
              <form id="profile-form">
                <label class="Input">
                  <span class="Input__label">Nome</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="text" name="name" id="name" value="<?= $user['name'] ?>" placeholder="Digite seu nome...">
                    </div>
                  </div>
                  <div class="Input__error error-user-name"></div>
                </label>

                <label class="Input">
                  <span class="Input__label">E-mail</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="email" name="email" id="email" value="<?= $user['email'] ?>" placeholder="Digite seu email...">
                    </div>
                  </div>
                  <div class="Input__error error-user-email"></div>
                </label>

                <label class="Input">
                  <span class="Input__label">Senha</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="password" name="password" id="password" placeholder="Digite sua senha...">
                    </div>
                    <button type="button" class="Input__content_icon Input__content_icon--border-right Input__content_icon--button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm51.3 163.3l-41.9-33C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5zm-88-69.3L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8z"/></svg>
                    </button>
                  </div>
                  <div class="Input__error error-user-password"></div>
                </label>

                <div class="FormButtons">
                  <button type="submit" class="Button">Fazer Cadastro</button>
                  <a href="<?= BASE ?>meu_perfil/sair" class="Button Button--outline">Sair</a>
                </div>
              </form>
            </div>
          </div>
          
          <div class="MyProfileTabBox__content_item" data-tab-name="historic">
            <div class="MyProfileHistoric">
              <div class="MyProfileHistoric__header">
                <p>Total Price:</p>
                <span>R$ 124,00</span>
              </div>

              <div class="MyProfileHistoric__list">
                <a href="<?= BASE ?>projetos/produto/general-construction" class="MyProfileProduct">
                  <div class="MyProfileProduct__image">
                    <img src="https://img.freepik.com/fotos-gratis/renderizacao-3d-do-modelo-de-casa-isometrica_23-2150799647.jpg?t=st=1713817554~exp=1713821154~hmac=f793eba460c8d491ed4ab22085b3df9dc786476bcece379887d84029dc1b97c6&w=740" alt="">
                  </div>

                  <div class="MyProfileProduct__title">
                    <p>General Construction</p>
                  </div>

                  <div class="MyProfileProduct__price">
                    <p>R$ 124,00</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>