<?php 
  get_header();
  getBanner();
?>
<div class="breadcrumb_background">
  <h1 style="text-align: center;">NEW</h1>
</div>
<div class="container container--narrow page-section">
  <div class="generic-content">
    <div class="row group">
      <div class="one-third">
        <select name="" id="select_sort" onclick="myFunction(event)">
          <option selected value="ALL" id="all">--Sap xep--</option>
          <option value="asc">Cu nhat</option>
          <option value="desc">Z-A</option>
          <option value="desc">Moi nhat</option>
          <option value="asc">A-Z</option>
        </select>
      </div>

      <div class="two-thirds">
        <ul id="professorCards">

        </ul>
      </div>
    </div>
  </div>
</div>
<script>
  function myFunction(e) {
    var giatri = document.getElementById("select_sort").value;
    let type = select_sort.options[select_sort.selectedIndex].innerHTML;
    let kq = [];

    switch(giatri) {
      case "desc":
        if(type == "Moi nhat") {
          let results = fetch(
            "https://pegasus.edu.vn/wp-json/wp/v2/posts?orderby=id&order=desc"
          )
          .then((reponse) => reponse.json())
          .then((data) => {
            kq = data;
            outPut(kq);
          })
        }else{
          let results = fetch(
            "https://pegasus.edu.vn/wp-json/wp/v2/posts?orderby=title&order=desc"
          )
          .then((reponse) => reponse.json())
          .then((data) => {
            kq = data;
            outPut(kq);
          })
        }
      break;

      case "asc":
        if(type == "Cu nhat") {
          let results = fetch("https://pegasus.edu.vn/wp-json/wp/v2/posts?orderby=id&order=asc")
          .then((reponse) => reponse.json())
          .then((data) => {
            kq = data;
            outPut(kq);
          })
        }else{
          let results = fetch("https://pegasus.edu.vn/wp-json/wp/v2/posts?orderby=title&order=asc")
          .then((reponse) => reponse.json())
          .then((data) => {
            kq = data;
            outPut(kq);
          })
        }
      break;

      default:
      let total = fetch("https://pegasus.edu.vn/wp-json/wp/v2/posts")
      .then((response) => response.json())
      .then((data) => {
        kq = data;
      })
    }
  }

  function outPut(data) {
      const items = data.map((item) => `
        <li class="professor-card__list-item">
          <a class="professor-card" href="${item.link}">
            <img class="professor-card__image" src="${item.yoast_head_json.og_image[0].url}" alt="">
            <span class="professor-card__name">${item.title.rendered.slice(0,55)}</span>
          </a>            
        </li>
      `).join('');
      document.getElementById('professorCards').innerHTML = items;
  }
</script>
<?php
  get_footer();
?>