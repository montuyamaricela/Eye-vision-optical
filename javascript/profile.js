// Get the file input element
const fileInput = document.querySelector('input[name="image"]');

// Get the image element where the uploaded image will be displayed
const imageElement = document
  .getElementById("profileImage")
  .querySelector("img");

// Add event listener for file input change
fileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    // If a file is selected, display the image
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      imageElement.src = e.target.result;
      // hides the profile icon and display the profile image
      document.getElementById("profileIcon").style.display = "none";
      document.getElementById("profileImage").style.display = "block";
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
  // Reset the input value to allow re-uploading the same image
});
