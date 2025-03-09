// AJAX submission
document.querySelector('.contact-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    const formData = new FormData(this);

    fetch('php/submitForm.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Display the response from the server
        alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});