// // sidenav transition-burger

// var sidenav = document.querySelector("aside");
// var sidenav_trigger = document.querySelector("[sidenav-trigger]");
// var sidenav_close_button = document.querySelector("[sidenav-close]");
// var burger = sidenav_trigger.firstElementChild;
// var top_bread = burger.firstElementChild;
// var bottom_bread = burger.lastElementChild;

// sidenav_trigger.addEventListener("click", function () {
//   if (page == "virtual-reality") {
//     sidenav.classList.toggle("xl:left-[18%]");
//   }
//   // sidenav_close_button.classList.toggle("hidden");
//   if (sidenav.getAttribute("aria-expanded") == "false") {
//     sidenav.setAttribute("aria-expanded", "true");
//   } else {
//     sidenav.setAttribute("aria-expanded", "false");
//   }
//   sidenav.classList.toggle("translate-x-0");
//     sidenav.classList.toggle("-translate-x-full");

//   sidenav.classList.toggle("ml-6");
//   sidenav.classList.toggle("shadow-xl");
//   if (page == "rtl") {
//     top_bread.classList.toggle("-translate-x-[5px]");
//     bottom_bread.classList.toggle("-translate-x-[5px]");
//   } else {
//     top_bread.classList.toggle("translate-x-[5px]");
//     bottom_bread.classList.toggle("translate-x-[5px]");
//   }
// });
// sidenav_close_button.addEventListener("click", function () {
//   sidenav_trigger.click();
// });

// window.addEventListener("click", function (e) {
//   if (!sidenav.contains(e.target) && !sidenav_trigger.contains(e.target)) {
//     if (sidenav.getAttribute("aria-expanded") == "true") {
//       sidenav_trigger.click();
//     }
//   }
// });
// sidenav transition-burger
// Argon Sidenav Clean Trigger Script
var sidenav = document.querySelector("aside");
var sidenav_trigger = document.querySelector("[sidenav-trigger]");
var sidenav_close_button = document.querySelector("[sidenav-close]");

if (sidenav_trigger && sidenav) {
  var burger = sidenav_trigger.firstElementChild;
  var top_bread = burger ? burger.firstElementChild : null;
  var bottom_bread = burger ? burger.lastElementChild : null;

  sidenav_trigger.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation(); // Window click handler ko block karta hai instantly

    // Toggle ARIA expanded state
    let isExpanded = sidenav.getAttribute("aria-expanded") === "true";
    sidenav.setAttribute("aria-expanded", !isExpanded);

    // Forcefully handle classes with clean overwrite
    if (sidenav.classList.contains("-translate-x-full")) {
      // Open Sidenav
      sidenav.classList.remove("-translate-x-full");
      sidenav.classList.add("translate-x-0", "shadow-2xl");
      // Z-index adjust taake har cheez ke upar dikhe
      sidenav.style.zIndex = "9999"; 
    } else {
      // Close Sidenav
      sidenav.classList.add("-translate-x-full");
      sidenav.classList.remove("translate-x-0", "shadow-2xl");
    }

    // Burger Bread Animation (Optional but handles crashes safely)
    if (top_bread && bottom_bread) {
      try {
        if (typeof page !== 'undefined' && page == "rtl") {
          top_bread.classList.toggle("-translate-x-[5px]");
          bottom_bread.classList.toggle("-translate-x-[5px]");
        } else {
          top_bread.classList.toggle("translate-x-[5px]");
          bottom_bread.classList.toggle("translate-x-[5px]");
        }
      } catch(err) {}
    }
  });
}

// Close button (Cross icon inside sidebar)
if (sidenav_close_button) {
  sidenav_close_button.addEventListener("click", function (e) {
    e.stopPropagation();
    if (sidenav) {
      sidenav.classList.add("-translate-x-full");
      sidenav.classList.remove("translate-x-0");
      sidenav.setAttribute("aria-expanded", "false");
    }
  });
}

// Outside click handler - close only if user clicks outside sidebar and trigger
window.addEventListener("click", function (e) {
  if (sidenav && sidenav_trigger) {
    if (!sidenav.contains(e.target) && !sidenav_trigger.contains(e.target)) {
      if (sidenav.getAttribute("aria-expanded") === "true" || !sidenav.classList.contains("-translate-x-full")) {
        sidenav.classList.add("-translate-x-full");
        sidenav.classList.remove("translate-x-0");
        sidenav.setAttribute("aria-expanded", "false");
      }
    }
  }
});