<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <style>
        .container {
            margin: 0 auto;
            border: 0px solid black;
            width: 50%;
            height: 250px;
            border-radius: 3px;
            background-color: ghostwhite;
            text-align: center;
        }
        .preview {
            width: 50px;
            height: 50px;
            border: 1px solid black;
            margin: 0 auto;
            background: white;
        }
        .preview img {
            display: none;
            cursor: pointer;
        }
        #file {
            border: 0px;
            background-color: deepskyblue;
            color: white;
            padding: 5px 5px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="" id="myform">
            <div class="preview">
                <img src="" id="img" width="50" height="50">
            </div>
            <div>
                <input type="file" id="file" name="file" />
            </div>
        </form>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="modal-img">
            <div id="caption"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#file').change(function() {
                let files = $('#file')[0].files;
                let fileExtension = ['jpg', 'jpeg', 'png'];
                if($.inArray($(this).val().replace(/^.*\./, '').split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert('Only formats are allowed: ' + fileExtension.join(', '));
                }else if(files[0].size > 2097152) {
                    alert('File size is larger then 2mb');
                }else if(files.length > 0) {
                    let fd = new FormData();
                    fd.append('file', files[0]);
                    $.ajax({
                        url: 'upload.php',
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response != 0) {
                                $('#img').attr('src', response);
                                $('.preview img').show();
                            }else {
                                alert('file not uploaded!');
                            }
                        }
                    });
                }else {
                    alert('Please select a file.');
                }
            });
            $('#img').click(function() {
                $('#myModal').show();
            });
            $('.close').click(function() {
                $('#myModal').hide()
            });
        });
    </script>
</body>
</html>
