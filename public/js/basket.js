// массив форм смартфонов
const phoneFormArr = document.querySelectorAll(".form-add-to-basket");
// элемент числа телефонов в корзине
const basketPhoneCountDOM = document.querySelector("#basket-phone-count");

// добавление смартфона в корзину
phoneFormArr.forEach((form) =>
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        ServerRequest.execute(
            "/phone",
            (data) => processStore(data),
            "post",
            this.errorPrg,
            new FormData(form)
        );
    })
);

/** обработать ответ сервера о добавлении смартфона в корзину */
function processStore(data) {
    try {
        let serverResponse = JSON.parse(data);
        console.log(serverResponse);
        if (serverResponse.result == 1) {
            basketPhoneCountDOM.textContent =
                parseInt(basketPhoneCountDOM.textContent) + 1;
            basketPhoneCountDOM.classList.remove("hidden");
        } else {
            alert(serverResponse.description);
        }
    } catch (exc) {
        alert(exc);
    }
}
