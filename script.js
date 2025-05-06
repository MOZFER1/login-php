document.addEventListener('DOMContentLoaded', () => {
    let cartCount = 0;
    const cart = document.querySelector('.cart-link');
    const addToCartButtons = document.querySelectorAll('.product button');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // إضافة الفئة للتحريك
            button.classList.add('sendtocart');
            
            // إضافة عنصر السلة المتحرك
            const cartItem = document.createElement('span');
            cartItem.classList.add('cart-item');
            button.appendChild(cartItem);

            // تحديث عدد العناصر في السلة
            cartCount++;
            cart.setAttribute('data-totalitems', cartCount);

            // إضافة تأثير الاهتزاز للسلة
            setTimeout(() => {
                cart.classList.add('shake');
            }, 1000);

            // إزالة الفئات بعد انتهاء التحريك
            setTimeout(() => {
                button.removeChild(cartItem);
                button.classList.remove('sendtocart');
                cart.classList.remove('shake');
            }, 1500);
        });
    });
});