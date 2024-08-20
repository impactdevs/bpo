$(document).ready(function () {
    console.log("ready!");
    $("#field_type").change(function () {
        var selectedType = $(this).val();
        if (
            selectedType === "radio" ||
            selectedType === "checkbox" ||
            selectedType === "select"
        ) {
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
    //edit section modal
    $("#editSectionModal").on("show.bs.modal", function (event) {
        console.log("edit section modal");
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        var sectionName = button.data("section-name");
        var sectionDescription = button.data("section-description");
        var modal = $(this);
        modal.find(".modal-title").text("Edit Section");
        modal.find("form").attr("action", "/sections/" + id);
        modal.find("#section_name").val(sectionName);
        modal.find("#section_description").val(sectionDescription);

        modal
            .find("form")
            .append('<input type="hidden" name="_method" value="PUT">');
    });
    //edit field modal
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
        modal.find("#section_id").val(id);

        if (type === "checkbox" || type === "radio" || type === "select") {
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
            if (
                selectedType === "radio" ||
                selectedType === "checkbox" ||
                selectedType === "select"
            ) {
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
    $("#offcanvasBottom").on("show.bs.offcanvas", function (e) {
        let offcanvasBottom = $(this);

        let fieldId = $(e.relatedTarget).data("field-id");

        $.getJSON(`/get-condition/${fieldId}`, function (data) {
            var data = data.data;
            console.log(data);
            if (data.length > 0) {
                let $conditionalValue = $("#conditional_value");
                $conditionalValue.empty();
                var conditional_visibility_field_id =
                    data[0].conditional_visibility_field_id;
                var conditional_visibility_operator =
                    data[0].conditional_visibility_operator;
                //select the conditional field
                offcanvasBottom
                    .find("#conditional_field")
                    .val(conditional_visibility_field_id);
                //get optons under the conditional field and select the operator
                $.getJSON(
                    `/fields/${conditional_visibility_field_id}`,
                    function (data) {
                        $.each(
                            data.data.options.split(","),
                            function (index, option) {
                                //append and select if the option is the same as the one in the database
                                if (
                                    conditional_visibility_operator ===
                                    conditional_visibility_operator
                                ) {
                                    $conditionalValue.append(
                                        $("<option>", {
                                            value: option,
                                            text: option,
                                            selected: true,
                                        })
                                    );
                                } else {
                                    $conditionalValue.append(
                                        $("<option>", {
                                            value: option,
                                            text: option,
                                        })
                                    );
                                }
                            }
                        );
                    }
                );
            }
        });

        offcanvasBottom.find("#field_id").val(fieldId);
    });

    // On radio button click, check conditions again
    $('input[type="radio"]').on("click", function () {
        console.log("clicking");
        let selectedRadioId = $(this).attr("id"); // The clicked radio button ID
        console.log(selectedRadioId);
        let selectedValue = $(this).val(); // The selected value of the radio button
        console.log(selectedValue);
        // Iterate through all fields with conditional visibility
        $(".question[data-radio-field]").each(function () {
            let controllingFieldId = $(this).data("radio-field"); // The field controlling visibility
            console.log("controlling field:", controllingFieldId);
            let triggerValue = $(this).data("trigger-value"); // The value that triggers visibility
            console.log("trigger value:", triggerValue);
            //remove _value from selectedRadioId like 3_1_value to 3
            selectedRadioId = selectedRadioId.split("_")[0];
            // Check if the clicked radio button controls this field

            if (controllingFieldId == selectedRadioId) {
                console.log("found controlling field");
                if (selectedValue.trim() === triggerValue.trim()) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            }
        });
    });
});
