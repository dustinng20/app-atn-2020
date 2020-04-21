const cart = document.getElementById('cart-table');
const totalCart = document.getElementById('total-cart')
let priceList = Array.from(cart.children[1].children);

totalCal();

let incList = document.querySelectorAll('.inc');
let decList = document.querySelectorAll('.dec');

incList.forEach(element => element.addEventListener('click', () => {
    let quantity = element.parentElement.children[1].value;
    let priceEl = element.parentElement.parentElement.parentElement.previousElementSibling;
    let totalEl = element.parentElement.parentElement.parentElement.nextElementSibling;
    let price = parseFloat(priceEl.textContent.replace('$', ''));
    let total = price * quantity;
    totalEl.innerText = '$' + total;
    totalCal();
}));

decList.forEach(element => element.addEventListener('click', () => {
    let quantity = element.parentElement.children[1].value;
    let priceEl = element.parentElement.parentElement.parentElement.previousElementSibling;
    let totalEl = element.parentElement.parentElement.parentElement.nextElementSibling;
    let price = parseFloat(priceEl.textContent.replace('$', ''));
    let total = price * quantity;
    totalEl.innerText = '$' + total;
    totalCal();
}));

function totalCal() {
    let total = 0;
    priceList.forEach(element => total += parseFloat(element.children[3].textContent.replace('$', '')));
    totalCart.innerText = total;
}
