<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css" />
    </head>
    <body>
        <div class="custom-file-container" data-upload-id="myUniqueUploadId">
            <label>
                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image" ><i class="fa fa-times"></i></a>
			</label >

            <label class="custom-file-container__custom-file">
                <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File"/>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>
        <script src="https://unpkg.com/file-upload-with-preview@4.0.8/dist/file-upload-with-preview.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js"></script>
        <script>
            var upload = new FileUploadWithPreview("myUniqueUploadId", {
                showDeleteButtonOnImages: true,
                text: {
                    chooseFile: "Choose media files",
                    browse: "Browse",
                    selectedCount: "Files Selected",
                },
            });
        </script>
    </body>
</html>
<input type="file" class="custom-file-container__custom-file__custom-file-input" id="myUniqueUploadId" accept="application/pdf,image/*,video/*" aria-label="Choose File" />
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />