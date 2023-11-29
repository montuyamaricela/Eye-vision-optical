// hide popupMessage

function hidePopupMessage() {
  document.getElementById("dark").style.display = "none";
  document.getElementById("sent").style.display = "none";
  location.href = "../optical/index.php";
}

// onkeydown
function disableEnterNumber() {
  event.preventDefault();
  return false;
}

function removeItem(element) {
  let form = element.querySelector(".remove-form"); // Get the form element
  // Additional logic to handle the removal from the wishlist\
  if (confirm("Are you sure you want to remove?") == true) {
    form.submit(); // Submit the form
  }
}
