// DOM Elements
const announcementModal = document.getElementById('announcementModal');
const deleteModal = document.getElementById('deleteModal');
const announcementForm = document.getElementById('announcementForm');
const formAction = document.getElementById('formAction');
const modalTitle = document.getElementById('modalTitle');
const announcementId = document.getElementById('announcementId');
const titleField = document.getElementById('title');
const categoryField = document.getElementById('category');
const contentField = document.getElementById('content');
const submitButton = document.getElementById('submitButton');
const deleteId = document.getElementById('deleteId');

function openAnnouncementModal() {
    announcementForm.reset();
    formAction.value = "add";
    modalTitle.textContent = "Add New Announcement";
    submitButton.innerHTML = '<i class="fas fa-plus"></i> Add Announcement';
    openModal("announcementModal");
}

function editAnnouncement(editBtn,id) {
    formAction.value = "update";
    announcementId.value = id;
    announcement=editBtn.parentNode.parentNode.parentNode.parentNode;
    titleField.value = announcement.querySelector("h2").innerText;
    contentField.value = announcement.querySelector(".announcement-body").innerText;
    categoryField.value = announcement.querySelector(".btn-edit").innerText.toLowerCase().replace(/ /g, "_");
    modalTitle.textContent = "Edit Announcement";
    submitButton.innerHTML = '<i class="fas fa-save"></i> Update Announcement';
    openModal("announcementModal");
}
