// Get the file input element
const fileInput = document.querySelector('input[name="image"]');

// Get the image element where the uploaded image will be displayed
const productIimage = document
  .getElementById("productImage")
  .querySelector("img");

// Add event listener for file input change
fileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    // If a file is selected, display the image
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      productIimage.src = e.target.result;
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
});
