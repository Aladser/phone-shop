const phoneServerCtrlURL = '/phone';
// массив форм смартфонов
const phoneFormArr = document.querySelectorAll('.form-add-to-basket');

// добавление смартфона в корзину
phoneFormArr.forEach(form => form.addEventListener('submit', function(e){
    e.preventDefault();
    ServerRequest.execute(
      phoneServerCtrlURL,
        (data) => processStore(data, form),
        "post",
        this.errorPrg,
        new FormData(form)
      );
}));

  /** обработать ответ сервера о добавлении смартфона в корзину */
function processStore(data, form) {
    console.log(data);
    console.log(form);
}