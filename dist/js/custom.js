// Initialize collapse button
$(".button-collapse").sideNav();

// Adjust hash jump to account for fixed nav
window.addEventListener("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 64);
});

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

	$.ajax({
		type: "POST",
		url: "php/process.php",
		data: "name=" + name + "&email=" + email + "&phone=" + phone + "&inquiry=" + inquiry,
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