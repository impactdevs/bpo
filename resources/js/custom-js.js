$(document).ready(function () {
    console.log("ready!");
    $("#field_type").change(function () {
        var selectedType = $(this).val();
        console.log("ddjdjdjdj");
        if (selectedType === "radio" || selectedType === "checkbox") {
            console.log(selectedType);
            $("#options_container").show();
        } else {
            $("#options_container").hide();
            $("#field_options").val("");
        }
    });

    //copy function
    $("#copyLink").click(function (e) {
        e.preventDefault();

        // Get the URL from the href attribute of the <a> tag
        var urlToCopy = $(this).attr('href');

        // Create a temporary element to hold the text
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val(urlToCopy).select();

        // Use JavaScript execCommand to copy to clipboard
        document.execCommand("copy");
        $temp.remove();

        // Alert the user
        alert("Copied to clipboard: " + urlToCopy);
    });

});

// Optional: You can add more dynamic behavior here as needed
$("#createForm").submit(function (event) {
    // Additional form submission handling if necessary
});
