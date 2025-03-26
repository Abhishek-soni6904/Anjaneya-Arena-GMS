const passwordField = document.getElementById("newPassword");
const confirmPasswordField = document.getElementById("confirmPassword");
const matchMessage = document.getElementById("matchMessage");
const submitButton = document.getElementById("submit-btn");
const membership = document.getElementById("newMembership");

const urlParams = new URLSearchParams(window.location.search);
            const getMembership = urlParams.get('membership');
            if (getMembership) {
                openModal('membershipModal');
            }
// Modal handling functions
function openEditModal(type) {
  const modal = document.getElementById("editModal");
  const title = document.getElementById("editModalTitle");
  const label = document.getElementById("editFieldLabel");
  const input = document.getElementById("editFieldInput");
  const editType = document.getElementById("editType");
  const values = Array.from(document.getElementsByClassName("value"));
  input.removeAttribute("list", "membership-duration-options");
  // Configure modal based on type
  if (type === "Name" || type === "Email") {
    if (type === "Name") {
      input.value = values[1].textContent;
    } else if (type === "Email") {
      input.value = values[2].textContent;
    }
    editType.value = type;
    title.textContent = `Update ${type}`;
    label.textContent = `New ${type}`;
    input.type = type === "Email" ? "email" : "text";
    modal.style.display = "block";
  }
}
function updatePasswordMessage(message, color) {
  matchMessage.textContent = message;
  matchMessage.style.color = color;
}
function validatePassword() {
  const password = passwordField.value.trim();
  const confirmPassword = confirmPasswordField.value.trim();
  submitButton.disabled = true;

  if (!password) {
    updatePasswordMessage("Password cannot be empty.", "red");
    return;
  }

  if (password !== confirmPassword) {
    updatePasswordMessage("Passwords do not match.", "red");
    return;
  }

  updatePasswordMessage("Passwords match.", "green");
  submitButton.disabled = false;
}
passwordField.addEventListener("input", validatePassword);
confirmPasswordField.addEventListener("input", validatePassword);
