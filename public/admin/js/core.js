//Admin File.

function addAlert(id, message, type) {
    $('#' + id).append(
            '<div class="alert alert-' + type + ' ">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
}

//var URL_ROOT = "https://www.tweekersnut-tutorial.ml/";

/*-----------------
 * Admin Functions
 ------------------*/
function markUserActive(id) {
    console.log(id);
    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/toggleUserStatus",
        data: {action: "ajax_processActivateUser", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/users";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markUserInactive(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/toggleUserStatus",
        data: {action: "ajax_processInactivateUser", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/users";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteUser(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "users/deleteUser",
            data: {action: "ajax_processDeleteUser", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/users";
                } else {
                    (data.msg.forEach(element => {
                        alert(data.msg);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function editUser(id) {

    var username = $("input[name='username_" + id + "']").val();
    var email = $("input[name='email_" + id + "']").val();
    var password = $("input[name='password_" + id + "']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/editUser",
        data: {action: "ajax_processEditUser", id: id, username: username, email: email, password: password},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/users";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        }
        ,
        error: function (err) {
            console.log(err);
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markSliderInactive(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/slider/toggleSliderStatus",
        data: {action: "ajax_processInactivateSlider", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/slider";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markSliderActive(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/slider/toggleSliderStatus",
        data: {action: "ajax_processActivateSlider", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/slider";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteSlider(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/slider/deleteSlider",
            data: {action: "ajax_processDeleteSlider", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/slider";
                } else {
                    (data.msg.forEach(element => {
                        alert(data.msg);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function deleteContactQuery(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/contact/deleteQuery",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/contact";
                } else {
                    (data.msg.forEach(element => {
                        alert(data.msg);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function markContactQueryOpen(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/contact/toggleQueryStatus",
        data: {action: "ajax_processOpenQuery", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/contact";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markContactQueryClose(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/contact/toggleQueryStatus",
        data: {action: "ajax_processCloseQuery", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/contact";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function saveSettings(id) {
    var val = $("#_key_" + id).val();
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/settings/update",
        data: {action: "ajax_processUpdateSetting", id: id, val: val},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/settings";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteAdvert(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/advert/deleteQuery",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/advert";
                } else {
                    (data.msg.forEach(element => {
                        alert(data.msg);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function markAdvertActive(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/advert/toggleQueryStatus",
        data: {action: "ajax_processOpenQuery", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/advert";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markAdvertInactive(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/advert/toggleQueryStatus",
        data: {action: "ajax_processCloseQuery", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/advert";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteSubscriber(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/newsletter/deleteQuery",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/newsletter";
                } else {
                    (data.msg.forEach(element => {
                        addAlert("admin_new_subscriber_resp", element, "danger");
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function addNewSubscriber() {
    var email = $("input[name='email']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/newsletter/add",
        data: {action: "ajax_processAddQuery", email: email},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/newsletter";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_new_subscriber_resp", element, "danger");
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function sendNewsLetter() {
    var users = [];
    $.each($("#newsEmail option:selected"), function () {
        users.push($(this).val());
    });

    var subject = $("input[name='subject']").val();
    var message = $("textarea[name='message']").val();
    addAlert("admin_sendnews_resp", "Please wait processing your request.", "info");
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/newsletter/sendnews",
        data: {action: "ajax_processSendNewsletter", users: users, subject: subject, message: message},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("admin_sendnews_resp", data.msg, "success");
                window.location = URL_ROOT + "admin/newsletter/sendnews";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_sendnews_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markUnsubscriberSubs(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/newsletter/togglenewsletterstatus",
        data: {action: "ajax_processinactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/newsletter/subscribers";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markSubscriberSubs(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/newsletter/togglenewsletterstatus",
        data: {action: "ajax_processactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/newsletter/subscribers";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteBlogCategory(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/blog/deleteCategory",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/blog/category";
                } else {
                    (data.msg.forEach(element => {
                        alert(data.msg);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function addNewBlogCategory() {
    var name = $("input[name='name']").val();
    var desc = $("input[name='desc']").val();
    var status = $("select[name='status']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/addCategory",
        data: {action: "ajax_processAddQuery", name: name, desc: desc, status: status},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                $("input[name='name']").val('');
                $("input[name='desc']").val('');
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/category";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_add_blog_cat_resp", element, 'danger');
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markInactiveBlogCategory(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglecategorystatus",
        data: {action: "ajax_processinactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/category";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markActiveBlogCategory(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglecategorystatus",
        data: {action: "ajax_processactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/category";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteBlogGenre(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/blog/deletegenre",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/blog/genre";
                } else {
                    (data.msg.forEach(element => {
                        alert(element);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function markInactiveBlogGenre(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglegenrestatus",
        data: {action: "ajax_processinactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/genre";
            } else {
                (data.msg.forEach(element => {
                    alert(element);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markActiveBlogGenre(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglegenrestatus",
        data: {action: "ajax_processactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/genre";
            } else {
                (data.msg.forEach(element => {
                    alert(data.msg);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function addNewBlogGenre() {
    var name = $("input[name='name']").val();
    var status = $("select[name='status']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/addGenre",
        data: {action: "ajax_processAddQuery", name: name, status: status},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                $("input[name='name']").val('');
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/genre";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_add_blog_genre_resp", element, 'danger');
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}


function deleteBlogPlatform(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/blog/deleteplatform",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/blog/platform";
                } else {
                    (data.msg.forEach(element => {
                        alert(element);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function markInactiveBlogPlatform(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/toggleplatformstatus",
        data: {action: "ajax_processinactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/platform";
            } else {
                (data.msg.forEach(element => {
                    alert(element);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markActiveBlogPlatform(id) {
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/toggleplatformstatus",
        data: {action: "ajax_processactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/platform";
            } else {
                (data.msg.forEach(element => {
                    alert(element);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function addNewBlogPlatform() {
    var name = $("input[name='name']").val();
    var status = $("select[name='status']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/addPlatform",
        data: {action: "ajax_processAddQuery", name: name, status: status},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                $("input[name='name']").val('');
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/platform";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_add_blog_platform_resp", element, 'danger');
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function deleteBlogPost(id) {
    var result = confirm("Are you sure to delete?");
    if (result) {
        $.ajax({
            type: "POST",
            url: URL_ROOT + "admin/blog/deletepost",
            data: {action: "ajax_processDeleteQuery", id: id},
            success: function (resp) {
                console.log(resp);
                var data = JSON.parse(resp);
                if (data.status != 0) {
                    alert(data.msg);
                    window.location = URL_ROOT + "admin/blog/";
                } else {
                    (data.msg.forEach(element => {
                        alert(element);
                    }));
                }
            },
            error: function (err) {
                alert("Critical Error Contact Developer");
            },
            complete: function () {
                console.log("Task Complete");
            }
        });
    }
}

function markBlogPostDraft(id){
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglepoststatus",
        data: {action: "ajax_processinactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/";
            } else {
                (data.msg.forEach(element => {
                    alert(element);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}

function markBlogPostPublish(id){
    $.ajax({
        type: "POST",
        url: URL_ROOT + "admin/blog/togglepoststatus",
        data: {action: "ajax_processactivate", id: id},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                alert(data.msg);
                window.location = URL_ROOT + "admin/blog/";
            } else {
                (data.msg.forEach(element => {
                    alert(element);
                }));
            }
        },
        error: function (err) {
            alert("Critical Error Contact Developer");
        },
        complete: function () {
            console.log("Task Complete");
        }
    });
}


/*------------------
 Ajax Functions
 --------------------*/

$("#admin_login").submit(function (e) {
    e.preventDefault();

    var email = $("input[name='email']").val();
    var password = $("input[name='password']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/auth",
        data: {action: "ajax_processLogin", email: email, password: password},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("admin_login_resp", data.msg, "success");
                window.location = URL_ROOT + "admin/index";
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_login_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});


$("#admin_add_new_user").submit(function (e) {
    e.preventDefault();

    var email = $("input[name='email']").val();
    var password = $("input[name='password']").val();
    var username = $("input[name='username']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/add",
        data: {action: "ajax_processAddUser", username: username, email: email, password: password},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("admin_add_user_resp", data.msg, "success");
                $("input[name='email']").val();
                $("input[name='email']").val();
                $("input[name='username']").val();
            } else {
                (data.msg.forEach(element => {
                    addAlert("admin_add_user_resp", element, "danger");
                }));
                setTimeout(function () {
                    $("#admin_add_user_resp").html('');
                }, 5000);
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });

});
