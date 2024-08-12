$(document).ready(function () {
    console.log("ready!");
    $("#field_type").change(function () {
        var selectedType = $(this).val();
        if (selectedType === "radio" || selectedType === "checkbox") {
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
        var urlToCopy = $(this).attr("href");

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
    // add field modal
    $("#addFieldModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        modal.find(".modal-title").text("Add Field");
        modal.find("#section_id").val(button.data("section-id"));

        console.log(button.data("section-id"));
    });

    $("#editFieldModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var mode = button.data("mode");
        var id = button.data("id");
        var label = button.data("label");
        var type = button.data("type");
        var options = button.data("options");

        var modal = $(this);
        modal
            .find(".modal-title")
            .text(mode === "edit" ? "Edit Field" : "Add Field");
        modal
            .find("form")
            .attr("action", mode === "edit" ? "/fields/" + id : "/fields");
        if (mode === "edit") {
            modal
                .find("form")
                .append('<input type="hidden" name="_method" value="PUT">');
        }
        modal.find("#field_name").val(label);
        modal.find("#field_type").val(type);

        if (type === "checkbox" || type === "radio") {
            console.log("showing options");
            //change display of #options_container to block
            modal.find("#options_container").show();
            modal.find("#field_options").val(options);
        } else {
            modal.find("#options_container").hide();
            modal.find("#field_options").val("");
        }

        //on changing the field type to radio or checkbox, show the options container
        modal.find("#field_type").change(function () {
            console.log("change event");
            var selectedType = $(this).val();
            if (selectedType === "radio" || selectedType === "checkbox") {
                modal.find("#options_container").show();
            } else {
                modal.find("#options_container").hide();
                modal.find("#field_options").val("");
            }
        });
    });

    // Optional: You can add more dynamic behavior here as needed
    $("#createForm").submit(function (event) {
        // Additional form submission handling if necessary
    });

    // Populate the conditional value select box based on the selected field
    $("#conditional_field").on("change", function () {
        let fieldId = $(this).val();
        let $conditionalValue = $("#conditional_value");
        $conditionalValue.empty();

        $.getJSON(`/fields/${fieldId}`, function (data) {
            $.each(data.data.options.split(","), function (index, option) {
                $conditionalValue.append(
                    $("<option>", {
                        value: option,
                        text: option,
                    })
                );
            });
        });
    });

    // fill the field id offcanvasBottom with the field id of the selected field
    $('#offcanvasBottom').on('show.bs.offcanvas', function (e) {
        let offcanvasBottom = $(this);

        let fieldId = $(e.relatedTarget).data('field-id');

        offcanvasBottom.find('#field_id').val(fieldId);
    });
});
