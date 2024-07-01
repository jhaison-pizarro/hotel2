<!DOCTYPE html>
<html>
<head>
    <title>Mostrar PDF</title>
</head>
<body>
    <script>
        // Crea un objeto Blob a partir del contenido del PDF
        var blob = new Blob([@json($pdf)], {type: 'application/pdf'});

        // Crea una URL para el Blob
        var url = URL.createObjectURL(blob);

        // Abre una nueva ventana/tab con el PDF
        window.open(url, '_blank');

        

     
    </script>
</body>
</html>
