

function multi_image_validation(image_id, show_image, message, size = "", custom_v_m = "") {
    $(image_id).change(function (e) {
    let files = Array.from(e.target.files); // Convert FileList to array

    $(show_image).empty(); // Clear the container before displaying new images
    $(message).empty(); // Clear the message container before showing new messages
    let i=0;
    let j=0;
    files.forEach(function (file) {
       i++
        let file_size = file.size / 1024;
        let required_size = size !== "" ? size : 1024;

        let fileExt = file.name.split(".").pop().toLowerCase();

        if (
        fileExt === "jpg" ||
        fileExt === "jpeg" ||
        fileExt === "png" ||
        fileExt === "webp" ||
        fileExt === "gif"
        ) {
        if (file_size > required_size) {
            let msg =
            custom_v_m !== ""
                ? custom_v_m
                : `${parseFloat(file_size).toFixed(2)} kb Size is too large from required size`;

            $(message).append(`<span class="text-danger">${msg}</span><br>`);
        } else {
            j++
            let reader = new FileReader();

            reader.onload = function (e) {
            let img = document.createElement("img");
            img.src = e.target.result;
            img.style.width = "80px"; // Set a fixed width for the displayed image

            $(show_image).append(img);
            };

            reader.readAsDataURL(file);
        
            
        }
        } else {
        $(message).append(
            `<span class="text-danger">${file.name} - File Format Not Supported</span><br>`
        );
        }
    });


    if( i == j ){
        $(message).append(`<span class="text-success">Image Success</span><br>`);
    }

    });
}