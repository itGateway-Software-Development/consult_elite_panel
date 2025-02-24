$(document).ready(function() {
    let contentEditor;
    let content = document.querySelectorAll('.cke-editor');
    if(content) {
        content.forEach(item => {
            ClassicEditor
            .create(item)
            .then(editor => {
                contentEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
        })
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
        ajax: '/admin/content-management/success-rate/datatable-lists',
        columns: [{
                data: 'plus-icon',
                name: 'plus-icon'
            },
            {
                data: 'order_number',
                name: 'order_number'
            },
            {
                data: 'rate_count_eng',
                name: 'rate_count_eng'
            },
            {
                data: 'rate_count_mm',
                name: 'rate_count_mm'
            },
            {
                data: 'description_eng',
                name: 'description_eng'
            },
            {
                data: 'description_mm',
                name: 'description_mm'
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
    $(document).on('submit', '#success_rate_create_form', function(e) {
        e.preventDefault();

        const field_status = check_fields_validation();
        if(!field_status) {
            return;
        }

        ask_confirm().then(result => {
            if(result.isConfirmed) {
                let formData = new FormData($('#success_rate_create_form')[0]);

                $.ajax({
                    url: "/admin/content-management/success-rate",
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
                            window.location.href = "/admin/content-management/success-rate";
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
    $(document).on('submit', '#success_rate_edit_form', function(e) {
        e.preventDefault();

        const field_status = check_fields_validation();
        if(!field_status) {
            return;
        }

        ask_confirm().then(result => {
            if(result.isConfirmed) {
                let formData = new FormData($('#success_rate_edit_form')[0]);
                let id = $('#success_rate_id').val();

                $.ajax({
                    url: "/admin/content-management/update-success-rate/"+id,
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
                            window.location.href = "/admin/content-management/success-rate";
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
                    url: "/admin/content-management/success-rate/" + id,
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

        let names = [
            "rate_count_eng",
            "rate_count_mm",
            "order_number",
            "description_eng",
            "description_mm"
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
