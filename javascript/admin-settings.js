const fileInput = document.querySelector('input[name="image"]');
const imageElement = document
  .getElementById("admin-image")
  .querySelector("img");

fileInput.addEventListener("change", function () {
  const file = this.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      imageElement.src = e.target.result;
    };
    console.log(imageElement.src);
    reader.readAsDataURL(file);
  }
});
