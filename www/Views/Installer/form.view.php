<!-- Page 1 -->
<div id="page1">
    <input type="text" id="name"
           placeholder="Your Name">
    <button id="next1">Next</button>
</div>

<!-- Page 2 -->
<div id="page2" style="display: none;">
    <input type="text" id="email"
           placeholder="Your Email">
    <button id="submit">Submit</button>
</div>

<!-- Page 3 -->
<div id="page3" style="display: none;">
    Thank you for submitting the form.
</div>

<script>
    async function validateForm(formData) {
        const response = await fetch('/validateform', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        // Vérifier que la requête a réussi
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Retourner le corps de la réponse transformé en JSON
        return response.json();
    }

    document.querySelector('#next1').addEventListener('click', async () => {
        const name = document.querySelector('#name').value;
        try {
            const validationResult = await validateForm({ name: name });
            if (validationResult.status === 'success') {
                document.querySelector('#page1').style.display = 'none';
                document.querySelector('#page2').style.display = 'block';
            } else {
                alert('Please fill in your name');
            }
        } catch (error) {
            console.error('Failed to validate form', error); // Replace this with a user-friendly error message
        }
    });

    document.querySelector('#submit').addEventListener('click', async () => {
        const email = document.querySelector('#email').value;
        try {
            const validationResult = await validateForm({ email: email });
            if (validationResult.status === 'success') {
                document.querySelector('#page2').style.display = 'none';
                document.querySelector('#page3').style.display = 'block';
            } else {
                alert('Please fill in your email');
            }
        } catch (error) {
            console.error('Failed to validate form', error); // Replace this with a user-friendly error message
        }
    });
</script>