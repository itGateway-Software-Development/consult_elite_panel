$(document).ready(function() {
    let contentEditor;
    let content = document.querySelector('.content');
    if(content) {
        ClassicEditor
        .create(content)
        .then(editor => {
            contentEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
    }


    $(document).on('change', '.image', function(e) {
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    const table = new DataTable('#DataTable', {
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: '/admin/activity-management/blogs/datatable-lists',
        columns: [{
                data: 'plus-icon',
                name: 'plus-icon'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'content',
                name: 'content'
            },
            {
                data: 'action',
                data: 'action',
            }
        ],
        columnDefs: [{
            targets: 'no-sort',
            sortable: false,
            searchable: false
        }, {
            targets: [0],
            class: 'control'
        }]
    })

    //submit create form
    $(document).on('submit', '#blog_create_form', function(e) {
        e.preventDefault();

        const field_status = check_fields_validation();
        if(!field_status) {
            return;
        }

        ask_confirm().then(result => {
            if(result.isConfirmed) {
                let formData = new FormData($('#blog_create_form')[0]);

                $.ajax({
                    url: "/admin/activity-management/blogs",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (res) {
                        console.log(res);
                        if (res == "success") {
                            window.location.href = "/admin/activity-management/blogs";
                        }
                    },
                    error: function (xhr, status, err) {
                        //validation error
                        if (xhr.status === 422) {
                            let noti = ``;
                            for (const key in xhr.responseJSON.errors) {
                                console.log(xhr.responseJSON.errors[key][0]);
                                noti += `
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ${xhr.responseJSON.errors[key][0]}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            `;
                            }

                            $(".error").html(noti);

                            toast_error("Something went wrong !");

                            // Scroll to the top of the browser window
                            $("html, body").animate({ scrollTop: 0 });
                        } else {
                            toast_error("Something wrong");
                        }
                    },
                })
            }
        })

    })

    //submit edit form
    $(document).on('submit', '#blog_edit_form', function(e) {
        e.preventDefault();

        const field_status = check_fields_validation();
        if(!field_status) {
            return;
        }

        ask_confirm().then(result => {
            if(result.isConfirmed) {
                let formData = new FormData($('#blog_edit_form')[0]);
                let id = $('#blog_id').val();

                $.ajax({
                    url: "/admin/activity-management/update-blogs/"+id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (res) {
                        console.log(res);
                        if (res == "success") {
                            window.location.href = "/admin/activity-management/blogs";
                        }
                    },
                    error: function (xhr, status, err) {
                        //validation error
                        if (xhr.status === 422) {
                            let noti = ``;
                            for (const key in xhr.responseJSON.errors) {
                                console.log(xhr.responseJSON.errors[key][0]);
                                noti += `
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ${xhr.responseJSON.errors[key][0]}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            `;
                            }

                            $(".error").html(noti);

                            toast_error("Something went wrong !");

                            // Scroll to the top of the browser window
                            $("html, body").animate({ scrollTop: 0 });
                        } else {
                            toast_error("Something wrong");
                        }
                    },
                })
            }
        })

    })

    //delete
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure to delete ?',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/activity-management/blogs/" + id,
                    type: "DELETE",
                    data: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(res) {
                        if(res == 'success') {
                            table.ajax.reload();
                            toast_success("Success !")
                        } else {
                            toast_error("Something went wrong !")
                            console.log(res);
                        }
                    }
                })
            }
        })
    })

    const check_fields_validation = () => {
        let status = true;

        let blog_id = $('#blog_id').val();

        let names = [
            "date",
            "title",
            blog_id ? null : "image",
            "content",
        ];

        let err = [];

        names.forEach((name) => {
            if(name) {
                if ($(`.${name}`).val() == "" || $(`.${name}`).val() == null) {
                    $(`.${name}_err`).html("Need to be filled");
                    err.push(name);
                } else {
                    $(`.${name}_err`).html(" ");
                    if (err.includes(name)) {
                        err.splice(err.indexOf(`${name}`), 1);
                    }
                }
            }
        });

        if (err.length > 0) {
            toast_error("Please fill require fields !");
            window.scrollTo(0, 0);
            status = false;
        }

        if(err.length == 0) {
            status = true;
        }

        return status
    }
})
