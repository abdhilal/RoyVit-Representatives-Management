document.addEventListener("DOMContentLoaded", function() {
    var showHideElements = document.querySelectorAll(".show-hide");
    var passwordInput = document.querySelector('input[name="login[password]"]');
    var showHideSpan = document.querySelector(".show-hide span");
    var submitButton = document.querySelector('form button[type="submit"]');
  
    showHideElements.forEach(function(element) {
      element.style.display = "block";
    });
  
    if (showHideSpan && passwordInput) {
      showHideSpan.classList.add("show");
  
      showHideSpan.addEventListener("click", function() {
        if (showHideSpan.classList.contains("show")) {
          passwordInput.setAttribute("type", "text");
          showHideSpan.classList.remove("show");
        } else {
          passwordInput.setAttribute("type", "password");
          showHideSpan.classList.add("show");
        }
      });
    }
  
    if (submitButton && showHideSpan && passwordInput) {
      submitButton.addEventListener("click", function() {
        showHideSpan.classList.add("show");
        passwordInput.setAttribute("type", "password");
      });
    }
  });