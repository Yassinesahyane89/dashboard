const body = document.querySelector("body"),
  modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
  sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  if (sidebar.classList.contains("close")) {
    localStorage.setItem("status", "close");
  } else {
    localStorage.setItem("status", "open");
  }
});

var table;
$(document).ready(function() {
    table = $("#users-table").DataTable({
        processing: true,
        // serverSide: true,
        ajax: {
            url: "database.php",
            type: "POST"
        },
        columns: [
            { data: "id" },
            { data: "username" },
            { data: "email" },
            {
                data: null,
                render: function(data, type, row) {
                    return (
                      '<button class="edit-btn btn btn-primary" data-id="' +
                      row.id +
                      '">Edit</button>' +
                      '<button class="delete-btn btn btn-danger" data-id="' +
                      row.id +
                      '">Delete</button>'
                    );
                }
            }
        ]
    });
});

$("#add-btn").click(function () {
  $("#modal-title").text("Add User");
  $("#name-input").val("");
  $("#email-input").val("");
  $("#save-btn").show();
  $("#update-btn").hide();
  $("#add-update-modal").modal("show");
});

var data;
$("#users-table tbody").on("click", ".edit-btn", function () {
  data = table.row($(this).parents("tr")).data();
  $("#modal-title").text("Update User");
  $("#name-input").val(data.username);
  $("#email-input").val(data.email);
  $("#save-btn").hide();
  $("#update-btn").show();
  $("#add-update-modal").modal("show");
});

 var fields;
$("#add-user-btn").click(function () {
    fields = `
                  <div class="form-group">
                      <label for="name-input">Name</label>
                      <input type="text" class="form-control" id="name-input" name="name[]">
                  </div>
                  <div class="form-group">
                      <label for="email-input">Email</label>
                      <input type="email" class="form-control" id="email-input" name="email[]">
                  </div>
              `;
  $("#users-fields").append(fields);
});

$("#save-btn").click(function () {
  var names = $("input[name='name[]']")
    .map(function () {
      return $(this).val();
    })
    .get();
  var emails = $("input[name='email[]']")
    .map(function () {
      return $(this).val();
    })
    .get();
  $.ajax({
    url: "database.php",
    type: "POST",
    data: {
      action: "insert",
      names: names,
      emails: emails,
    },
    success: function (response) {
      table.ajax.reload();
      $("#add-update-modal").modal("hide");
      $("#users-fields").html(fields);
    },
  });
});

$("#update-btn").click(function() {
    var id = data.id;
    var name = $("#name-input").val();
    var email = $("#email-input").val();
    console.log(name)
    console.log(email)

    $.ajax({
        url: "database.php",
        type: "POST",
        data: {
            action: "update",
            id: id,
            username: name,
            email: email
        },
        success: function(response) {
            table.ajax.reload();

            $("#add-update-modal").modal("hide");
        }
    });
});

$("#users-table tbody").on("click", ".delete-btn", function () {
  var data = table.row($(this).parents("tr")).data();
  console.log(data);
  console.log(data.id);
  $.ajax({
    url: "database.php",
    type: "POST",
    data: {
      action: "delete",
      id: data.id,
    },
    success: function (response) {
      table.ajax.reload();
    },
  });
});
