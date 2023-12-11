const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  dateClicked = document.getElementById("clickedDate"),
  timelist = document.getElementById("time-list");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();
let clickedDate;

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

function addListner() {
  const days = document.querySelectorAll(".day");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const clickedDay = parseInt(e.target.innerHTML, 10);
      const currentDate = new Date();

      clickedDate = new Date();
      clickedDate.setHours(0, 0, 0, 0); // Set hours to beginning of the day for accurate comparison

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

      // Remove 'active' class from all days
      days.forEach((d) => {
        d.classList.remove("active");
      });

      // Add 'active' class to the clicked day
      e.target.classList.add("active");

      // Use history.pushState to update the URL with only the date
      updateURL(updatedDate);
    });
  });
}

function updateURL(date) {
  const formattedDate = date.toLocaleDateString("en-US", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  });
  const formattedDateWithDay = date.toLocaleDateString("en-US", {
    weekday: "short",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
  const newURL =
    window.location.origin +
    window.location.pathname +
    "?date=" +
    formattedDate;
  window.history.replaceState({ path: newURL }, "", newURL);
  dateClicked.innerHTML = formattedDateWithDay;
  document.cookie = "updatedDate=" + encodeURIComponent(newURL) + "; path=/";
  // location.href = newURL;
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
  }
}
