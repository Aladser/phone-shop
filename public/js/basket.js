// массив форм смартфонов
const phoneFormArr = document.querySelectorAll('.form-add-to-basket');
// добавление товара в корзину
phoneFormArr.forEach(form => form.addEventListener('submit', function(e){
    e.preventDefault();
    console.log(this);
}));