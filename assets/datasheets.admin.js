jQuery(document).ready(function ($) {
    /**
     * Insert CSV from WordPress Media
     */
    $("body").on("click", ".insert-csv", function (e) {
        e.preventDefault();

        var button = $(this);

        custom_uploader = wp
            .media({
                title: "Insert CSV",
                library: { type: "text/csv" },
                button: {
                    text: "Use This CSV",
                },
                multiple: false,
            })
            .on("select", function () {
                var attachment = custom_uploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();

                $(button)
                    .removeClass("button")
                    .html(
                        '<span class="dashicons dashicons-media-document"></span>'
                    )
                    .next()
                    .val(attachment.id)
                    .next()
                    .show();

                readCSVHeader(attachment.id);
            })
            .open();
    });

    /*
     * Remove CSV which imported from media
     */
    $("body").on("click", ".remove-csv", function () {
        $(".post-type-tr").css("display", "none");
        $(".mapping-table").html("");

        $(this)
            .hide()
            .prev()
            .val("")
            .prev()
            .addClass("button")
            .html("Upload CSV");
        return false;
    });

    /**
     * Read CSV Header
     */
    function readCSVHeader(csvId) {
        $.ajax({
            type: "POST",
            url: Datasheets.ajaxUrl,
            data: {
                action: "read_csv_header",
                nonce: Datasheets.nonce,
                csvId: csvId,
            },
        }).done(function (msg) {
            console.log(msg);
        });
    }
});
