$(function () {
    $(document).on("click", ".btn-cancel", function () {
        $("#modalCreateNote").modal("hide");
    })
    
    $(document).on("click", ".btn-create", function() {
        $(".status-block").html("");
        $("#note-title").text("Create");
        $("#noteForm button[type='submit']").text("Create");
        $("#noteForm button[type='submit']").attr("data-id", undefined);
        $("input[name='title']").val("");
        $("input[name='description']").val("");
        $("input[name='type']").val("");
        $("#modalCreateNote").modal("show");
    })

    function listAllNotes(data) {
        const renderData = $.map(data, function (item) {
            return `
                <tr>
                    <td>${item.note_id}</td>
                    <td>${item.title}</td>
                    <td>${item.description}</td>
                    <td>${item.type}</td>
                    <td>${item.status}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-warning btn-sm btn-edit" data-id='${item.note_id}'>Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id='${item.note_id}'>Delete</button>
                        </div>
                    </td>
                </tr>
            `;
        })

        $("#noteTable tbody").html(renderData.join(""));
    }

    function allAction() {
        $("#noteForm").submit(function (e) {
            e.preventDefault();
            var note_id = $("#noteForm button[type='submit']").attr("data-id");
            var title = $("input[name='title']").val();
            var description = $("input[name='description']").val();
            var type = $("input[name='type']").val();
            var status = $("select[name='status']").val();
            var payload = note_id ? {note_id, title, description, type, status} : {title, description, type};
    
            $.ajax({
                type: "POST",
                url: "./controllers/noteController.php",
                data: {
                    method: !note_id ? "INS" : "EDI",
                    ...payload
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 200) {
                        alert(`${note_id ? "Edited" : "Created"} successfully`);
                        $("#modalCreateNote").modal("hide");
                        listAllNotes(res.data);
                    }
                },
                error: function() {
                    console.log("Something error!");
                }
            })
        })
    
        $(document).on("click", ".btn-edit", function() {
            $("#note-title").text("Edit");
            $("#noteForm button[type='submit']").text("Edit");
            var id = $(this).attr("data-id");
            $("#noteForm button[type='submit']").attr("data-id", id);
    
            $.ajax({
                type: "POST",
                url: "./controllers/noteController.php",
                data: {
                    method: "GET_ID",
                    note_id: id
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 200) {
                        console.log(res.data)
                        $(".status-block").html(`
                            <div class="form-group d-block mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        `);
                        $("input[name='title']").val(res.data.title);
                        $("input[name='description']").val(res.data.description);
                        $("input[name='type']").val(res.data.type);
                        $("select[name='status']").val(res.data.status);
                        $("#modalCreateNote").modal("show");
                    }
                },
                error: function() {
                    console.log("Something error!");
                }
            })
        })
    
        $(document).on("click", ".btn-delete", function () {
            var id = $(this).attr("data-id");
            var confirmation = confirm("Are you sure to delete this note?");
    
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "./controllers/noteController.php",
                    data: {
                        method: "DEL",
                        note_id: id
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.status === 200) {
                            alert("Deleted successfully");
                            listAllNotes(res.data);
                        }
                    },
                    error: function() {
                        console.log("Something error!");
                    }
                })
            }
        })
    }

    $.ajax({
        type: "POST",
        url: "./controllers/noteController.php",
        data: {
            method: "GET"
        },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.status === 200) {
                listAllNotes(res.data);
            }
        },
        error: function(err) {
            console.log("Something error! " + JSON.stringify(err));
        }
    })
    
    allAction();
})