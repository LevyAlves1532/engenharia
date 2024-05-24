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
  }

  renderProject() {
    $('.HeaderCartList').html('');

    if (this.cart.length > 0) {
      for (let x=0;x<this.cart.length;x++) {
        const project = this.cart[x];
  
        const cartItemElement = this.cartItemProject(project);
        $('.HeaderCartList')[0].appendChild(cartItemElement);
      }
    } else {
      $('.HeaderCartList').html('<p>Não há itens no carrinho!</p>');
    }
  }

  cartItemProject(project) {
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
}
