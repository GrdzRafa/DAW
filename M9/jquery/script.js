jQuery.noConflict();
// $(document).ready(function(){})

jQuery(document).ready(function ($) {

  function saveTasksToLocalStorage(type) {
    switch (type) {
      case "backlog":
        localStorage.setItem("backlog", $("#sortable2").html());
        break;
      case "sprint":
        localStorage.setItem("sprint", $(".sortable1").html());
        break;
      case "doing":
        localStorage.setItem("doing", $("#sortable3").html());
        break;
      case "done":
        localStorage.setItem("done", $("#sortable4").html());
        break;
      default:
        localStorage.setItem("backlog", $("#sortable2").html());
        localStorage.setItem("sprint", $(".sortable1").html());
        localStorage.setItem("doing", $("#sortable3").html());
        localStorage.setItem("done", $("#sortable4").html());
        break;
    }
  }


  function loadTasksFromLocalStorage() {
    if (localStorage.getItem("backlog")) {
      $("#sortable2").html(localStorage.getItem("backlog"));
    }
    if (localStorage.getItem("sprint")) {
      $(".sortable1").html(localStorage.getItem("sprint"));
    }
    if (localStorage.getItem("doing")) {
      $("#sortable3").html(localStorage.getItem("doing"));
    }
    if (localStorage.getItem("done")) {
      $("#sortable4").html(localStorage.getItem("done"));
    }
  }

  loadTasksFromLocalStorage();

  if (window.location.href == 'http://127.0.0.1:3000/index.html') {
    saveTasksToLocalStorage("sprint");
    saveTasksToLocalStorage("backlog");
  } else if (window.location.href == 'http://127.0.0.1:3000/kanban.html') {
    saveTasksToLocalStorage("sprint");
    saveTasksToLocalStorage("doing");
    saveTasksToLocalStorage("done");
  }


  $(function () {
    $(".datepicker").datepicker();
  });

  $(function () {
    var dialog, form,
      tasca = $("#tasca"),
      tipus = $("#tipus"),
      dataIni = $("#data-ini"),
      dataFi = $("#data-fi"),
      allFields = $([]).add(tasca).add(tipus).add(dataIni).add(dataFi),
      tips = $(".validateTips");

    function updateTips(t) {
      tips
        .text(t)
        .addClass("ui-state-highlight");
      setTimeout(function () {
        tips.removeClass("ui-state-highlight", 1500);
      }, 500);
    }

    function checkLength(o, n, min, max) {
      if (o.val().length > max || o.val().length < min) {
        o.addClass("ui-state-error");
        updateTips("La longitud del camp " + n + " ha de ser entre " +
          min + " i " + max + " caràcters.");
        return false;
      } else {
        return true;
      }
    }

    function checkRegexp(o, regexp, n) {
      if (!(regexp.test(o.val()))) {
        o.addClass("ui-state-error");
        updateTips(n);
        return false;
      } else {
        return true;
      }
    }

    function checkDates(o1, o2) {
      if (o1.val() > o2.val()) {
        o1.addClass("ui-state-error");
        o2.addClass("ui-state-error");
        updateTips("La data d'inici no pot ser posterior a la data final.")
        return false;
      } else {
        return true;
      }
    }

    function addTask() {
      var valid = true;
      allFields.removeClass("ui-state-error");

      valid = valid && checkLength(tasca, "task", 1, 16);
      valid = valid && checkLength(tipus, "tipus", 1, 80);

      valid = valid && checkRegexp(tasca, /^[a-z]([0-9a-z_\s])+$/i, "La tasca ha de consistir en a-z, 0-9, guions baixos, espais i ha de començar amb una lletra.");
      valid = valid && checkRegexp(tipus, /^[a-z]([0-9a-z_\s])+$/i, "El tipus ha de consistir en a-z, 0-9, guions baixos, espais i ha de començar amb una lletra.");

      valid = valid && checkDates(dataIni, dataFi);

      if (valid) {
        $("#tasks tbody").append("<tr>" +
          "<td>" + tasca.val() + "</td>" +
          "<td>" + tipus.val() + "</td>" +
          "<td>" + dataIni.val() + "</td>" +
          "<td>" + dataFi.val() + "</td>" +
          "</tr>");

        saveTasksToLocalStorage();
        dialog.dialog("close");
      }
      return valid;
    }

    dialog = $("#dialog-form").dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Crear nova tasca": addTask,
        Cancel: function () {
          dialog.dialog("close");
        }
      },
      close: function () {
        form[0].reset();
        allFields.removeClass("ui-state-error");
      }
    });

    form = dialog.find("form").on("submit", function (event) {
      event.preventDefault();
      addTask();
    });

    $("#create-task").button().on("click", function () {
      dialog.dialog("open");
    });
  });

  $(".sortable").sortable({
    connectWith: "tbody"
  });

  $(function () {
    $(".sortable1, #sortable2, #sortable3, #sortable4").sortable({
      connectWith: ".connectedSortable",
      update: function () {
        saveTasksToLocalStorage();
      }
    }).disableSelection();

    $("thead").on("mousedown", function (event) {
      event.stopImmediatePropagation();
    });
  });

  $(function () {
    var $trash = $("#trash");

    $(".sortable1", "#sortable2").draggable({
      cancel: "a.ui-icon",
      revert: "invalid",
      containment: "document",
      helper: "clone",
      cursor: "move"
    });

    $trash.droppable({
      accept: ".sortable1 > tr, #sortable2 > tr, #sortable3 tr, #sortable4 tr",
      classes: {
        "ui-droppable-active": "ui-state-highlight"
      },
      drop: function (event, ui) {
        ui.draggable.remove();
      },
      update: function () {
        saveTasksToLocalStorage();
      }
    });

    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
    function deleteImage($item) {
      $item.fadeOut(function () {
        var $list = $("ul", $trash).length ?
          $("ul", $trash) :
          $("<ul class='gallery ui-helper-reset'/>").appendTo($trash);
        $item.find("a.ui-icon-trash").remove();
        saveTasksToLocalStorage();
      });
    }
  });


})