const select = document.getElementById('category');
const sort_price = document.getElementById('sort_price');
const sort_name = document.getElementById('sort_name');
select.addEventListener('change', filter);
price_field.addEventListener('click', () => sort('price'));
name_field.addEventListener('click', () => sort('name'));

function filter() {
  let cards = document.getElementById("cards");
  cards.innerHTML = '';
  rows.sort((a,b) => (Number(a.price) < Number(b.price)) ? 1 : ((Number(b.price) < Number(a.price)) ? -1 : 0));
  rows.filter((row) => {
    if ((row.category == select.value) || (select.value == 'All')) {
      let figure_item = document.createElement('figure');
      figure_item.id = row.id;
      let link_item = document.createElement('a');
      link_item.href = "./product.php?id=" + row.id;
      let img_item = document.createElement('img');
      img_item.src = "./thumbnails/" + row.thumbnail_image;
      img_item.alt = row.name;
      let figcaption_item = document.createElement('figcaption');
      figcaption_item.innerHTML = row.name + '<br><span>$' + row.price + '</span>';
      figure_item.append(link_item);
      link_item.append(img_item, figcaption_item);
      cards.appendChild(figure_item);
    }
  });
}

function sort(sortby) {
  if (sortby == "price") {
    if (sort_price.classList.contains('arrow_up')) {
    rows.sort((a,b) => (Number(a.price) < Number(b.price)) ? 1 : ((Number(b.price) < Number(a.price)) ? -1 : 0));sort_price.className="arrow price arrow_down"
    } else {
      rows.sort((a,b) => (Number(a.price) > Number(b.price)) ? 1 : ((Number(b.price) > Number(a.price)) ? -1 : 0));sort_price.className="arrow price arrow_up" 
    }
    sort_name.className="name arrow"       
  } else {
    if (sort_name.classList.contains('arrow_up')) {
    rows.sort((a,b) => (a.name < b.name) ? 1 : (b.name < a.name) ? -1 : 0) ;sort_name.className="arrow name arrow_down"
    } else {
      rows.sort((a,b) => (a.name > b.name) ? 1 : (b.name > a.name) ? -1 : 0) ;sort_name.className="arrow name arrow_up"
    }
    sort_price.className="price arrow"  
  }
  flexbox_reorder(rows);
}

function flexbox_reorder(rows) {
  order = 1;
  rows.forEach((row, i) => {
    let element = document.getElementById(row.id);
    if (element) {
      element.style.order = order;
      order = order + 1;
    }  
  })
}
filter();