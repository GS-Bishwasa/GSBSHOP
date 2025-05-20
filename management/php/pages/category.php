<?php require "../db.php"; ?>
<div class="row">
    <div class="col-md-6">
        <div class="box p-4">
            <h1>Add Category</h1>
            <hr>
            <form class="cat_frm">
                <div class="form-group">
                    <label class="mb-2" for="category_name">Category Name</label>
                    <input type="text" class="form-control mb-3" id="category_name" name="category_name">
                    <button class="btn btn-primary cat_btn" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box p-4">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $db->query("SELECT * FROM category");
                    while ($aa = $data->fetch_assoc()) {
                        echo "<tr>
<td>" . $aa['id'] . "</td>
<td>" . $aa['category_name'] . "</td>
<td><i class='fa-solid fa-pen-to-square text-primary cat_edit_btn' id='" . $aa['id'] . "'></i></td>
<td><i class='fa-solid fa-trash text-danger'></i></td>
</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .box {
        box-shadow: 0px 0px 30px #ccc;
        border-radius: 15px;
    }
</style>
<div class="modal fade" tabindex="-1" id="cat_edit_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="edit_cat_frm">
                    <div class="form-group">
                        <label class="mb-2" for="category_name">Category Name</label>
                        <input type="text" class="form-control mb-3" id="edit_cat_name" name="edit_cat_name">
                        <input type="hidden" id="edit_cat_id" name="edit_cat_id">
                        <button class="btn btn-primary update_cat_btn" type="submit">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        const myModal = new bootstrap.Modal(document.getElementById('cat_edit_modal'))
        $(".cat_frm").on("submit", function (e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "php/add_cat.php",
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(".cat_btn").html("Please Wait...")
                    $(".cat_btn").attr("disabled", "disabled")
                },
                success: function (response) {
                    $(".cat_btn").html("Add Category")
                    $(".cat_btn").removeAttr("disabled")
                    // alert(response)
                    $("[p_link='category']").click()
                }
            });
        })
        $(".cat_edit_btn").each(function () {
            $(this).on("click", function () {
                let cat_id = $(this).attr("id")
                $.ajax({
                    type: "POST",
                    url: "php/get_cat_data.php",
                    data: {
                        cat_id: cat_id
                    },
                    success: function (response) {
                        let cat_data = JSON.parse(response)

                        $("#edit_cat_name").val(cat_data.category_name)
                        $("#edit_cat_id").val(cat_data.id)
                        
                        myModal.show()
                    }
                });
            })
        })



        $(".edit_cat_frm").on("submit", function (e) {
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "php/edit_cat.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.trim() == "Success") {
                        myModal.hide()
                        $("[p_link='category']").click()
                    }
                }
            });
        })
    })
</script>