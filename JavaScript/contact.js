function showPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
}

function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

var form = document.querySelector('form');
form.addEventListener('submit', function (e) {
    e.preventDefault();
    var nameField = document.getElementById("name");
    var emailField = document.getElementById("email");
    var subjectField = document.getElementById("subject");
    var messageField = document.getElementById("message");
    showPopup();
    setTimeout(function() {
        nameField.value = ""; // Clear name field
        emailField.value = ""; // Clear email field
        subjectField.value = ""; // Clear subject field
        messageField.value = ""; // Clear message field
        closePopup(); // Close the popup after 3 seconds
    }, 5000); // delay to 3000 milliseconds (3 seconds)
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', this.action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response here if needed
        }
    };
    xhr.send(formData);
});

function checkMessageLength(textarea) {
    var message = textarea.value.trim();
    var words = message.split(/\s+/);
    var remaining = 100 - words.length;
    document.getElementById("messageLength").textContent = remaining + " word" + (remaining !== 1 ? "s" : "") + " remaining";
    if (remaining < 0) {
        textarea.value = words.slice(0, 100).join(" ");
        document.getElementById("messageLength").textContent = "0 words remaining";
    }
}

var ratingStars = document.querySelectorAll('.rating input[type="radio"]');
ratingStars.forEach(function(star) {
    star.addEventListener('click', function() {
        var ratingValue = this.value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'rating-connection.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response here if needed
                console.log(xhr.responseText);
            }
        };
        xhr.send('rating=' + encodeURIComponent(ratingValue));

        var thankyouMessage = document.getElementById("thankyouMessage");
        thankyouMessage.style.display = "block";
        setTimeout(function() {
            thankyouMessage.style.display = "none";
            closePopup();
        }, 3000); // delay to 3000 milliseconds (3 seconds)
    });
});

       // Get the rating container
       var ratingContainer = document.querySelector('.rating');

       // Get the rating inputs
       var ratingInputs = ratingContainer.querySelectorAll('input[type="radio"]');

       // Get the popup element
       var popup = document.getElementById('popup');

       // Add event listeners to the rating inputs
       ratingInputs.forEach(function(input) {
           input.addEventListener('mouseenter', function() {
               // Show the value of the star in the popup
               popup.textContent = this.value;
               // Show the popup
               popup.style.display = 'block';
           });

           input.addEventListener('mouseleave', function() {
               // Hide the popup when the mouse leaves the star
               popup.style.display = 'none';
           });
       });