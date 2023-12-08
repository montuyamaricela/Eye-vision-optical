// Assuming selectedProducts is defined globally or in a shared scope
let selectedProducts = [];

// Function to add a product to the checkout array
function addProductToCheckout(productID, productName, productPrice, stock) {
  // Check if the product with the same productID already exists
  let existingProductIndex = selectedProducts.findIndex(
    (product) => product.productID === productID
  );

  if (existingProductIndex !== -1) {
    // Product already exists, update the quantity
    if (selectedProducts[existingProductIndex].ProductQuantity < stock) {
      selectedProducts[existingProductIndex].ProductQuantity += 1;
    } else {
      // Quantity exceeds stock, update to available stock
      selectedProducts[existingProductIndex].ProductQuantity = stock;
      console.log(selectedProducts[existingProductIndex].ProductQuantity);
      alert("Quantity exceeds available stock. Updated to available stock.");
    }
  } else {
    // Product does not exist, add it to the array
    let product = {
      productID: productID,
      productName: productName,
      productPrice: productPrice,
      ProductQuantity: 1,
      Stock: stock,
    };

    selectedProducts.push(product);
  }

  // Update the checkout table
  updateCheckoutTable();
}

// Function to update the checkout table
function updateCheckoutTable() {
  // Get the table body
  let tableBody = document.getElementById("checkout-table-body");

  // Clear the table
  tableBody.innerHTML = "";

  // Iterate over selected products and add rows to the table
  for (let i = 0; i < selectedProducts.length; i++) {
    let product = selectedProducts[i];
    let row = document.createElement("tr");
    row.innerHTML =
      "<td><button class='remove-item' onclick='removeProduct(" +
      i +
      ")'>   <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' width='17'> <path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' /> </svg></button></td>" +
      "<td>" +
      product.productName +
      "</td>" +
      "<td>" +
      "<div class='quantity-counter'>" +
      "<span style='cursor: pointer' id='minus-button' onclick='decreaseQuantity(" +
      i +
      ")'>" +
      "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='#3f61ad'" +
      "height='20px'>" +
      "<path stroke-linecap='round' stroke-linejoin='round' d='M18 12H6' />" +
      "</svg>" +
      "</span>" +
      "<input type='number' id='quantity' value='" +
      product.ProductQuantity +
      "' max='" +
      product.Stock +
      "' onkeydown='disableEnterNumber()'>" +
      "<span style='cursor: pointer' id='add-button' onclick='increaseQuantity(" +
      i +
      ")'>" +
      "<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='#3f61ad'" +
      "height=' 20px'>" +
      "<path stroke-linecap='round' stroke-linejoin='round' d='M12 6v12m6-6H6' />" +
      "</svg>" +
      "</span>" +
      "</div>" +
      //   product.ProductQuantity +
      "</td>" +
      "<td>₱" +
      product.productPrice * product.ProductQuantity +
      "</td>";
    tableBody.appendChild(row);
  }

  // Update the total
  updateTotal();
}

// Function to remove a product from the array and update the table
function removeProduct(index) {
  selectedProducts.splice(index, 1);
  updateCheckoutTable();

  // Update localStorage after removal
  updateLocalStorage();
}

// Function to update the total
function updateTotal() {
  let total = 0;

  // Iterate over selected products and calculate the total
  for (let i = 0; i < selectedProducts.length; i++) {
    total +=
      selectedProducts[i].productPrice * selectedProducts[i].ProductQuantity;
  }

  // Update the total in the table
  document.getElementById("total").innerText = "Total: ₱" + total.toFixed(2);

  // Update localStorage after total change
  updateLocalStorage();
}

// Function to update localStorage
function updateLocalStorage() {
  localStorage.setItem("selectedProducts", JSON.stringify(selectedProducts));
}

// Function to load data from localStorage on page load
function loadDataFromLocalStorage() {
  let storedData = localStorage.getItem("selectedProducts");
  if (storedData) {
    selectedProducts = JSON.parse(storedData);
    updateCheckoutTable();
  }
}

