{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertaal JSON</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="file"],
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .loading {
            display: none;
            margin-bottom: 20px;
        }
        .loading-circle {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #007BFF;
            width: 30px;
            height: 30px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .download-link {
            display: none;
            margin-top: 20px;
        }
        .download-link a {
            color: #007BFF;
            text-decoration: none;
        }
        .download-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vertaal JSON</h2>
        <form id="translateForm" action="{{ route('api.translate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="json_file">Upload JSON bestand</label>
            <input type="file" id="json_file" name="json_file" accept=".json" required>

            <label for="target_language">Kies doeltaal</label>
            <select id="target_language" name="target_language" required>
                <option value="en">Engels</option>
                <option value="es">Spaans</option>
                <option value="fr">Frans</option>
                <option value="de">Duits</option>
            </select>

            <button type="submit">Vertaal</button>
        </form>

        <div class="loading">
            <div class="loading-circle"></div>
            <p>Vertalen, even geduld...</p>
        </div>

        <div class="download-link">
            <p>Download het vertaalde bestand: <a href="#" id="downloadLink" download>Download</a></p>
        </div>
    </div>

    <script>
        const form = document.getElementById('translateForm');
        const loading = document.querySelector('.loading');
        const downloadLinkContainer = document.querySelector('.download-link');

        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            loading.style.display = 'block'; 
            downloadLinkContainer.style.display = 'none'; 

            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            loading.style.display = 'none'; 

            if (response.ok) {
                const downloadLink = document.getElementById('downloadLink');
                downloadLink.href = result.download_url;
                downloadLinkContainer.style.display = 'block'; 
            } else {
                alert('Er is een fout opgetreden bij de vertaling. Probeer het opnieuw.');
            }
        });
    </script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertaal JSON</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="file"],
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .loading {
            display: none;
            margin-bottom: 20px;
        }
        .loading-circle {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #007BFF;
            width: 30px;
            height: 30px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .download-link {
            display: none;
            margin-top: 20px;
        }
        .download-link a {
            color: #007BFF;
            text-decoration: none;
        }
        .download-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vertaal JSON</h2>
        <form id="translateForm" action="{{ route('api.translate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="json_file">Upload JSON bestand</label>
            <input type="file" id="json_file" name="json_file" accept=".json" required>

            <label for="target_language">Kies doeltaal</label>
            <select id="target_language" name="target_language" required>
                <option value="en">Engels</option>
                <option value="es">Spaans</option>
                <option value="fr">Frans</option>
                <option value="de">Duits</option>
            </select>

            <button type="submit">Vertaal</button>
        </form>

        <div class="loading">
            <div class="loading-circle"></div>
            <p>Vertalen, even geduld...</p>
        </div>

        <div class="download-link">
            <p>Download het vertaalde bestand: <a href="#" id="downloadLink" download>Download</a></p>
        </div>
    </div>

    <script>
        // Check of de gebruiker is ingelogd
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login'; // Redirect naar login als er geen token is
            }
        });

        const form = document.getElementById('translateForm');
        const loading = document.querySelector('.loading');
        const downloadLinkContainer = document.querySelector('.download-link');

        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            loading.style.display = 'block'; 
            downloadLinkContainer.style.display = 'none'; 

            const formData = new FormData(form);
            const token = localStorage.getItem('token');

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            loading.style.display = 'none'; 

            if (response.ok) {
                const downloadLink = document.getElementById('downloadLink');
                downloadLink.href = result.download_url;
                downloadLinkContainer.style.display = 'block'; 
            } else {
                alert('Er is een fout opgetreden bij de vertaling. Probeer het opnieuw.');
            }
        });
    </script>
</body>
</html>
