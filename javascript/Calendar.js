const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventSubmit = document.querySelector(".add-event-btn ");

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

const eventsArr = [];
getEvents();

console.log(eventsArr);

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
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      if (event) {
        // if meron event sa current date.
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        // if meron event sa current date
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
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

  // if (clickedDate < today) {
  //   console.log("hehe");
  // }
  // console.log(clickedDate < today);
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

// prev.addEventListener("click", prevMonth);
// next.addEventListener("click", nextMonth);

initCalendar();

// function getActiveDay(date) {
//   const day = new Date(year, month, date);
//   const dayName = day.toString().split(" ")[0];
//   eventDay.innerHTML = dayName;
//   eventDate.innerHTML = date + " " + months[month] + " " + year;
// }

//function to add active on day
// function addListner() {
//   const days = document.querySelectorAll(".day");
//   days.forEach((day) => {
//     day.addEventListener("click", (e) => {
//       clickedDate = new Date(year, month, e.target.innerHTML);
//       const currentDate = new Date();

//       activeDay = Number(e.target.innerHTML);

//       //remove active
//       days.forEach((day) => {
//         day.classList.remove("active");
//       });
//       //if clicked prev-date or next-date switch to that month
//       if (e.target.classList.contains("prev-date")) {
//         prevMonth();

//         //add active to clicked day afte month is change
//         setTimeout(() => {
//           //add active where no prev-date or next-date
//           const days = document.querySelectorAll(".day");
//           days.forEach((day) => {
//             if (
//               !day.classList.contains("prev-date") &&
//               day.innerHTML === e.target.innerHTML
//             ) {
//               // day.classList.add("active");
//               clickedDate = new Date(year, month, day.innerHTML);
//               return clickedDate;
//               // console.log(clickedDate > currentDate);
//             }
//           });
//         }, 100);
//       } else if (e.target.classList.contains("next-date")) {
//         // nextMonth();
//         //add active to clicked day afte month is changed
//         setTimeout(() => {
//           const days = document.querySelectorAll(".day");
//           days.forEach((day) => {
//             if (
//               !day.classList.contains("next-date") &&
//               day.innerHTML === e.target.innerHTML
//             ) {
//               day.classList.add("active");
//               clickedDate = new Date(year, month, day.innerHTML);
//               return clickedDate;
//             }
//           });
//         }, 100);
//       } else {
//         e.target.classList.add("active");
//       }
//       console.log(clickedDate);

//     });
//   });
// }

function addListner() {
  const days = document.querySelectorAll(".day");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const clickedDay = parseInt(e.target.innerHTML, 10);
      const currentDate = new Date();

      const clickedDate = new Date(year, month, clickedDay);
      clickedDate.setHours(0, 0, 0, 0); // Set hours to beginning of the day for accurate comparison

      // if (clickedDate <= currentDate) {
      //   // Prevent setting clickedDate for past or today's dates
      //   return;
      // }
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
        e.classList.remove("active");
      }

      // Remove 'active' class from all days
      days.forEach((d) => {
        d.classList.remove("active");
      });

      // Add 'active' class to the clicked day
      e.target.classList.add("active");
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

// dateInput.addEventListener("input", (e) => {
//   dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
//   if (dateInput.value.length === 2) {
//     dateInput.value += "/";
//   }
//   if (dateInput.value.length > 7) {
//     dateInput.value = dateInput.value.slice(0, 7);
//   }
//   if (e.inputType === "deleteContentBackward") {
//     if (dateInput.value.length === 3) {
//       dateInput.value = dateInput.value.slice(0, 2);
//     }
//   }
//   console.log("ito");
// });

// gotoBtn.addEventListener("click", gotoDate);

// function gotoDate() {
//   console.log("here");
//   const dateArr = dateInput.value.split("/");
//   if (dateArr.length === 2) {
//     if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
//       month = dateArr[0] - 1;
//       year = dateArr[1];
//       initCalendar();
//       return;
//     }
//   }
//   alert("Invalid Date");
// }

//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}

//function to get events from local storage
function getEvents() {
  //check if events are already saved in local storage then return event else nothing
  if (localStorage.getItem("events") === null) {
    return;
  }
  eventsArr.push(...JSON.parse(localStorage.getItem("events")));
}
