'use strict';

{
  const nums = document.querySelectorAll('.cart-num');

  // 購入数量変更するとフォームの値を送信する
  nums.forEach(num => {
    num.addEventListener('input', () => {
      num.parentNode.submit();
    });
  });
}
