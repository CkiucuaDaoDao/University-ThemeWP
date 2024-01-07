// // Method 1: Use the jquery library
// import $ from "jquery";

// class Search {
//   constructor() {
//     // Lay element thao tac
//     this.resultDiv = $("#search-overlay__results");
//     // Lấy phần tử icon search
//     this.openSearch = $(".js-search-trigger");
//     // Lấy phần tử close search
//     this.closeSearch = $(".search-overlay__close");
//     // Search Overlay
//     this.overlay = $(".search-overlay");
//     this.timing;
//     this.searchItem = $("#search-term");

//     this.event();
//     this.spinnerVisible = false;
//     this.isOpen = false;
//     this.previousValue = "";
//   }


//   event() {
//     this.openSearch.on("click", this.openOverlay.bind(this));
//     this.closeSearch.on("click", this.closeOverlay.bind(this));
//     $(document).on("keydown", this.dispatchKeyPress.bind(this));
//     this.searchItem.on("keyup", this.typingLogic.bind(this));
//   }

//   // Typing Logic
//   typingLogic() {
//     if (this.previousValue != this.searchItem.val()) {
//       clearTimeout(this.timing);
//       if (this.searchItem.val()) {
//         if (!this.spinnerVisible) {
//           this.resultDiv.html('<div class="spinner-loader"></div>');
//           this.spinnerVisible = true;
//         }
//         this.timing = setTimeout(this.getResults.bind(this), 2000);
//       } else {
//         this.resultDiv.html("");
//       }
//     }
//     this.previousValue = this.searchItem.val();
//     this.spinnerVisible = false;
//   }

//   // In ra ket qua khi search
//   getResults() {
//     // this.resultDiv.html('Result you need');
//     // this.spinnerVisible = false;
//     // $.when(
//     //   $.getJSON(
//     //     universityData.root_url +
//     //       "/wp-json/wp/v2/posts?search=" +
//     //       this.searchItem.val()
//     //   ),
//     //   $.getJSON(
//     //     universityData.root_url +
//     //       "/wp-json/wp/v2/pages?search=" +
//     //       this.searchItem.val()
//     //   ),
//     //   $.getJSON(
//     //     universityData.root_url +
//     //       "/wp-json/wp/v2/event?search=" +
//     //       this.searchItem.val()
//     //   ),
//     //   $.getJSON(
//     //     universityData.root_url +
//     //       "/wp-json/wp/v2/programmes?search=" +
//     //       this.searchItem.val()
//     //   ),
//     //   $.getJSON(
//     //     universityData.root_url +
//     //       "/wp-json/wp/v2/professors?search=" +
//     //       this.searchItem.val()
//     //   )
//     // ).then((posts, pages, event, program, professor) => {
//     //   var combineResults = posts[0].concat(pages[0], event[0], program[0], professor[0]);
//     //   this.resultDiv.html(`
//     //             <h2 class="search-overlay__section-title">General Information</h2>
//     //             ${
//     //               combineResults.length
//     //                 ? '<ul class="link-list min-list">'
//     //                 : "<p>General Information no match with research</p>"
//     //             }
//     //             ${combineResults
//     //               .map(
//     //                 (item) =>
//     //                   `<li><a href='${item.link}'>${item.title.rendered} ${item.type == "post" ? `by ${item.authorName} </a></li>` : ``}`
//     //               )
//     //               .join("")}
//     //             ${combineResults.length ? "</ul>" : ""}
//     //         `)
//     //         this.spinnerVisible = false;
//     // }, () => {
//     //     this.resultDiv.html("<p>Error Unexpected In Research!!!</p>")
//     // });

//     $.getJSON(
//       universityData.root_url + "/wp-json/university/v1/universities?term=" + this.searchItem.val(),
//       results => {
//         this.resultDiv.html(`
//           <div class="row">
//             <div class="one-third">
//               <h2 class="search-overlay__section-title">General Information</h2>
//               ${results.general_info.length
//                 ? '<ul class="link-list min-list">'
//                 : "<p>General Information no match with research</p>"
//               }
//               ${results.general_info.map((item) => 
//                 `<li><a href='${item.permalink}'>${item.title} ${item.postType == "post" ? `by ${item.authorName} </a></li>` : ``}`
//                 ).join("")}
//               ${results.general_info.length ? "</ul>" : ""}
//             </div>
//             <div class="one-third">
//               <h2 class="search-overlay__section-title">Programmes</h2>
//               ${results.programmes.length
//                 ? '<ul class="link-list min-list">'
//                 : "<p>No match with research</p>"
//               }
//               ${results.programmes.map((item) => 
//                 `<li><a href='${item.permalink}'>${item.title} ${item.postType == "programmes" ? `by ${item.authorName} </a></li>` : ``}`
//                 ).join("")}
//               ${results.programmes.length ? "</ul>" : ""}
//             </div>
//             <div class="one-third">
//               <h2 class="search-overlay__section-title">Professors</h2>
//               ${results.professors.length
//                 ? '<ul class="link-list min-list">'
//                 : "<p>No match with research</p>"
//               }
//               ${results.professors.map((item) => 
//                 `<li class="professor-card__list-item">
//                 <a class="professor-card" href="${item.permalink}">
//                   <img class="professor-card__image" src="${item.image}" alt="">
//                   <span class="professor-card__name">${item.title}</span>
//                 </a>
//               </li>`
//                 ).join("")}
//               ${results.professors.length ? "</ul>" : ""}
//             </div>
//             <div class="one-third">
//               <h2 class="search-overlay__section-title">Events</h2>
//               ${results.events.length
//                 ? '<ul class="link-list min-list">'
//                 : "<p>No match with research</p>"
//               }
//               ${results.events.map((item) => 
//                 `<div class="event-summary">
//                 <a class="event-summary__date t-center" href="${item.permalink}">

