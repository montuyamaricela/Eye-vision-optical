function faqHandler(question) {
  const faqItem = question.closest(".faq-item");
  const plus = faqItem.querySelector(".plus");
  const isOpen = faqItem.classList.contains("open");

  if (isOpen) {
    faqItem.classList.remove("open");
    plus.style.transform = "rotate(0deg)";
  } else {
    faqItem.classList.add("open");
    plus.style.transform = "rotate(45deg)";
  }
}

function filterHandler(category) {
  const categoryItem = category.closest(".sidebar-item");
  const isOpen = categoryItem.classList.contains("open");

  if (isOpen) {
    categoryItem.classList.remove("open");
  } else {
    categoryItem.classList.add("open");
  }
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}

function scrollToAbout() {
  window.scrollTo(0, 720);
}

function displayDescription(desc) {
  const descItem = desc.closest(".product-description");
  const plus = descItem.querySelector(".plus");
  const isOpen = descItem.classList.contains("open");

  if (isOpen) {
    descItem.classList.remove("open");
    plus.style.transform = "rotate(0deg)";
  } else {
    descItem.classList.add("open");
    plus.style.transform = "rotate(45deg)";
  }
}
document.addEventListener("DOMContentLoaded", function () {
  let grandTotalElement = document.getElementById("grand-total");
  let quantityInput = document.getElementById("quantity");

  // Get the initial price when the page loads
  let initialPrice = parseFloat(
    grandTotalElement
      .querySelector(".detail-black")
      .textContent.replace(/[^\d.]/g, "")
  );
  document.getElementById("quantityTotal").value = quantityInput.value;
  document.getElementById("grandTotal").value = initialPrice;

  function updateGrandTotal() {
    // Get the current quantity value
    let quantity = parseInt(quantityInput.value);

    // Perform the calculation: new total = initial price * quantity
    let newTotal = initialPrice * quantity;
    // Update the content of the grand total span
    grandTotalElement.querySelector(
      ".detail-black"
    ).textContent = `₱${newTotal.toFixed(2)}`;
    document.getElementById("grandTotal").value = newTotal.toFixed(2);
  }

  // Event listener for quantity input
  quantityInput.addEventListener("input", updateGrandTotal);

  function addQuantity() {
    let value = parseInt(quantityInput.value);
    let maxValue = parseInt(quantityInput.max);

    if (value < maxValue) {
      value++;
      quantityInput.value = value;
      updateGrandTotal();
      document.getElementById("quantityTotal").value = value;
    } else {
      alert("Quantity is over the stock available for this product");
    }
  }

  function minusQuantity() {
    let value = parseInt(quantityInput.value);
    if (quantityInput.value > 1) {
      value--;
      quantityInput.value = value;
      updateGrandTotal();
      document.getElementById("quantityTotal").value = value;
    }
  }

  // Event listeners for quantity buttons
  document.getElementById("add-button").addEventListener("click", addQuantity);
  document
    .getElementById("minus-button")
    .addEventListener("click", minusQuantity);

  // Call the function initially
  updateGrandTotal();
});

function redirectToLogin() {
  location.href = "login.php";
  alert("You need to login first");
}
