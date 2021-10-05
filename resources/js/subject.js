// Fetch subject listing
var subject_list = $("#subject_list").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: $("#subject_list").attr("data-route"),
        dataType: "json",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    },

    columns: [
        {
            bSortable: false,
            data: "id",
        },
        { data: "title" },
        { data: "name" },
        { data: "description" },
        {
            data: "options",
            bSortable: false,
            mRender: function (data, type, row) {
                return `
                <div class="d-flex">
                    <button type="button" onClick="viewSubject(${data})" class="btn btn-success m-1 ">
                        <i class="fas fa-eye "></i>
                    </button>
                    <button type="button" onClick="deleteSubject(${data})" class="btn btn-danger m-1">
                        <i class="fas fa-trash "></i>
                    </button>
                </div>
                `;
            },
        },
    ],
});

function successAlert(message) {
    swal({
        position: "center",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 2000,
        buttons: false,
    });
}

function errorAlert(message) {
    swal({
        position: "center",
        icon: "error",
        title: message,
        showConfirmButton: false,
        timer: 3000,
        buttons: false,
    });
}

$(document).ready(function () {
    window.deleteSubject = function (id) {
        swal({
            title: "Are you sure?",
            text: "* Are you sure you want to delete this subject",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result) {
                deleteClub(id);
            }
        });
    };

    window.viewSubject = function (id) {
        $("#modalViewSubject").modal("show");
        $("#subject_info_loader").show();
        $("#subject_info_table").hide();
        $.ajax({
            url: $("#subject_list")
                .attr("get-subject-route")
                .replace(":id", id),
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success && response.data) {
                    $("#subject_title").text(response.data.title);
                    $("#subject_name").text(response.data.name);
                    $("#subject_description").text(response.data.description);
                } else {
                    errorAlert("Opps! Something went wrong");
                }
                $("#subject_info_loader").hide();
                $("#subject_info_table").show();
            },
            error: function (response) {
                errorAlert("Opps! Something went wrong");
                $("#subject_info_loader").hide();
                $("#subject_info_table").show();
            },
        });
    };

    function deleteClub(id) {
        $.ajax({
            url: $("#subject_list").attr("delete-route").replace(":id", id),
            type: "DELETE",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            success: function (response) {
                successAlert(response.message);
                subject_list.ajax.reload(null, false);
            },
            error: function (response) {
                errorAlert(response.responseJSON.message);
            },
        });
    }
});

// Creating new Subject
$("#add_subject_loader").hide();

$("#add_subject").submit(function (e) {
    e.preventDefault();
    $("#add_subject_btn").prop("disabled", true);
    $("#add_subject_btn").hide();
    $("#add_subject_loader").show();

    $.ajax({
        url: $(this).attr("action"),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        data: $("#add_subject").serialize(),
        success: function (response) {
            $("#modalAddSubjectForm").modal("hide");
            $("#add_subject").trigger("reset");
            subject_list.ajax.reload(null, false);
            successAlert(response.message);
            $("#add_subject_btn").prop("disabled", false);
            $("#add_subject_btn").show();
            $("#add_subject_loader").hide();
        },
        error: function (response) {
            $("#add_subject_btn").prop("disabled", false);
            $("#add_subject_btn").show();
            $("#add_subject_loader").hide();
            errorAlert(response.responseJSON.message);
        },
    });
});