// Load data from localStorage when the page loads
window.addEventListener("load", loadDataFromLocalStorage);

// prevent from entering nunber on the input element
function disableEnterNumber() {
  event.preventDefault();
  return false;
}

// Function to decrease the quantity
function decreaseQuantity(index) {
  if (selectedProducts[index].ProductQuantity > 1) {
    selectedProducts[index].ProductQuantity -= 1;
    updateCheckoutTable();
  }
}

// Function to increase the quantity
function increaseQuantity(index) {
  if (selectedProducts[index].ProductQuantity < selectedProducts[index].Stock) {
    selectedProducts[index].ProductQuantity += 1;
    updateCheckoutTable();
  } else {
    alert("Quantity exceeds available stock.");
  }
}

// Function to handle voiding the transaction
function voidTransaction() {
  // Clear the array of selected products
  selectedProducts = [];

  // Update the checkout table to reflect the changes
  updateCheckoutTable();

  // Set the payment amount to zero
  let paymentInput = document.getElementById("paymentInput");
  paymentInput.value = 0;

  // Set the change amount to zero
  let changeInput = document.getElementById("changeInput");
  changeInput.value = 0;
}

// Function to calculate the change
function calculateChange() {
  // Get the total element and extract the numeric value
  let totalElement = document.getElementById("total");
  let totalText = totalElement.innerText;
  let totalAmount = parseFloat(totalText.replace("Total: ₱", ""));

  // Get the payment amount entered by the user
  let paymentInput = document.getElementById("paymentInput");
  let paymentAmount = parseFloat(paymentInput.value);

  // Check if paymentAmount is a valid number
  if (isNaN(paymentAmount) || paymentAmount < 0) {
    alert("Please enter a valid payment amount.");
    paymentInput.value = 0;

    return;
  }

  // Check if payment is sufficient
  if (paymentAmount < totalAmount) {
    alert("Insufficient payment. Please enter a higher amount.");
    paymentInput.value = 0;
    return;
  }

  // Calculate the change
  let change = paymentAmount - totalAmount;

  // Update the change input field
  let changeInput = document.getElementById("changeInput");
  changeInput.value = change.toFixed(2);

  document.getElementById("calculate").style.display = "none";
  document.getElementById("print").style.display = "flex";
}

function displayPopup() {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("confirmation").style.display = "flex";
}

// close the popup
function closePopup() {
  document.getElementById("popupHeader").style.display = "block";
  document.getElementById("enterPassword").style.display = "none";
  document.getElementById("darkbg").style.display = "none";
  document.getElementById("confirmation").style.display = "none";
  document.getElementById("buttonNo").innerHTML = "No";
  document.getElementById("buttonYes").style.display = "block";
  document.getElementById("buttonSubmit").style.display = "none";
}

function verifyAdmin() {
  document.getElementById("popupHeader").style.display = "none";
  document.getElementById("enterPassword").style.display = "block";
  document.getElementById("buttonNo").innerHTML = "Cancel";
  document.getElementById("buttonYes").style.display = "none";
  document.getElementById("buttonSubmit").style.display = "block";
}

function submit() {
  let form = document.getElementById("verify-admin");
  // get password value
  let password = document.getElementById("password").value;
  if (password) {
    form.submit();
  } else {
    alert("Please enter password");
  }
}

function checkoutProduct() {
  // Create a new array with selected properties
  let simplifiedProducts = selectedProducts.map((product) => {
    return {
      productId: product.productID,
      quantity: product.ProductQuantity,
    };
  });

  // Log the simplifiedProducts array to see the result
  console.log(simplifiedProducts);
  // Set the JSON data as a value of a hidden input field
  document.querySelector("#data-field").value =
    JSON.stringify(simplifiedProducts);

  // Submit the form
  document.getElementById("transaction-success").submit();
  selectedProducts = [];

  // Update the checkout table to reflect the changes
  updateCheckoutTable();
}
