function removeCart() {
  document.getElementById("remove-product").submit();
}

document.addEventListener("DOMContentLoaded", function () {
  // Get all the product containers on the page
  const productContainers = document.querySelectorAll(".product.cart-items");
  let allTotal = 0;

  function updateGrandTotal(productContainer) {
    const grandTotalElement = productContainer.querySelector(".grand-total");
    const quantityInput = productContainer.querySelector(
      ".quantity-counter input"
    );

    const price = parseFloat(
      productContainer
        .querySelector(".initial-price")
        .textContent.replace(/[^\d.]/g, "")
    );
    const quantity = parseInt(quantityInput.value);

    const newTotal = price * quantity;

    grandTotalElement.textContent = `₱${newTotal.toFixed(2)}`;
  }

  function addQuantity(productContainer) {
    const quantityInput = productContainer.querySelector(
      ".quantity-counter input"
    );
    let value = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.max);

    if (value < maxValue) {
      value++;
      quantityInput.value = value;
      updateGrandTotal(productContainer);
    } else {
      alert("Quantity is over the stock available for this product");
    }
  }

  function minusQuantity(productContainer) {
    const quantityInput = productContainer.querySelector(
      ".quantity-counter input"
    );
    let value = parseInt(quantityInput.value);
    if (quantityInput.value > 1) {
      value--;
      quantityInput.value = value;
      updateGrandTotal(productContainer);
    }
  }

  // Event listeners for quantity buttons for each product
  productContainers.forEach((productContainer) => {
    const addBtn = productContainer.querySelector(
      ".quantity-counter #add-button"
    );
    const minusBtn = productContainer.querySelector(
      ".quantity-counter #minus-button"
    );

    addBtn.addEventListener("click", function () {
      addQuantity(productContainer);
      calculateTotal();
    });

    minusBtn.addEventListener("click", function () {
      minusQuantity(productContainer);
      calculateTotal();
    });
  });
  productContainers.forEach((productContainer) => {
    updateGrandTotal(productContainer);
  });
});

// check all checkbox
// document
//   .getElementById("header-checkbox")
//   .addEventListener("change", function () {
//     calculateTotal();

//     let headerCheckbox = document.getElementById("header-checkbox");
//     let dataCheckboxes = document.querySelectorAll(".data-checkbox");

//     for (let i = 0; i < dataCheckboxes.length; i++) {
//       dataCheckboxes[i].checked = headerCheckbox.checked;
//     }
//   });

const dataCheckboxes = document.querySelectorAll(".data-checkbox");
dataCheckboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", function () {
    // Call calculateTotal function when a checkbox is checked or unchecked
    calculateTotal();
  });
});

// function checkoutProducts() {
//   const dataCheckboxes = document.querySelectorAll(".data-checkbox:checked");
//   const allData = [];

//   for (const checkbox of dataCheckboxes) {
//     const productId = checkbox.dataset.id;
//     console.log(checkbox.dataset);
//     const rowData = productId;

//     allData.push(rowData);
//     console.log(allData);
//   }

//   if (allData.length === 0) {
//     // No checkboxes are checked, do not submit the form
//     alert("Please select at least one product before checking out.");
//     return; // Stop the function execution
//   }

//   // Set the JSON data as a value of a hidden input field
//   document.querySelector("#data-field").value = JSON.stringify(allData);
//   // Submit the form
//   //document.getElementById("checkoutItems").submit();
// }

function checkoutProducts() {
  const dataCheckboxes = document.querySelectorAll(".data-checkbox:checked");
  const allData = [];

  for (const checkbox of dataCheckboxes) {
    const productId = checkbox.dataset.id;

    // Find the closest parent form
    const form = checkbox.closest("form");

    // Find all quantity inputs within the form
    const quantityInputs = form.querySelectorAll("input[name='quantity']");

    // Find the index of the checkbox within the list of checked checkboxes
    const checkboxIndex = Array.from(
      form.querySelectorAll(".data-checkbox:checked")
    ).indexOf(checkbox);

    // Use the index to get the corresponding quantity input
    const quantityInput = quantityInputs[checkboxIndex];
    const quantity = quantityInput ? quantityInput.value : 1; // Default to 1 if quantity input is not found

    const rowData = {
      productId: productId,
      quantity: quantity,
    };

    allData.push(rowData);
    console.log(allData);
  }

  if (allData.length === 0) {
    // No checkboxes are checked, do not submit the form
    alert("Please select at least one product before checking out.");
    return; // Stop the function execution
  }

  // Set the JSON data as a value of a hidden input field
  document.querySelector("#data-field").value = JSON.stringify(allData);
  // Submit the form
  document.getElementById("checkoutItems").submit();
}

// CALCULATE TOTAL OF CHECKED PRODUCT
function calculateTotal() {
  const checkedCheckboxes = document.querySelectorAll(".data-checkbox:checked");

  let total = 0;

  checkedCheckboxes.forEach((checkbox) => {
    const productContainer = checkbox.closest(".product.cart-items");

    if (productContainer) {
      const price = parseFloat(
        productContainer
          .querySelector(".initial-price")
          .textContent.replace(/[^\d.]/g, "")
      );
      const quantity = parseInt(
        productContainer.querySelector(".quantity-input").value
      );

      total += price * quantity;
    }
  });
  document.getElementById("allTotal").innerHTML = "₱" + total.toFixed(2);

  // console.log("Total: $" + total.toFixed(2));
}

// productContainers.forEach((productContainer) => {
//   const price = parseFloat(
//     productContainer
//       .querySelector(".initial-price")
//       .textContent.replace(/[^\d.]/g, "")
//   );
//   const quantity = parseInt(
//     productContainer.querySelector(".quantity-counter input").value
//   );

//   allTotal += price * quantity;
// });

// // Set the initial grand total
// document.getElementById("allTotal").innerHTML = "₱" + allTotal.toFixed(2);
