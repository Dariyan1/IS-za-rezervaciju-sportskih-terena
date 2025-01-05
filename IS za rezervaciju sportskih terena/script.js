document.getElementById('calculate').addEventListener('click', function() {
    const formData = new FormData(document.getElementById('form'));

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('id')) {
        formData.append('id', urlParams.get('id'));
    }

    fetch('calculate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('price-result').innerHTML = data;
    })
    .catch(error => console.error('Greška:', error));
});

document.getElementById('form').addEventListener('submit', function(event) {
    const timeOd = parseInt(document.getElementById('timeOd').value, 10);
    const timeDo = parseInt(document.getElementById('timeDo').value, 10);

    if (timeOd >= 25 || timeDo >= 25 || timeDo <= timeOd) {
        event.preventDefault();

        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = 'Broj sati "Do" mora biti veći od broja sati "Od", i oba moraju biti manja od 25.';
    }
});

