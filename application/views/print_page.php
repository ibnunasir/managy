<!DOCTYPE html>
<html>
<head>
    <title>Print Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h5 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        p {
            margin-bottom: 0;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="container" id="printSection">
        <div class="text-center">

            <img src="<?= base_url('/assets/logo.png'); ?>" style="width: 150px;">
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">ID:</label>
            <div class="col-sm-8">
                <p id="printIdNumber" class="form-control-plaintext"></p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Nama:</label>
            <div class="col-sm-8">
                <p id="printNama" class="form-control-plaintext"></p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">No Telefon:</label>
            <div class="col-sm-8">
                <p id="printNoTelefon" class="form-control-plaintext"></p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Model:</label>
            <div class="col-sm-8">
                <p id="printModel" class="form-control-plaintext"></p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Masalah:</label>
            <div class="col-sm-8">
                <p id="printMasalah" class="form-control-plaintext"></p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tarikh:</label>
            <div class="col-sm-8">
                <p id="printTarikh" class="form-control-plaintext"></p>
            </div>
        </div>

    </div>

    <script>
        function loadPrintData() {
            document.getElementById('printIdNumber').innerText = localStorage.getItem('printIdNumber');
            document.getElementById('printNama').innerText = localStorage.getItem('printNama');
            document.getElementById('printNoTelefon').innerText = localStorage.getItem('printNoTelefon');
            document.getElementById('printModel').innerText = localStorage.getItem('printModel');
            document.getElementById('printMasalah').innerText = localStorage.getItem('printMasalah');
            document.getElementById('printTarikh').innerText = localStorage.getItem('printTarikh');
        }

        window.onload = loadPrintData;
    </script>

</body>
</html>
