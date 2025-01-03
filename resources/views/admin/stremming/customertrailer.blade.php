<script>
    document.getElementById('browseFileTrailer').addEventListener('click', function(event) {
        // Prevent the form from submitting
        event.preventDefault();
        let browseFileTrailer = $('#browseFileTrailer');

        let Trailer = new Resumable({

            target: '{{ route('uploadtrailer') }}',
            query: {
                _token: '{{ csrf_token() }}'
            }, // CSRF token
            fileType: ['mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        Trailer.assignBrowse(browseFileTrailer[0]);

        Trailer.on('fileAdded', function(
            file
        ) { // trigger when file pistorage/app/videos/pexels-ahmed-ツ-19970610 (Original)_9d5591632bc38c22131af656f13a54f7.mp4cked
            showProgress();
            Trailer.upload(); // to actually start uploading.
            $('#movieUploadForm').css('display', 'block');
            $('#video_page').css('display', 'none');
            fileUploadAction = false;
        });

        Trailer.on('fileProgress', function(file) {
            $('.uploadBtn').attr('hidden', true);
            updateProgress(Math.floor(file.progress() * 100));
        });

        Trailer.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            $('#imagePath').val(response.path);
            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();

        });



        Trailer.on('fileError', function(file, response) {
            $('.uploadBtn').removeAttr('hidden'); // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {

            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    });
</script>
