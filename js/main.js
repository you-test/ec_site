'use strict';

{
  const nums = document.querySelectorAll('.cart-num');

  // 購入数量変更するとフォームの値を送信する
  nums.forEach(num => {
    num.addEventListener('input', () => {
      num.parentNode.submit();
    });
  });

  //削除ボタン押下時の確認メッセージ
  const deleteBtn = document.getElementById('delete');
  deleteBtn.addEventListener('click', () => {
    if (!confirm('削除してもよろしいですか ??')) {
      return;
    }
    deleteBtn.parentNode.submit();
  });
}
