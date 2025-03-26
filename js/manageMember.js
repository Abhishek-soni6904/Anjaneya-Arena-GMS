// Get modal and form elements only once
const memberModal = document.getElementById("memberModal");
const deleteModal = document.getElementById("deleteModal");
const memberForm = document.getElementById("memberForm");
const submitButton = document.getElementById("submitButton");
const modalTitle = document.getElementById("modalTitle");
const formAction = document.getElementById("formAction");
const memberIdField = document.getElementById("member_id");
const memberNameField = document.getElementById("memberName");
const emailField = document.getElementById("email");
const membershipTypeField = document.getElementById("membershipType");
const membershipDurationField = document.getElementById("membershipDuration");
const deleteId = document.getElementById("delete_member_id");
const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("confirmPassword");
const matchMessage = document.getElementById("match");

function validatePassword(value) {
  const password = passwordField.value.trim();
  const confirmPassword = confirmPasswordField.value.trim();

  // Reset the submit button and message before validation
  submitButton.disabled = true;
  if (value === "add") {
    // Check if password fields are empty
    if (password === "") {
      matchMessage.textContent = "Password cannot be empty.";
      matchMessage.style.color = "red";
      return; // Exit the function early
    }
  }

  // Check if passwords match
  if (password !== confirmPassword) {
    matchMessage.textContent = "Passwords do not match.";
    matchMessage.style.color = "red";
    return; // Exit the function early
  }

  // If we get here, validation has passed
  matchMessage.textContent = "Passwords match.";
  matchMessage.style.color = "green";
  if (value == "update" && password === "") {
    matchMessage.textContent = "";
  }
  submitButton.disabled = false;
}

// Updated edit member function
function editMember(tableRow, memberId) {
  // Update form fields
  memberForm.reset();
  const tableData = tableRow.getElementsByTagName("td");

  formAction.value = "update";
  memberIdField.value = memberId;
  memberNameField.value = tableData[1].innerText;
  membershipTypeField.value = tableData[3].innerText;
  emailField.value = tableData[5].innerText;

  // Update modal title and button text
  modalTitle.textContent = "Edit Member";
  submitButton.innerHTML = '<i class="fas fa-save"></i> Update Member';
  membershipDurationField.value = "0";
  membershipDurationField.previousElementSibling.innerHTML =
    "Extend Membership By";
  matchMessage.innerHTML = "";
  submitButton.disabled = false;
  passwordField.addEventListener("input", () => {
    validatePassword("update");
  });
  confirmPasswordField.addEventListener("input", () =>
    validatePassword("update")
  );
  membershipTypeField.addEventListener("change", () => {
    if (membershipTypeField.value != tableData[3].innerText) {
      membershipDurationField.previousElementSibling.innerHTML =
        "Membership Duration";
      membershipDurationField.value = "";
      matchMessage.innerHTML = "No refunds when changing Membership";
      matchMessage.style.color = "red";
    } else {
      membershipDurationField.previousElementSibling.innerHTML =
        "Extend Membership By";
      membershipDurationField.value = "0";
      matchMessage.innerHTML = "";
    }
  });
  // Open the modal
  openModal("memberModal");
}

// Function to reset form when adding new member
function openMemberModal() {
  memberForm.reset();
  formAction.value = "add";
  modalTitle.textContent = "Add new Member";
  submitButton.innerHTML = '<i class="fas fa-plus"></i> Add Member';
  openModal("memberModal");
  validatePassword("add");
  passwordField.addEventListener("input", () => validatePassword("add"));
  confirmPasswordField.addEventListener("input", () => validatePassword("add"));
}

let table = $("#jquery-data-table").DataTable({
  responsive: {
    details: {
      type: "column",
      target: "tr",
    },
  },
  columnDefs: [
    { orderable: false, targets: -1 },
    { searchable: false, targets: [0, 2, 4, -1] },
    { responsivePriority: 1, targets: [0, 1, 6, 3] },
  ],
  language: {
    lengthMenu: "Show _MENU_ members per page",
    zeroRecords: "No members found",
    info: "Showing _START_ to _END_ of _TOTAL_ members",
    infoEmpty: "Showing 0 to 0 of 0 members",
    infoFiltered: "(filtered from _MAX_ total members)",
  },
});
