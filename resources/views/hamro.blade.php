<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
        const form = document.createElement("form");
        form.method = "post";
        form.action = "https://checkout.hamropatro.com/api/checkout";
        form.enctype = "application/x-www-form-urlencoded";
        const params=@json($data);
        for (const key in params) {
        if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.id = key;
            hiddenField.name = key;
            hiddenField.value = params[key];
            form.appendChild(hiddenField);
            }
        }
        document.body.appendChild(form);
        form.submit();

    </script>
</body>
</html>