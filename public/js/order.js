// заголовок общей стоимости всех заказов
const totalPriceHeaderDOM = document.querySelector("#total-price-header");
// общая стоимость всех заказов
const totalPriceDOM = document.querySelector("#total-price");
//
const emptyOrderListDOM = document.querySelector("#empty-order-list");

// кнопки удаления заказов
const orderRemoveButtonDOMArr = document.querySelectorAll(
    ".order__remove-button"
);
orderRemoveButtonDOMArr.forEach((buttonDOM) => {
    buttonDOM.addEventListener("click", function () {
        let orderDOM = this.closest(".order");
        let orderIdDOM = orderDOM.querySelector(".order__id");
        let orderId = orderIdDOM.textContent.substring(6);
        let orderPrice = parseInt(
            orderDOM.querySelector(".order__price").textContent
        );
        let headers = {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        };

        ServerRequest.execute(
            `order/${orderId}`,
            (data) => processStore(data, orderDOM, orderPrice),
            "delete",
            null,
            null,
            headers
        );
    });
});

// обработать ответ сервера об удалении заказа
function processStore(data, orderDOM, orderPrice) {
    try {
        responseData = JSON.parse(data);
        if (responseData.result == 1) {
            orderDOM.remove();
            // обновлена общая стоимость всех заказов
            let totalPrice = totalPriceDOM.textContent;
            totalPrice = totalPrice.substring(0, totalPrice.length - 5);
            totalPrice = parseInt(totalPrice);
            let reminder = totalPrice - orderPrice;
            if (reminder !== 0) {
                totalPriceDOM.textContent = reminder + " руб.";
            } else {
                // если удалены все заказы, меняется видимость компонентов
                totalPriceHeaderDOM.classList.add("hidden");
                totalPriceDOM.classList.add("hidden");
                emptyOrderListDOM.classList.remove("hidden");
            }
        } else {
            alert("Серверная ошибка удаления заказа. Повторите позже");
        }
    } catch (exc) {
        alert(exc);
    }
}
