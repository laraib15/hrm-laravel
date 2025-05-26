$("#create-employee").on("submit", function (e) {
        e.preventDefault();
            var FormData = $(this).serialize();
            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: FormData,
                success: function (response) {
                    // Handle the success response
                    $("#create-employee")[0].reset();
                    //location.reload();
                    // Optionally, you can redirect or show a success message
                    // For example: $('#success-message').text('Stage created successfully!').show();
                },
                error: function (xhr) {
                    if (xhr.responseJSON.errors) {
                        // Clear previous errors
                        $('.invalid-feedback').remove();

                        // Loop through each error and display it
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid'); // Add error class
                            input.after('<div class="invalid-feedback">' + value[0] + '</div>'); // Show error message
                        });
                    }
                },
            });

    });