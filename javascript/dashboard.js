document
  .getElementById("header-checkbox")
  .addEventListener("change", function () {
    var headerCheckbox = document.getElementById("header-checkbox");
    var dataCheckboxes = document.querySelectorAll(".data-checkbox");

    for (var i = 0; i < dataCheckboxes.length; i++) {
      dataCheckboxes[i].checked = headerCheckbox.checked;
    }
  });

function cancelAppointments() {
  const dataCheckboxes = document.querySelectorAll(".data-checkbox:checked");
  const allData = [];
  for (const checkbox of dataCheckboxes) {
    const row = checkbox.closest("tr");
    const rowData = row.querySelector("td:nth-child(2)").textContent;
    allData.push(rowData);
  }

  // Set the JSON data as a value of a hidden input field
  document.querySelector("#data-field").value = JSON.stringify(allData);
  // Submit the form
  document.getElementById("appointments-form").submit();
}

function checkAndDisplayPopup() {
  var dataCheckboxes = document.querySelectorAll(".data-checkbox");
  var atLeastOneChecked = false;

  for (var i = 0; i < dataCheckboxes.length; i++) {
    if (dataCheckboxes[i].checked) {
      atLeastOneChecked = true;
      break; // Exit the loop early if at least one checkbox is checked.
    }
  }

  if (atLeastOneChecked) {
    displayPopup();
  } else {
    document.getElementById("popupHeader").innerHTML = "No Selected Row/s";
    document.getElementById("buttonRow").innerHTML =
      "<button class='buttonYes' onclick='closePopup()'>Close</button>";
    displayPopup();
  }
}

function displayPopup() {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("confirmation").style.display = "flex";
}

function closePopup() {
  document.getElementById("darkbg").style.display = "none";
  document.getElementById("confirmation").style.display = "none";
  location.reload();
}

function displayUserDetails(button) {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("editModal").style.display = "block";

  // Traverse the DOM to access the details related to the clicked button
  let row = button.closest("tr"); // Get the row associated with the clicked button
  let cells = row.getElementsByTagName("td"); // Get all <td> elements in that row

  // Extract the data from the cells
  let id = cells[0].innerText;
  let name = cells[1].innerText;
  let email = cells[2].innerText;
  let password = cells[3].innerText;
  let phone = cells[4].innerText;
  let address = cells[5].innerText;
  let Avatar = cells[6];
  let status = cells[7].innerText;

  let image = Avatar.querySelector("img"); // Assuming the image is contained within a <td> cell

  if (image && image.style.display !== "none") {
    let imageSrc = image.getAttribute("src");
    const imageElement = document
      .getElementById("profileImage")
      .querySelector("img");
    imageElement.src = imageSrc;

    // Do something with the image source, like assigning it to an <img> tag src attribute
    document.getElementById("profileIcon").style.display = "none";
    document.getElementById("profileImage").style.display = "block";
  } else {
    let letter = name.slice(0, 1).toUpperCase();
    document.getElementById("Name").innerHTML = letter;
  }

  document.getElementById("id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("email").value = email;
  document.getElementById("password").value = password;

  document.getElementById("phone").value = phone;
  document.getElementById("address").value = address;
  document.getElementById("status").value = status;

  const fileInput = document.querySelector('input[name="image"]');
  const imageElement = document
    .getElementById("profileImage")
    .querySelector("img");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imageElement.src = e.target.result;

        document.getElementById("profileIcon").style.display = "none";
        document.getElementById("profileImage").style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });
}

function deleteAccount(id) {
  location.href = "delete-user-account.php?id=" + id;
}

function displayConfirmation(button) {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("confirmation").style.display = "flex";

  let row = button.closest("tr"); // Get the row associated with the clicked button
  let id = row.querySelector("td:first-child").innerText; // Get the text from the first cell in the row

  // Implement a confirmation action, for example, with an "onclick" event on a confirm button in the confirmation dialog
  document.getElementById("confirmButton").onclick = function () {
    deleteAccount(id);
  };
}

function displayProductCategoryDetails(button) {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("category_editModal").style.display = "block";

  // Traverse the DOM to access the details related to the clicked button
  let row = button.closest("tr"); // Get the row associated with the clicked button
  let cells = row.getElementsByTagName("td"); // Get all <td> elements in that row

  // Extract the data from the cells
  let id = cells[0].innerText;
  let categoryname = cells[1].innerText;

  document.getElementById("id").value = id;

  document.getElementById("category_name").value = categoryname;
}

function displayCategoryDeleteConfirmation(button) {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("confirmation").style.display = "flex";

  let row = button.closest("tr"); // Get the row associated with the clicked button
  let id = row.querySelector("td:first-child").innerText; // Get the text from the first cell in the row

  // Implement a confirmation action, for example, with an "onclick" event on a confirm button in the confirmation dialog
  document.getElementById("confirmButton").onclick = function () {
    deleteCategory(id);
  };
}

function deleteCategory(id) {
  location.href = "delete-category.php?id=" + id;
}

function displayProductsDetails(button) {
  document.getElementById("darkbg").style.display = "flex";
  document.getElementById("addProductModal").style.display = "block";

  // Traverse the DOM to access the details related to the clicked button
  let row = button.closest("tr"); // Get the row associated with the clicked button
  let cells = row.getElementsByTagName("td"); // Get all <td> elements in that row

  // Extract the data from the cells
  let id = cells[1].innerText;
  let productName = cells[2].innerText;
  let price = cells[3].innerText;
  let color = cells[4].innerText;
  let category = cells[5].innerText;
  let description = cells[6].innerText;
  let image = cells[7];
  let stock = cells[8].innerText;

  document.getElementById("id").value = id;
  document.getElementById("code").value = id;
  document.getElementById("name").value = productName;
  document.getElementById("price").value = price;
  document.getElementById("color").value = color;
  document.getElementById("category").value = category;
  document.getElementById("description").value = description;
  document.getElementById("stock").value = stock;

  let productImage = image.querySelector("img"); // Assuming the image is contained within a <td> cell
  console.log(productImage);
  if (productImage && productImage.style.display !== "none") {
    let imageSrc = productImage.getAttribute("src");
    const imageElement = document
      .getElementById("productImage")
      .querySelector("img");
    imageElement.src = imageSrc;
    // Do something with the image source, like assigning it to an <img> tag src attribute
  }

  const fileInput = document.querySelector('input[name="image"]');
  const imageElement = document
    .getElementById("productImage")
    .querySelector("img");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imageElement.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
}

function deleteProducts() {
  const dataCheckboxes = document.querySelectorAll(".data-checkbox:checked");
  const allData = [];
  for (const checkbox of dataCheckboxes) {
    const row = checkbox.closest("tr");
    const rowData = row.querySelector("td:nth-child(2)").textContent;

    allData.push(rowData);

    console.log(allData);
  }

  // Set the JSON data as a value of a hidden input field
  document.querySelector("#data-field").value = JSON.stringify(allData);
  // Submit the form
  document.getElementById("products-list-form").submit();
}

function directTo(link) {
  location.href = link;
}
