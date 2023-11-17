// Form submission popup script
$(document).ready(function () {
    // Submit form and show success alert
    $("#contact-form").submit(function (event) {
        event.preventDefault();

        // Your form submission logic goes here
        // For now, let's just show a simple alert
        alert("Your form has been submitted.                                                               We will get back to you as soon as possible!");
    });
});
