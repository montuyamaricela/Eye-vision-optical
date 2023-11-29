function removeCart() {
  document.getElementById("remove-product").submit();
}
// let x = 0;
// let allTotal = 0;
// const originalTotals = []; // Array to store original totals for each product

// document.addEventListener("DOMContentLoaded", function () {
//   // Get all the product containers on the page
//   const productContainers = document.querySelectorAll(".product.cart-items");

//   function updateGrandTotal(productContainer) {
//     const grandTotalElement = productContainer.querySelector(".grand-total");
//     const quantityInput = productContainer.querySelector(
//       ".quantity-counter input"
//     );

//     const price = parseFloat(
//       productContainer
//         .querySelector(".initial-price")
//         .textContent.replace(/[^\d.]/g, "")
//     );

//     const quantity = parseInt(quantityInput.value);

//     const newTotal = price * quantity;

//     allTotal += newTotal;
//     console.log("alltotal:", allTotal);
//     document.getElementById("allTotal").innerHTML = "₱" + allTotal;
//     grandTotalElement.textContent = `₱${newTotal.toFixed(2)}`;
//   }

//   function addQuantity(productContainer) {
//     const quantityInput = productContainer.querySelector(
//       ".quantity-counter input"
//     );
//     let value = parseInt(quantityInput.value);
//     const maxValue = parseInt(quantityInput.max);

//     if (value < maxValue) {
//       value++;
//       quantityInput.value = value;
//       updateGrandTotal(productContainer);
//     } else {
//       alert("Quantity is over the stock available for this product");
//     }
//   }

//   function minusQuantity(productContainer) {
//     const quantityInput = productContainer.querySelector(
//       ".quantity-counter input"
//     );
//     let value = parseInt(quantityInput.value);
//     if (quantityInput.value > 1) {
//       value--;
//       quantityInput.value = value;
//       updateGrandTotal(productContainer);
//     }
//   }

//   // Event listeners for quantity buttons for each product
//   productContainers.forEach((productContainer) => {
//     const quantityInput = productContainer.querySelector(
//       ".quantity-counter input"
//     );
//     const addBtn = productContainer.querySelector(
//       ".quantity-counter #add-button"
//     );      console.log("heeh");

//     const minusBtn = productContainer.querySelector(
//       ".quantity-counter #minus-button"
//     );

//     quantityInput.addEventListener("input", function () {
//       updateGrandTotal(productContainer);
//     });

//     addBtn.addEventListener("click", function () {
//       addQuantity(productContainer);
//     });

//     minusBtn.addEventListener("click", function () {
//       minusQuantity(productContainer);
//     });
//   });

//   // Call the function initially for each product
//   productContainers.forEach((productContainer) => {
//     updateGrandTotal(productContainer);
//   });
// });

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

  // Calculate grand total on page load
  productContainers.forEach((productContainer) => {
    const price = parseFloat(
      productContainer
        .querySelector(".initial-price")
        .textContent.replace(/[^\d.]/g, "")
    );
    const quantity = parseInt(
      productContainer.querySelector(".quantity-counter input").value
    );

    allTotal += price * quantity;
  });

  // Set the initial grand total
  document.getElementById("allTotal").innerHTML = "₱" + allTotal.toFixed(2);

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
    });

    minusBtn.addEventListener("click", function () {
      minusQuantity(productContainer);
    });
  });
  productContainers.forEach((productContainer) => {
    updateGrandTotal(productContainer);
  });
});
