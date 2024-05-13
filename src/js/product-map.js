$(document).ready(function () {
  const productImage = "product.png";
  const products = [
    {
      id: 1,
      name: "Лампа настольная",
      description: "Элегантная настольная лампа для чтения",
      price: "2,500 руб.",
      image: productImage,
    },
    {
      id: 2,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 3,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 4,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 5,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 6,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 7,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 8,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 9,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 10,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 11,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
    {
      id: 12,
      name: "Люстра",
      description: "Современная люстра с LED освещением",
      price: "10,000 руб.",
      image: productImage,
    },
  ];

  let itemsPerPage = 8; // Количество товаров на странице
  let currentPage = 0; // Текущая страница
  let cartItems = []; // Массив для хранения товаров в корзине

  function renderProducts() {
    const start = currentPage * itemsPerPage;
    const end = start + itemsPerPage;
    const productsToShow = products.slice(start, end);

    const productsHtml = productsToShow
      .map(
        (product) => `
      <div class="card" style="width: 18rem;">
        <img src="${product.image}" class="card-img-top" alt="${product.name}">
        <div class="card-body">
          <h5 class="card-title">${product.name}</h5>
          <p class="card-text">${product.description}</p>
          <p class="card-text"><strong>Цена: </strong>${product.price}</p>
          <a class="btn btn-outline-primary buy-btn" data-id="${product.id}">Купить</a>
        </div>
      </div>
    `
      )
      .join("");

    $("#products-container").append(productsHtml);

    // Если товар закончился, то кнопка пропадает
    if (end >= products.length) {
      $("#viewMore").hide();
    }
  }

  function updateCart() {
    let cartHtml = cartItems
      .map(
        (item) => `
        <p>
        ${item.name} - ${item.price}
        </p>
    `
      )
      .join("");

    if (cartItems.length === 0) {
      cartHtml = "<p>Ваша корзина пуста</p>";
    }

    $(".modal-body").html(cartHtml);
  }

  updateCart();

  $("#products-container").on("click", ".buy-btn", function () {
    const productId = $(this).data("id");
    const product = products.find((p) => p.id === productId);

    if (product) {
      cartItems.push(product); // Добавляем товар в корзину, если он найден
      updateCart(); // Обновляем корзину
      showToast();
      console.log("Товар добавлен успешно: ", productId);
    } else {
      console.error("Товар не найден: ", productId); // Логируем ошибку, если продукт не найден
    }
  });

  function showToast() {
    $("#cartToast").toast({ delay: 3000 }); // Настраиваем задержку перед закрытием
    $("#cartToast").toast("show"); // Показываем toast
  }

  renderProducts();

  $("#catalog #viewMore").click(function () {
    currentPage++;
    renderProducts();
  });
});
