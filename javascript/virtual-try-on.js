// Get the file input element
const fileInput = document.querySelector('input[name="image"]');

// Get the image element where the uploaded image will be displayed
const imageElement = document.getElementById("user-image").querySelector("img");

// Function to set the source of the image element
function setImageSource(src) {
  imageElement.src = src;
}

// Function to handle filter click
function handleFilterClick(event) {
  event.preventDefault();

  // Remove the "active" class from all filter links
  filterLinks.forEach((link) => {
    link.classList.remove("filter-item-active");
  });

  // Apply your filter logic here...
  event.target.classList.add("filter-item-active");

  // After filtering, reapply the uploaded image if it exists in sessionStorage
  const uploadedImageSrc = sessionStorage.getItem("uploadedImageSrc");
  if (uploadedImageSrc) {
    setImageSource(uploadedImageSrc);
  }

  // Add the "active" class to the clicked link
  event.target.classList.add("active");

  // Manually update the URL without triggering a page reload
  const filterCategory = event.target.getAttribute("data-category");
  if (filterCategory) {
    const newUrl = `${window.location.pathname}?category=${filterCategory}`;
    window.history.pushState({ path: newUrl }, "", newUrl);
  }

  // Trigger a page reload
  window.location.reload();
}

// Add event listener for file input change
fileInput.addEventListener("change", function () {
  const file = this.files[0]; // Get the uploaded file
  if (file) {
    const reader = new FileReader(); // Create a FileReader
    reader.onload = function (e) {
      // Set the source of the image element to the uploaded file
      const uploadedImageSrc = e.target.result;

      // Always set the image source from the uploaded file
      setImageSource(uploadedImageSrc);

      // Store the image source in sessionStorage
      sessionStorage.setItem("uploadedImageSrc", uploadedImageSrc);
    };
    reader.readAsDataURL(file); // Read the file as a data URL
  }
});

// Example filter click event
const filterLinks = document.querySelectorAll(".filter-item");

filterLinks.forEach((link) => {
  link.addEventListener("click", handleFilterClick);
});

// Retrieve and display the uploaded image when the page loads
document.addEventListener("DOMContentLoaded", function () {
  const uploadedImageSrc = sessionStorage.getItem("uploadedImageSrc");
  if (uploadedImageSrc) {
    setImageSource(uploadedImageSrc);
  }
});



// open camera
function openCam() {
  document.getElementById("user-image").style.display = "none";
  document.getElementById("user-camera").style.display = "block";

  let All_mediaDevices = navigator.mediaDevices;
  if (!All_mediaDevices || !All_mediaDevices.getUserMedia) {
    console.log("getUserMedia() not supported.");
    return;
  }
  All_mediaDevices.getUserMedia({
    audio: true,
    video: true,
  })
    .then(function (vidStream) {
      var video = document.getElementById("videoCam");
      if ("srcObject" in video) {
        video.srcObject = vidStream;
      } else {
        video.src = window.URL.createObjectURL(vidStream);
      }
      video.onloadedmetadata = function (e) {
        video.play();
      };
    })
    .catch(function (e) {
      console.log(e.name + ": " + e.message);
    });
}


// display image
function displayImage() {
  document.getElementById("user-image").style.display = "block";
  document.getElementById("user-camera").style.display = "none";
}




// drag and drop image
function startDrag(e) {
  // calculate event X, Y coordinates
  const offsetX = e.clientX;
  const offsetY = e.clientY;

  // IE uses srcElement, others use target
  const targ = e.target || e.srcElement;

  if (targ.className !== "dragme") {
    return;
  }

  // assign default values for top and left properties
  if (!targ.style.left) {
    targ.style.left = "0px";
  }
  if (!targ.style.top) {
    targ.style.top = "0px";
  }

  // calculate integer values for top and left properties
  const coordX = parseInt(targ.style.left);
  const coordY = parseInt(targ.style.top);

  // move div element
  document.onmousemove = function (event) {
    dragDiv(event, targ, offsetX, offsetY, coordX, coordY);
  };
}

function dragDiv(e, targ, offsetX, offsetY, coordX, coordY) {
  // move div element
  targ.style.left = coordX + e.clientX - offsetX + "px";
  targ.style.top = coordY + e.clientY - offsetY + "px";
  return false;
}

function stopDrag() {
  document.onmousemove = null;
}

window.onload = function () {
  document.onmousedown = startDrag;
  document.onmouseup = stopDrag;
};
