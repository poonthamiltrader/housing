var previewTemplate,
    dropzone,
    ckeditorClassic = document.querySelector("#ckeditor-classic"),
    dropzonePreviewNode =
        (ckeditorClassic &&
            ClassicEditor.create(document.querySelector("#ckeditor-classic"))
                .then(function (e) {
                    e.ui.view.editable.element.style.height = "200px";
                })
                .catch(function (e) {
                    console.error(e);
                }),
        document.querySelector("#dropzone-preview-list"));
dropzonePreviewNode &&
    ((dropzonePreviewNode.id = ""),
    (previewTemplate = dropzonePreviewNode.parentNode.innerHTML),
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode),
    (dropzone = new Dropzone(".dropzone", {
        url: "http://localhost/git_housing/housing/projects/create", // Your project URL
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview",
    })));
