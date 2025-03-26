const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");
sidebar.querySelector('.logo').addEventListener('click',()=>{
  window.location='index.php';
});
function toggleSidebar() {
  sidebar.classList.toggle("close");
}
toggleButton.addEventListener("click", toggleSidebar);
function openModal(modalId) {
  document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}
function openDeleteModal(id) {
  deleteId.value = id;
  openModal("deleteModal");
}
window.addEventListener("click", (event) => {
  if (event.target.id.includes("Modal")) {
    closeModal(event.target.id);
  }
});
