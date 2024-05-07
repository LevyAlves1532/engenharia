class DataTable {
  // Start configurantions
  constructor(className, dataHead, customData = null) {
    const divEl = document.querySelector(className);

    this.mainElement = divEl; // First element, element father from the table
    this.dataHead = dataHead; // Data from header table
    this.customData = customData; // Optional custom data.

    this.count = !customData ? 0 : customData.length;
    this.allLimits = [5, 10, 25, 50, 100];
    this.limitOption = 0;
    this.pages = 1;
    this.currentPage = 1;
  }

  // Initilize functions from the table
  init() {
    if (!this.mainElement) {
      console.error('Element not exists!');
      return;
    }

    if (!this.dataHead || (this.dataHead && this.dataHead.length === 0)) {
      console.error('Data from head table not exists!');
      return;
    }

    this.generateSearch();
    this.generateTable();
    this.generateTableHead();
    this.generateTableBody();
    
    // console.log(this.table);
    this.mainElement.appendChild(this.table);
    this.generateDots();

    this.updatedTable();
  }

  generateSearch() {
    const divEl = document.createElement('div');
    divEl.classList.add('row', 'mb-3');

    const select = document.createElement('select');
    select.classList.add('form-select');

    this.allLimits.forEach((limit, index) => {
      const option = document.createElement('option');
      option.value = index;
      option.innerText = limit;
      select.appendChild(option);
    });

    divEl.innerHTML = `
      <div class="col-md-3">
        <label class="form-label">Limite de linhas</label>
      </div>
      <div class="col-md-9 d-flex align-items-end">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Buscar...">
          <button class="btn btn-outline-secondary" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
          </button>
        </div>
      </div>
    `;

    divEl.querySelector('button').onclick = () => this.filterSearch(divEl.querySelector('input'));
    divEl.querySelector('.col-md-3').appendChild(select);

    this.mainElement.appendChild(divEl);
  }

  // Create Table
  generateTable() {
    const table = document.createElement('table');
    table.classList.add('table', 'table-dark');
    this.table = table;
  }

  // Create header table
  generateTableHead() {
    const thead = document.createElement('thead');
    const tr = document.createElement('tr');

    thead.appendChild(tr);

    // Fill in header table
    this.dataHead.forEach((head, index, arr) => {
      const th = document.createElement('th');
      th.onclick = () => this.filterOrder(head, index, arr);
      th.innerText = head.label;

      tr.appendChild(th);
    });

    this.table.appendChild(thead);
  }

  // Create body table
  generateTableBody() {
    const tbody = document.createElement('tbody');
    this.table.appendChild(tbody);

    if (this.customData && this.customData.length > 0) this.seedTable(tbody);
  }

  // Case "customData" to be fill in table
  seedTable(tbody) {
    tbody.innerHTML = "";

    const pagination = this.customData.filter((_, index) => {
      const start = this.allLimits[this.limitOption] * (this.currentPage  - 1);
      const end = this.allLimits[this.limitOption] * this.currentPage;
      return index >= start && index < end;
    });

    this.pages = Math.ceil(this.count / this.allLimits[this.limitOption]);

    pagination.forEach((value, index, arr) => {
      const tr = document.createElement('tr');

      // Fill in body table from header table 
      this.dataHead.forEach((head, indexHead, arrHead) => {
        const td = document.createElement('td');

        td.style.verticalAlign = 'middle';

        if (!head.renderItem && value[head.name]) {
          td.appendChild(document.createTextNode(value[head.name]));
        } else if (head.renderItem && value[head.name]) {
          td.appendChild(head.renderItem(value[head.name], value, index, arr));
        }

        tr.appendChild(td);
      });

      tbody.appendChild(tr);
    });
  }

  generateDots() {
    console.log(this.mainElement);
    const mainDots = document.createElement('div');
    mainDots.classList.add('row');

    mainDots.innerHTML = `
      <div class="col-md-8">
        <p>${this.currentPage * this.allLimits[this.limitOption]} de ${this.customData.length} estão sendo exibidos</p>
      </div>
      <div class="col-md-4 d-flex justify-content-end">
        <nav aria-label="Page navigation example">
          <ul class="pagination"></ul>
        </nav>
      </div>
    `;

    const pagination = mainDots.querySelector('.pagination');

    const liPrev = DataTable.createLiPagination('&laquo;');
    pagination.appendChild(liPrev);

    for (let x=0;x<this.pages;x++) {
      const beforePage = x;
      const currentPage = x + 1;
      const afterPage = x + 2;
      
      if (beforePage === this.currentPage || currentPage === this.currentPage || afterPage === this.currentPage) {
        const li = DataTable.createLiPagination(x + 1, () => {
          this.currentPage = x + 1;
          this.seedTable(this.mainElement.querySelector('tbody'));
        });
        pagination.appendChild(li);
      }
    }

    const liNext = DataTable.createLiPagination('&raquo;');
    pagination.appendChild(liNext);

    console.log(this.mainElement);

    this.mainElement.appendChild(mainDots);
  }

  // Function order header table
  filterOrder(head, index, arr) {
    console.log(head);
  }

  filterSearch(input) {
    console.log(input.value);
  }

  updatedTable() {
    // if () {

    // }
  }

  static createLiPagination(text, onCallback = () => {}) {
    const li = document.createElement('li');
    li.classList.add('page-item');
    li.onclick = onCallback;
    li.innerHTML = `
      <button class="page-link">
        <span>${text}</span>
      </button>
    `;

    return li;
  }
}
