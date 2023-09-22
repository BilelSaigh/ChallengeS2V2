<!-- Page 1 -->
<style>
    #page1 {
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
        text-align: center;
    }

    #page1 input[type="text"],
    #page1 input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #page1 button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    #page1 button:hover {
        background-color: #0056b3;
    }
</style>

<!-- Page 2 -->
<style>
    #page2 {
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
        text-align: center;
    }

    #page2 input[type="text"],
    #page2 input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #page2 button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    #page2 button:hover {
        background-color: #0056b3;
    }
</style>


<div id="page1">
    <input type="text" id="db_name" placeholder="Nom de la base de données">
    <input type="text" id="db_username" placeholder="Identifiant">
    <input type="password" id="db_password" placeholder="Mot de passe">
    <input type="text" id="db_host" placeholder="Adresse de la base de données">
    <input type="text" id="table_prefix" placeholder="Préfixe des tables">
    <button id="next1">Next</button>
</div>

<!-- Page 2 -->
<div id="page2" style="display: none;">
    <input type="text" id="user_name" placeholder="Nom d'utilisateur">
    <input type="text" id="user_email" placeholder="Adresse email">
    <input type="password" id="user_password" placeholder="Mot de passe">
    <input type="password" id="confirm_password" placeholder="Confirmez le mot de passe">
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

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Attendre la résolution de la promesse pour obtenir les données JSON
        const data = await response.json();

        // Afficher les données JSON dans la console
        console.log(data);

        return data;
    }

    document.querySelector('#next1').addEventListener('click', async () => {

        const db_name = document.querySelector('#db_name').value;
        const db_username = document.querySelector('#db_username').value;
        const db_password = document.querySelector('#db_password').value;
        const db_host = document.querySelector('#db_host').value;
        const table_prefix = document.querySelector('#table_prefix').value;



        try {
            const validationResult = await validateForm({
                db_name: db_name,
                db_username: db_username,
                db_password: db_password,
                db_host: db_host,
                table_prefix: table_prefix
            });
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
        const user_name = document.querySelector('#user_name').value; // Correction ici
        const user_email = document.querySelector('#user_email').value; // Correction ici
        const user_password = document.querySelector('#user_password').value;
        const confirm_password = document.querySelector('#confirm_password').value;

        try {
            const validationResult = await validateForm({
                user_name: user_name, // Correction ici
                user_email: user_email, // Correction ici
                user_password: user_password,
                confirm_password: confirm_password
            });
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