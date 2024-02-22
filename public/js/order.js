// кнопки удаления заказов
const orderRemoveButtonDOMArr = document.querySelectorAll(
    ".order__remove-button"
);
orderRemoveButtonDOMArr.forEach((buttonDOM) => {
    buttonDOM.addEventListener("click", function () {
        let orderDOM = this.closest(".order");
        let orderIdDOM = orderDOM.querySelector(".order__id");
        let orderId = orderIdDOM.textContent.substring(7);
        let headers = {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        };

        ServerRequest.execute(
            `order/${orderId}`,
            (data) => processStore(data),
            "delete",
            null,
            null,
            headers
        );
    });
});

// обработать ответ сервера об удалении заказа
function processStore(data) {
    console.log(data);
}
