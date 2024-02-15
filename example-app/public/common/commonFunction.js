function notification(alertType,message) {
    toastr.options= {
        "progressBar":true,
        "closeButton":true,
    };
    toastr[`${alertType}`](`${message}`);
}
function isInputEmpty(input) {
    input.focus();
    console.log(input.val().trim());
    return input.val().trim() === "";
}
function previewImage(inputFile) {
    let getId = $(inputFile).attr("id");
    console.log(getId);
    let preview = $('#imagePreview')[0];
    console.log(preview);
    let file = $('#'+getId)[0].files[0];
    console.log('file: '+file);
    let reader = new FileReader();
    reader.onloadend = function () {
        preview.src = reader.result;
    };
    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
