function closeMessage() {
    var message = document.getElementById("successMessage");
    message.style.display = "none";
}

// Get the calendar element
const calendar = document.getElementById('calendar');

// Get the current date
const currentDate = new Date().toISOString().split('T')[0];

// Set the minimum date to the current date
calendar.setAttribute('min', currentDate);

function validateForm() {
    var headCount = document.getElementById("head").value;
    if (headCount > 10) {
        alert("Maximum head count allowed is 10.");
        return false;
    }
    return true;
}

// Function to show a pop-up message
function showPopup(message) {
    alert(message);
}

// Function to display the notification
function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.innerText = message;
    notification.style.display = 'block';

    // Hide the notification after 3 seconds
    setTimeout(function() {
        notification.style.display = 'none';
    }, 3000);
}
