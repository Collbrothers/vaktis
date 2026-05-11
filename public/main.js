function showSidebar(){
const sidebar = document.querySelector('.sidebar')
sidebar.style.display = 'flex'
}

function hideSidebar(){
const sidebar = document.querySelector('.sidebar')
sidebar.style.display = 'none'
}

function kommunFunction() {
  document.getElementById("kommun-dorpdown").classList.toggle("show");
}

function filterFunctionKommun() {
  var input, filter, div, a, i, txtValue;
  input = document.querySelector("#kommun-dorpdown input");
  filter = input.value.toUpperCase();
  div = document.getElementById("kommun-dorpdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function animalFunction() {
  document.getElementById("animal-dorpdown").classList.toggle("show");
}

function filterFunctionAnimal() {
  var input, filter, div, a, i, txtValue;
  input = document.querySelector("#kommun-dorpdown input");
  filter = input.value.toUpperCase();
  div = document.getElementById("animal-dorpdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}