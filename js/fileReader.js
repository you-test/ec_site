'use strict';

{
  //新規登録における画像のプレビュー表示
  const imageForm = document.getElementById('image');
  imageForm.addEventListener('change', (e) => {
    let fileReader = new FileReader();
    fileReader.addEventListener('load', (e) => {
      document.getElementById('preview').src = e.target.result;
    });
    fileReader.readAsDataURL(e.target.files[0]);
  });
}
