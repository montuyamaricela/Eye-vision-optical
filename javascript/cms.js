const fileInput = document.querySelector('input[name="LogoImage"]');

// Get the image element where the uploaded image will be displayed
const LogoImage = document.getElementById("uploadimage").querySelector("img");

// Add event listener for file input change
fileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    // If a file is selected, display the image
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      LogoImage.src = e.target.result;
      // hides the profile icon and display the profile image
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
  // Reset the input value to allow re-uploading the same image
});

function uploadLogo() {
  let form = document.getElementById("upload-logo");
  let input = document.getElementById("logoImage").value;
  if (input) {
    form.submit();
  } else {
    alert("No Image uploaded");
  }
}

const backgroundFileInput = document.querySelector(
  'input[name="backgroundImage"]'
);

// Get the image element where the uploaded image will be displayed
const BackgroundImage = document
  .getElementById("UploadedBackgroundImage")
  .querySelector("img");

// Add event listener for file input change
backgroundFileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    // If a file is selected, display the image
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      BackgroundImage.src = e.target.result;
      // hides the profile icon and display the profile image
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
  // Reset the input value to allow re-uploading the same image
});

function uploadBackground() {
  let form = document.getElementById("upload-background");
  let input = document.getElementById("backgroundImage").value;
  if (input) {
    form.submit();
  } else {
    alert("No Image uploaded");
  }
}

function updateColor() {
  let form = document.getElementById("update-color");
  let dark = document.getElementById("dark-color").value;
  let light = document.getElementById("light-color").value;
  console.log("dark:", dark);
  console.log("light:", light);
  form.submit();
}

const slideshowFileInput = document.querySelector(
  'input[name="slideshowImage"]'
);

// Get the image element where the uploaded image will be displayed
const slideshowImage = document
  .getElementById("uploadedImageSlideshow")
  .querySelector("img");

// Add event listener for file input change
slideshowFileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    // If a file is selected, display the image
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      slideshowImage.src = e.target.result;
      // hides the profile icon and display the profile image
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
  // Reset the input value to allow re-uploading the same image
});

function uploadSlideShowImage() {
  let form = document.getElementById("upload-slideshow-image");
  let input = document.getElementById("slideshowImage").value;
  if (input) {
    form.submit();
  } else {
    alert("No Image uploaded");
  }
}

function deleteSlideShowImage(id) {
  let form = document.getElementById("delete-slideshow-image-" + id);
  form.submit();
}
