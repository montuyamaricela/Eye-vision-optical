const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  dateClicked = document.getElementById("clickedDate"),
  timelist = document.getElementById("time-list"),
  appointmentCalendar = document.getElementById("appointmentCalendar"),
  appointmentForm = document.getElementById("appointment-form");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();
let clickedDate;
let occupiedDate;
let occupiedTime;

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    // previous date sa previous month
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day

    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      days += `<div class="day today active">${i}</div>`;
    } else {
      days += `<div class="day ">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;

  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }

  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

// Function to send the clicked date to PHP
function sendClickedDateToPHP(clickedDate) {
  fetch("appointment.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "clickedDate=" + encodeURIComponent(clickedDate),
  })
    .then((response) => response.json())
    .then((data) => {
      // Handle the response from the PHP script
      occupiedDate = data.schedules;
      occupiedTime = data.times;
      displayTimeSlots(occupiedTime);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function addListner() {
  const days = document.querySelectorAll(".day");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const clickedDay = parseInt(e.target.innerHTML, 10);
      const currentDate = new Date();

      if (e.target.classList.contains("prev-date")) {
        const updatedDate = new Date(year, month, clickedDay);
        updatedDate.setHours(0, 0, 0, 0);
        prevMonth();
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
      }

      // Update the 'clickedDate' after month change
      const updatedDate = new Date(year, month, clickedDay);

      updatedDate.setHours(0, 0, 0, 0); // Set hours to beginning of the day
      if (currentDate > updatedDate) {
        if (e.target.classList.contains("prev-date")) {
          nextMonth();
        }
      }

      displayTimeList(updatedDate);
      // const formattedClickedDate = updatedDate
      //   .toLocaleDateString("en-US", {
      //     year: "numeric",
      //     month: "numeric",
      //     day: "numeric",
      //   })
      //   .replace(/\//g, "-"); // Replace slashes with dashes
      const formattedClickedDate = `${updatedDate.getUTCFullYear()}-${(
        updatedDate.getUTCMonth() + 1
      )
        .toString()
        .padStart(2, "0")}-${updatedDate
        .getUTCDate()
        .toString()
        .padStart(2, "0")}`;

      sendClickedDateToPHP(formattedClickedDate);
      const formattedDateWithDay = updatedDate.toLocaleDateString("en-US", {
        weekday: "short",
        year: "numeric",
        month: "long",
        day: "numeric",
      });
      clickedDate = formattedClickedDate;

      dateClicked.innerHTML = formattedDateWithDay;

      // Remove 'active' class from all days
      days.forEach((d) => {
        d.classList.remove("active");
      });

      // Add 'active' class to the clicked day
      e.target.classList.add("active");
    });
  });
}

function displayTimeList(clickedDate) {
  const currentDate = new Date();

  // Set hours, minutes, seconds, and milliseconds to 0 for accurate date comparison
  currentDate.setHours(0, 0, 0, 0);
  clickedDate.setHours(0, 0, 0, 0);

  // Compare the dates
  if (clickedDate > currentDate) {
    // Display the time list
    timelist.style.display = "block";
  } else {
    timelist.style.display = "none";
    appointmentForm.style.display = "none";
  }
}

function displayTimeSlots(occupiedTime) {
  const timeList = document.getElementById("timeList");
  const startHour = 10;
  const endHour = 16;

  // Clear existing content in the timeList div
  timeList.innerHTML = "";

  // Loop through the hours and add time slots to the timeList div
  for (let hour = startHour; hour <= endHour; hour++) {
    // Convert to 12-hour format
    const hour12 = hour % 12 === 0 ? 12 : hour % 12;

    // Determine whether it's AM or PM
    const period = hour < 12 ? "AM" : "PM";

    // Create a formatted time string
    const timeString = `${hour12}:00${period}`;
    // Skip displaying occupied times
    if (occupiedTime.includes(timeString)) {
      continue;
    }

    // Create a new time container div
    const timeContainer = document.createElement("div");
    timeContainer.className = "time-container";
    timeContainer.textContent = timeString;
    timeContainer.onclick = function () {
      displayForm(timeString);
    };

    // Append the time container to the timeList div
    timeList.appendChild(timeContainer);
  }
}

const appointmentDate = document.getElementById("appointmentDate"),
  appointmentTime = document.getElementById("appointmentTime");

function displayForm(selectedTime) {
  // alert("Form will be displayed for: " + selectedTime);
  appointmentForm.style.display = "block";
  timelist.style.display = "none";
  console.log(clickedDate);
  appointmentDate.value = clickedDate;
  appointmentTime.value = selectedTime;
  // You can replace the alert with your code to display the form
}
