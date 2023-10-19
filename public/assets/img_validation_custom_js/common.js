

function image_validation(
    image_id,
    show_image,
    message,
    size = "",
    custom_v_m = ""
) {
    $(image_id).change(function (e) {
        // $(show_image).attr("src", "");
        // $(show_image).closest("img").hide();
        let file_val = $(this).val();
        let file_size = this.files[0].size / 1024;
        let required_size = size != "" ? size : 1024;

        var fileExt = file_val.split(".").pop();

        if (fileExt == "jpg" || fileExt == "jpeg" || fileExt == "png" || fileExt == "webp" || fileExt == "gif") {
            if (file_size > required_size) {
                let msg =
                    custom_v_m != ""
                        ? custom_v_m
                        : parseFloat(file_size).toFixed(2) +
                          " kb Size is too large from required size";
                $(message).html(`<span class="text-danger">${msg}</span>`);
                return false;
            } else {
                $(message).html(
                    `<span class="text-success">Image Success</span>`
                );
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(show_image).closest("img").show();
                    $(show_image).attr("src", e.target.result);
                };
                reader.readAsDataURL(e.target.files["0"]);
                event.stopImmediatePropagation();
            }
        } else {
            $(message).html(
                `<span class="text-danger">File Format Not Support</span>`
               
            );
            
            
        }
    });
}





  
