$(function () {
    $(".draggable").draggable({ revert: "valid" });

    $(".droppable").droppable({
        drop: function (event, ui) {
            const txt1 = $(this).find("p").text().trim();
            const txt2 = ui.draggable.find("p").text().trim();

            console.log(ui)
            if (txt1 === txt2) {
                ui.draggable
                    .draggable("option", "revert", "invalid")
                    .position({
                        my: "center",
                        at: "center",
                        of: $(this)
                    });
                ui.draggable.addClass("animation");
                $(this).css("background-color", "yellow");
            }

        }
    });
});