// Get all DOM elements at the start
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const loginTab = document.getElementById('loginTab');
const registerTab = document.getElementById('registerTab');
const headerText = document.getElementById('headerText');
const toggleText = document.getElementById('toggleText');
const toggleButton = document.getElementById('toggleButton');
const adminLogin = document.getElementById('adminLogin');
const adminText = document.getElementById('adminText');
const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('confirmPassword');
const matchMessage = document.getElementById('matchMessage');
const submitButton = document.getElementsByClassName('submit-button');
const loginEmail = document.getElementById('logMail');
const loginPassword = document.getElementById('logPass');

// Function to switch between login and register forms
function switchForm(isLogin) {
    loginTab.classList.toggle('active', isLogin);
    registerTab.classList.toggle('active', !isLogin);
    loginForm.classList.toggle('hidden', !isLogin);
    registerForm.classList.toggle('hidden', isLogin);

    headerText.textContent = isLogin ? 'Welcome back!' : 'Start your fitness journey';
    toggleText.textContent = isLogin ? "Don't have an account?" : "Already have an account?";
    toggleButton.textContent = isLogin ? 'Register' : 'Login';
}

// Function to validate admin credentials - only called when form is submitted
function validateAdminCredentials() {
    const username = loginEmail.value.toLowerCase().trim();
    const password = loginPassword.value;
    
    if (username === 'admin' && password === 'admin') {
        loginForm.firstElementChild.value = 'admin';
        return true;
    }
    var alert = document.createElement("div"); 
    alert.innerHTML="<i class='fas fa-ban'></i>Check your credentials and try again.";
    alert.classList.add("message", "alert-item", "failure"); 
    document.body.appendChild(alert);
    return false;
}

// Function to toggle between admin and member modes
function toggleAdminMode() {
    const isMemberMode = toggleText.style.display !== 'none';
    
    // Toggle UI elements
    toggleText.style.display = isMemberMode ? 'none' : 'inline';
    toggleButton.style.display = isMemberMode ? 'none' : 'inline';
    registerTab.style.display = isMemberMode ? 'none' : 'block';
    adminText.textContent = isMemberMode ? 'Are you a Member?' : 'Are you Admin?';
    loginTab.disabled = isMemberMode;
    
    // Update email input
    loginEmail.type = isMemberMode ? 'text' : 'email';
    loginEmail.placeholder = isMemberMode ? ' Username' : ' Email';
    
    // Reset form values when switching modes
    loginEmail.value = '';
    loginPassword.value = '';
}

// Function to validate passwords
function validatePassword() {
    const password = passwordField.value.trim();
    const confirmPassword = confirmPasswordField.value.trim();
    submitButton[1].disabled = true;

    if (!password) {
        updatePasswordMessage('Password cannot be empty.', 'red');
        return;
    }

    if (password !== confirmPassword) {
        updatePasswordMessage('Passwords do not match.', 'red');
        return;
    }

    updatePasswordMessage('Passwords match.', 'green');
    submitButton[1].disabled = false;
}

// Helper function to update password message
function updatePasswordMessage(message, color) {
    matchMessage.textContent = message;
    matchMessage.style.color = color;
}

// Set up event listeners
loginTab.addEventListener('click', () => switchForm(true));
registerTab.addEventListener('click', () => switchForm(false));
toggleButton.addEventListener('click', () => {
    const isCurrentlyLogin = !loginForm.classList.contains('hidden');
    switchForm(!isCurrentlyLogin);
});
adminLogin.addEventListener('click', toggleAdminMode);
passwordField.addEventListener('input', validatePassword);
confirmPasswordField.addEventListener('input', validatePassword);

// Add form submit handler for admin login
loginForm.addEventListener('submit', (e) => {
    if (loginEmail.type === 'text') { // Admin mode
        e.preventDefault();
        if (validateAdminCredentials()) {
            e.target.submit();
        }
    }
});