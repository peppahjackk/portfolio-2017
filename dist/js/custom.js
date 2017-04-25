// Initialize collapse button
$(".button-collapse").sideNav();

// Adjust hash jump to account for fixed nav
/*window.addEventListener("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 64);
});*/

// Contact Form
$("#contact-form").validator().on("submit", function (event) {
	if (event.isDefaultPrevented()) {
		submitMSG(false, "Did you fill in the form properly?");
	}
	else{
		event.preventDefault();
		submitForm();
	}
});

function submitForm(){
	//Create variables with contact form content
	var name = $("#name").val();
	var email = $("#email").val();
	var inquiry = $("#inquiry").val();
	var phone = $("#phone").val();
	var g_recaptcha = $("#g-recaptcha-response").val();

	$.ajax({
		type: "POST",
		url: "php/process.php",
		data: "name=" + name + "&email=" + email + "&phone=" + phone + "&inquiry=" + inquiry + "&g_recaptcha=" + g_recaptcha,
		success: function(text){
			if (text == "success"){
				formSuccess();
			} else {
				//formError(); - only if animate is implemented
				submitMSG(false, text);
			}
		}
	})
}

function formSuccess(){
	$("#contact-form")[0].reset();
	submitMSG(true, "Inquiry Submitted!")
}

function submitMSG(valid, msg){
	var msgClasses;
	if(valid){
		msgClasses = "chip msg green darken-2";
	} else {
		msgClasses = "chip msg red darken-2";
	}
	$("#msg-submit").removeClass().addClass(msgClasses).text(msg);
}

// Add smooth has scrolling
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 64
      }, 600, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash - 64;
      });
    } // End if
  });
});