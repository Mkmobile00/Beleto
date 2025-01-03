<!-- index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Upload Video</h2>
    <input type="file" id="fileInput">
    <button onclick="uploadFile()">Upload</button>
    <div id="progressBar" style="width: 0%; height: 20px; background-color: green;"></div>
    <div id="progressStatus"></div>
    <script>
        function uploadFile() {
            var file = document.getElementById('fileInput').files[0];
            var formData = new FormData();
            formData.append('file', file);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
            $.ajax({
                url: '/upload',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(event) {
                        var percent = (event.loaded / event.total) * 100;
                        $('#progressBar').css('width', percent + '%');
                        $('#progressStatus').text(percent.toFixed(2) + '% uploaded');
                    });
                    return xhr;
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>