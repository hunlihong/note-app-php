<?php
    include "./config/dbConfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-lg my-5">
        <h3>Note App</h3>
        <div class="d-flex my-5">
            <button class="btn btn-dark btn-create">Create note</button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="noteTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modalCreateNote">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><span id="note-title"></span> Note</h3>
                </div>
                <div class="modal-body">
                    <form id="noteForm">
                        <div class="form-group d-block mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control"/>
                        </div>
                        <div class="form-group d-block mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control"/>
                        </div>
                        <div class="form-group d-block mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control"/>
                        </div>
                        <div class="status-block"></div>
                        <div class="mt-5 d-flex justify-content-end align-items-center gap-2">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-dark" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./lib/ajax/note.js"></script>
</body>
</html>