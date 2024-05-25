class Cart {
  constructor() {
    this.cart = [];
    this.total_value = 0;

    this.DEFAULT_CART_NAME_LOCAL = '@engenharia::cart';
  }

  init() {
    this.loadStorage();
    this.saveStorage();
  }

  loadStorage() {
    let cart = localStorage.getItem(this.DEFAULT_CART_NAME_LOCAL);

    if (cart) {
      cart = JSON.parse(cart);
      this.cart = cart;
    }
  }

  saveStorage() {
    this.calculatePrices();
    this.renderTotalPrice();
    this.renderProject();
    localStorage.setItem(this.DEFAULT_CART_NAME_LOCAL, JSON.stringify(this.cart));
  }

  pushProject(project) {
    if (this.cart.find(p => p.id === project.id)) return;

    this.cart.push(project);
    this.saveStorage();
  }

  removeProject(project) {
    this.cart = this.cart.filter(p => p.id !== project.id);
    this.saveStorage();
  }

  calculatePrices() {
    let value = 0;

    for (let x=0;x<this.cart.length;x++) {
      const project = this.cart[x];

      if (!project.is_discount) {
        value += project.price;
      } else {
        const promotion = (project.price * project.discount_percent) / 100;
        const price = project.price - promotion;
        
        value += price;
      }
    }

    this.total_value = value;
  }

  renderTotalPrice() {
    $('.HeaderCartPrice span').text(`R$ ${convertInBRL(this.total_value)}`);
    $('.button-cart-open span').text(this.cart.length);

    $('.CartTitle span').text(this.cart.length);
    $('.CartInfo__price span').text(`R$ ${convertInBRL(this.total_value)}`);
  }

  renderProject() {
    $('.HeaderCartList').html('');
    $('.CartList').html('');

    if (this.cart.length > 0) {
      for (let x=0;x<this.cart.length;x++) {
        const project = this.cart[x];
  
        $('.HeaderCartList').each((i, h) => {
          const cartItemElement = this.cartItemProjectHeader(project);
          h.appendChild(cartItemElement);
        });

        const cartItemElement = this.cartItemProjectPage(project);
        $('.CartList')[0].appendChild(cartItemElement);
      }
    } else {
      const htmlNoneProducts = '<p>Não há itens no carrinho!</p>';
      $('.HeaderCartList').html(htmlNoneProducts);
      $('.CartList').html(htmlNoneProducts);
    }
  }

  cartItemProjectHeader(project) {
    const div = document.createElement('div');
    div.classList.add('CartItem');

    let price = 0;
    
    if (!project.is_discount) {
      price = project.price;
    } else {
      let discount = (project.price * project.discount_percent) / 100;
      price = project.price - discount;
    }

    div.innerHTML = `
      <div class="CartItem__image">
        <img src="${project.cover}" alt="">
      </div>

      <div class="CartItem__info">
        <div class="CartItem__info_title">
          <p>${project.title}</p>
        </div>

        <div class="CartItem__info_price">
          <p>R$ ${convertInBRL(price)}</p>
        </div>
      </div>
    `;

    return div;
  }

  cartItemProjectPage(project) {
    const div = document.createElement('div');
    div.classList.add('CartItem');

    let price = 0;
    
    if (!project.is_discount) {
      price = project.price;
    } else {
      let discount = (project.price * project.discount_percent) / 100;
      price = project.price - discount;
    }

    div.innerHTML = `
      <div class="CartItem__image">
        <img src="${project.cover}" alt="">
      </div>

      <div class="CartItem__info">
        <div class="CartItem__info_title">
          <p>${project.title}</p>
        </div>

        <div class="CartItem__info_text">
          <p>${project.short_description}</p>
        </div>

        <div class="CartItem__info_price">
          <p>R$ ${convertInBRL(price)}${project.is_discount ? ` <span>${project.discount_percent}% Desconto</span>` : ''}</p>
        </div>
      </div>

      <div class="CartItem__actions"></div>
    `;

    $(div).find('.CartItem__actions')[0].appendChild(this.renderButtonCartPage());
    $(div).find('.CartItem__actions button').on('click', () => this.removeProject(project));

    return div;
  }

  renderButtonCartPage() {
    const button = document.createElement('button');

    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>';

    return button;
  }
}
