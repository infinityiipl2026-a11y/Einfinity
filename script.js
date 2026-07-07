// ACTIVE NAVBAR

const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll("nav a").forEach(link => {

  const href = link.getAttribute("href");

  if(href === currentPage){

    link.classList.add("active-link");

  }

});

// SCROLL REVEAL

const revealElements = document.querySelectorAll(
  ".why-card, .product-card, .about-card, .office-box, .certification-card, .affiliation-card"
);

function revealOnScroll(){

  revealElements.forEach(item => {

    const top = item.getBoundingClientRect().top;

    if(top < window.innerHeight - 100){

      item.classList.add("show");

    }

  });

}

window.addEventListener("scroll", revealOnScroll);

revealOnScroll();

// SMOOTH SCROLL TO TOP BUTTON

const topBtn = document.createElement("button");

topBtn.innerHTML = "↑";

topBtn.id = "topBtn";

document.body.appendChild(topBtn);

window.addEventListener("scroll", () => {

  if(window.scrollY > 400){

    topBtn.style.display = "block";

  }else{

    topBtn.style.display = "none";

  }

});

topBtn.addEventListener("click", () => {

  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });

});

// PRODUCT SEARCH (only on products page)

const searchInput = document.getElementById("productSearch");

if(searchInput){

  searchInput.addEventListener("keyup", () => {

    let value = searchInput.value.toLowerCase();

    let cards = document.querySelectorAll(".product-card");

    cards.forEach(card => {

      let text = card.innerText.toLowerCase();

      if(text.includes(value)){

        card.style.display = "block";

      }else{

        card.style.display = "none";

      }

    });

  });

}

// ==========================
// CAREERS FORM VALIDATION
// ==========================

const careerForm = document.querySelector(".career-form-box form");

if(careerForm){

careerForm.addEventListener("submit", function(e){

    const name =
        document.getElementById("fullname").value.trim();

    const email =
        document.getElementById("email").value.trim();

    const phone =
        document.getElementById("phone").value.trim();

    const location =
        document.getElementById("location").value.trim();

    // Name

    if(!/^[A-Za-z ]{3,50}$/.test(name)){
        alert("Full Name should contain only alphabets and spaces.");
        e.preventDefault();
        return;
    }

    // Gmail

    if(!/^[a-z0-9._%+-]+@gmail\.com$/.test(email)){
        alert("Please enter a valid lowercase Gmail address.");
        e.preventDefault();
        return;
    }

    // Phone

    if(!/^[6-9][0-9]{9}$/.test(phone)){
        alert("Please enter a valid 10-digit mobile number.");
        e.preventDefault();
        return;
    }

    // Location

    if(location === ""){
        alert("Please enter your current location.");
        e.preventDefault();
        return;
    }

});

}

function openFounderModal(){

  document.getElementById("founderModal").style.display="flex";
}

function closeFounderModal(){

  document.getElementById("founderModal").style.display="none";
}

function openMdModal(){

  document.getElementById("mdModal").style.display="flex";
}

function closeMdModal(){

  document.getElementById("mdModal").style.display="none";
}

window.onclick = function(event){

  const founder =
  document.getElementById("founderModal");

  const md =
  document.getElementById("mdModal");

  if(event.target === founder){
    founder.style.display="none";
  }

  if(event.target === md){
    md.style.display="none";
  }

}
