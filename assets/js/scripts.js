// NAVBAR

$(document).ready(function() {
    $(".toggle").on("click", function(event) {
        event.preventDefault();
        $(".navbar").slideToggle();
    });

    $(".nav-links a, .cta, .hero-cta").on("click", function(event) {
        event.preventDefault();
        var sectionId;
        if ($(this).attr("href")) {
            sectionId = $(this).attr("href");
        } else {
            sectionId = "#contact"; // default section ID
        }
        if ($(sectionId).length > 0) {
            $("html, body").animate({
                scrollTop: $(sectionId).offset().top
            }, 1000);
        }
        // Close the navigation after a delay, only on mobile view
        if ($(window).width() < 768) { // adjust the screen width value as needed
            setTimeout(function() {
                $(".navbar").slideUp();
            }, 300);
        }
    });
});

$(document).ready(function() {
    // Set the countdown date to 3 months from now
    const countDownDate = new Date(Date.now() + 7776000000); // 3 months in milliseconds

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        // Calculate time components
        const months = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
        const weeks = Math.floor((distance % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24 * 7));
        const days = Math.floor((distance % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Check if the screen size is small enough to be considered a mobile device
        const isMobile = $(window).width() < 768; // adjust the width value as needed

        let countdownDisplay;
        if (isMobile) {
            // Use short formats on mobile view
            countdownDisplay = `
                ${months}M, 
                ${weeks}W, 
                ${days}D, 
                ${hours}H, 
                ${minutes}min, 
                ${seconds}sec
            `;
        } else {
            // Use full formats on desktop view
            countdownDisplay = `
                ${months} months, 
                ${weeks} weeks, 
                ${days} days, 
                ${hours} hours, 
                ${minutes} minutes, 
                ${seconds} seconds
            `;
        }

        // Display the result in the button
        $('#count').html(countdownDisplay);

        // If the countdown is over, display a message
        if (distance < 0) {
            clearInterval(timer);
            $('#count').html("Countdown Finished");
        }
    }

    // Update the countdown every second
    const timer = setInterval(updateCountdown, 1000);
});

$(document).ready(function() {
    $('.nav-link').on('click', function(e) {
        e.preventDefault();
        const profileId = $(this).attr('data-profile');
        $('.features-profile').removeClass('active');
        $(`.features-profile.${profileId}`).addClass('active');
        $('.features-nav a').removeClass('active-link');
        $(this).addClass('active-link');
    });
});

// CONTACT


$('.input-block input').on('input', function() {
    if ($(this).val() !== '') {
        $(this).addClass('has-data');
    } else {
        $(this).removeClass('has-data');
    }
});


$('#contact-form').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serializeArray();
    const data = {};
    
    // Initialize services as an array to hold multiple values
    data['services[]'] = [];

    $.each(formData, function(index, field) {
        if (field.name === 'services[]') {
            // Push the value to the array for services
            data['services[]'].push(field.value);
        } else {
            // For other fields, just assign the value
            data[field.name] = field.value;
        }
    });

    // console.log(data); // log the form data to the console
    window.location.href = window.location.href.split('#')[0] + "#contact";
    // Send the data to the PHP script using AJAX
    $.ajax({
        type: 'POST',
        url: '/assets/scripts/email.php', 
        data: data,
        success: function(response) {
            console.log('Project Request Sent successfully!');
            const message = `Successfully Sent...`;
            $('#message').html(`<i class="fa fa-check-circle" aria-hidden="true"></i> ${message}`)
                                 .fadeIn()
                                 .delay(3000)
                                 .fadeOut(function() {
                                    // After the message fades out, reload the page
                                    setTimeout(function() {
                                        location.reload();
                                    }, 600); // Adding a slight delay before the reload
                                });
        },
        error: function(xhr, status, error) {
            console.log('Error sending email:', error);
            const errorMessage = `Error Sending... Please try again!!!`;
            $('#message').html(`<i class="fa fa-exclamation-circle" aria-hidden="true"></i> ${errorMessage}`)
                                 .fadeIn()
                                 .delay(3000)
                                 .fadeOut(function() {
                                    // After the message fades out, reload the page
                                    setTimeout(function() {
                                        location.reload();
                                    }, 600); // Adding a slight delay before the reload
                                });
        }
    });
});

// FOOTER

$(document).ready(function() {
    $('#currentYear').text(new Date().getFullYear());
});