//                     <span class="event-summary__month">${item.month}</span>
//                     <span class="event-summary__day">${item.day}</span>
//                 </a>
//                 <div class="event-summary__content">
//                     <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
//                     <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
//                 </div>
//             </div>`
//                 ).join("")}
//               ${results.events.length ? "</ul>" : ""}
//             </div>
//           </div>
//         `)
//         this.spinnerVisible = false
//     })
//   }

//   // Xử lý mở màn che S/ đóng esc
//   dispatchKeyPress(e) {
//     if (e.keyCode == 83 && !this.isOpen) {
//       this.openOverlay();
//     }
//     if (e.keyCode == 27 && this.isOpen) {
//       this.closeOverlay();
//     }
//   }

//   openOverlay() {
//     this.overlay.addClass("search-overlay--active");
//     $("body").addClass("body-no-scroll");
//     this.isOpen = true;
//   }

//   closeOverlay() {
//     this.overlay.removeClass("search-overlay--active");
//     $("body").removeClass("body-no-scroll");
//     this.isOpen = false;
//   }
// }

// export default Search;

// -------------------------------------------------------------------------

// Method 2: Use javascript and axios
import axios from "axios";
class Search {
  constructor() {
    this.addSearchHTML()
    this.resultsDiv = document.querySelector("#search-overlay__results")
    this.openButton = document.querySelectorAll(".js-search-trigger")
    this.closeButton = document.querySelector(".search-overlay__close")
    this.searchOverlay = document.querySelector(".search-overlay")
    this.searchField = document.querySelector("#search-term")
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue = ''
    this.typingTimer
    this.events()
  }

  events() {
    //Open Live Search when click on icon search
    this.openButton.forEach(el => {
      el.addEventListener("click", e => {
        e.preventDefault()
        this.openOverlay()
      })
    });

    //Close Live Search when click on icon search
    this.closeButton.addEventListener("click", () => {
      this.closeOverlay()
    });

    //Press S/ESC to Open/Close Live Search
    document.addEventListener("keydown", e => this.dispatchKeyPress(e));

    this.searchField.addEventListener("keyup", () => this.typingLogic());
}

  //Typing Logic
  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer)

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>'
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.innerHTML = ""
        this.isSpinnerVisible = false
      }
    }

    this.previousValue = this.searchField.value
  }

  //Print results out screen
  async getResults() {
    try {
      const response = await axios.get(universityData.root_url + "/wp-json/university/v1/universities?term=" + this.searchField.value)
      const results = response.data
      this.resultsDiv.innerHTML = `
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${results.general_info.length ? '<ul class="link-list min-list">' : "<p>No general information matches that search.</p>"}
              ${results.general_info.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == "post" ? `by ${item.authorName}` : ""}</li>`).join("")}
            ${results.general_info.length ? "</ul>" : ""}
          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Programs</h2>
            ${results.programmes.length ? '<ul class="link-list min-list">' : `<p>No programs match that search. <a href="${universityData.root_url}/programs">View all programs</a></p>`}
              ${results.programmes.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join("")}
            ${results.programmes.length ? "</ul>" : ""}

            <h2 class="search-overlay__section-title">Professors</h2>
            ${results.professors.length ? '<ul class="professor-cards">' : `<p>No professors match that search.</p>`}
              ${results.professors
          .map(
            item => `
                <li class="professor-card__list-item">
                  <a class="professor-card" href="${item.permalink}">
                    <img class="professor-card__image" src="${item.image}">
                    <span class="professor-card__name">${item.title}</span>
                  </a>
                </li>
              `
          )
          .join("")}
            ${results.professors.length ? "</ul>" : ""}

          </div>
          <div class="one-third">


            <h2 class="search-overlay__section-title">Events</h2>
            ${results.events.length ? "" : `<p>No events match that search. <a href="${universityData.root_url}/events">View all events</a></p>`}
              ${results.events
          .map(
            item => `
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="${item.permalink}">
                    <span class="event-summary__month">${item.month}</span>
                    <span class="event-summary__day">${item.day}</span>  
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                    <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                  </div>
                </div>
              `
          )
          .join("")}

          </div>
        </div>
      `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }

  //Handle
  dispatchKeyPress(e) {
    if(e.keyCode == 83 && !this.isOverlayOpen) {
      this.openOverlay()
    }
    if(e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.body.classList.add("body-no-scroll");
    this.searchField.value = "";
    setTimeout(() => this.searchField.focus(), 301)
    console.log("our open method just ran");
    this.isOverlayOpen = true;
    return false;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.body.classList.remove("body-no-scroll");
    console.log("our close method just ran");
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>

      </div>
    `
    )
  }
}

export default Search;


