let password = document.querySelector(".password");
let message = document.querySelector(".message");
let passInputField = document.querySelector(".pass-input-field");
let passwordStrenght = document.querySelector(".password-strenght");

// Regex patterns
let regExpLower = /[a-z]/; // lowercase letters
let regExpUpper = /[A-Z]/; // uppercase letters
let regExpNumber = /\d/; // numbers
let regExpSpecial = /[!@#$%^&*(),.?":{}|<>_\-]/; // special characters

password.addEventListener("input", () => {
  let val = password.value;
  let no = 0;

  if (val != "") {
    message.style.display = "flex";
    passwordStrenght.style.display = "flex";

    // Count how many conditions are satisfied
    let hasLower = regExpLower.test(val);
    let hasUpper = regExpUpper.test(val);
    let hasNumber = regExpNumber.test(val);
    let hasSpecial = regExpSpecial.test(val);
    let hasLength = val.length >= 8;

    // Strength rules
    if (!hasLength || !(hasLower && hasUpper && hasNumber)) {
      // Doesn't meet minimum secure requirements
      no = 1;
    } else if (hasLength && hasLower && hasUpper && hasNumber && !hasSpecial) {
      // Meets minimum requirements but no special character
      no = 2;
    } else if (hasLength && hasLower && hasUpper && hasNumber && hasSpecial) {
      // Meets minimum + has special character
      no = 3;
    }

    // Apply styling
    if (no == 1) {
      passInputField.style.borderColor = "red";
      message.style.display = "block";
      message.textContent = "Your password is too weak (must be 8+ chars, include upper, lower, number)";
      message.style.color = "red";
      passwordStrenght.style.width = "25%";
      passwordStrenght.style.backgroundColor = "red";
    }
    if (no == 2) {
      passInputField.style.borderColor = "orange";
      message.style.display = "block";
      message.textContent = "Your password is medium (add special characters for more strength)";
      message.style.color = "orange";
      passwordStrenght.style.width = "75%";
      passwordStrenght.style.backgroundColor = "orange";
    }
    if (no == 3) {
      passInputField.style.borderColor = "green";
      message.style.display = "block";
      message.textContent = "Your password is strong";
      message.style.color = "#23ad5c";
      passwordStrenght.style.width = "100%";
      passwordStrenght.style.backgroundColor = "#23ad5c";
    }
  } else {
    passwordStrenght.style.display = "none";
    message.style.display = "none";
    passInputField.style.borderColor = "black";
  }
});
