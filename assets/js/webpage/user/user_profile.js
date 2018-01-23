app.controller('userProfileController', function ($scope, $http) {
    $scope.active = $scope.active == item ? '' : item;
    $scope.makeActive = function (item) {
        $scope.active = $scope.active == item ? '' : item;
    }
    $scope.contact = function (id, status, to_id) {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/addcontact',
            data: 'contact_id=' + id + '&status=' + status + '&to_id=' + to_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {

                    $scope.contact_value = success.data;
                });
    }
    $scope.follow = function (id, status, to_id) {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/addfollow',
            data: 'follow_id=' + id + '&status=' + status + '&to_id=' + to_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    $scope.follow_value = success.data;
                });
    }
})
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
            .when("/profiless/:name*", {
                templateUrl: base_url + "userprofile_page/profile",
                controller: 'profilesController'
            })
            .when("/dashboardd/:name*", {
                templateUrl: base_url + "userprofile_page/dashboard"
            })
            .when("/details/:name*", {
                templateUrl: base_url + "userprofile_page/details",
                controller: 'detailsController'
            })
            .when("/contacts/:name*", {
                templateUrl: base_url + "userprofile_page/contacts",
                controller: 'contactsController'
            })
            .when("/followers/:name*", {
                templateUrl: base_url + "userprofile_page/followers",
                controller: 'followersController'
            })
            .when("/following/:name*", {
                templateUrl: base_url + "userprofile_page/following",
                controller: 'followingController'
            })
    $locationProvider.html5Mode(true);
});
app.controller('profilesController', function ($scope, $http, $location) {
    $scope.user = {};
    // PROFEETIONAL DATA
    getFieldList();
    function getFieldList() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/profiles_data',
            data: 'u=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    details_data = success.data;
                    $scope.details_data = details_data;
                });
    }
});
app.controller('detailsController', function ($scope, $http, $location) {
    $scope.user = {};
    // PROFEETIONAL DATA
    getFieldList();
    function getFieldList() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/detail_data',
            data: 'u=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    details_data = success.data;
                    $scope.details_data = details_data;
                });
    }
    $scope.goMainLink = function (path) {
        location.href = path;
    }
    $scope.makeActive = function (item) {
        $scope.active = $scope.active == item ? '' : item;
    }
});
app.controller('contactsController', function ($scope, $http, $location) {
    $scope.user = {};
    var id = 1;
    $scope.remove = function (index) {
        $('#remove-contact .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn btn1' id=" + id + " onClick='remove_contacts(" + index + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn btn1' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#remove-contact').modal('show');
    }
    // PROFEETIONAL DATA
    getFieldList();
    function getFieldList() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/contacts_data',
            data: 'u=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    $scope.contats_data = success.data;
                });
    }
    $scope.goUserprofile = function (path) {
        var base_url = '<?php echo base_url(); ?>';
        location.href = base_url + 'profiless/' + path;
    }
});
app.controller('followersController', function ($scope, $http, $location, $compile) {
    $scope.user = {};
    var id = 1;
    $scope.follow = function (index) { }

    // PROFEETIONAL DATA
    getFieldList();
    function getFieldList() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/followers_data',
            data: 'u=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    $scope.follow_data = success.data;
                });
    }

    $scope.follow_user = function (id) {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/follow_user',
            data: 'to_id=' + id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {

                    $("#" + id).html($compile(success.data)($scope));
                });
    }
    $scope.unfollow_user = function (id) {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/unfollow_user',
            data: 'to_id=' + id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {

                    $("#" + id).html($compile(success.data)($scope));
                });
    }
    $scope.goUserprofile = function (path) {
        location.href = base_url + 'profiless/' + path;
    }
});
app.controller('followingController', function ($scope, $http, $location, $compile) {
    $scope.user = {};
    var id = 1;
    $scope.follow = function (index) { 
    }
    // PROFEETIONAL DATA
    getFieldList();
    function getFieldList() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/following_data',
            data: 'u=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    $scope.follow_data = success.data;
                });
    }
    $scope.unfollow_user = function (id) {
        $http({
            method: 'POST',
            url: base_url + 'userprofile_page/unfollowingContacts',
            data: 'to_id=' + id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    if (success.data == 1) {
                        $('#' + id).closest('.custom-user-box').fadeToggle();
                    }


                });
    }
    $scope.goUserprofile = function (path) {

        var base_url = '<?php echo base_url(); ?>';
        location.href = base_url + 'profiless/' + path;
    }
});
function remove_contacts(index) {
    $.ajax({
        url: base_url + "userprofile_page/removeContacts",
        type: "POST",
        data: {"id": index},
        success: function (data) {
            if (data == 1) {
                $('#' + index).closest('.custom-user-box').fadeToggle();
            }
        }
    });
}
function unfollowing_contacts(index) {
    $.ajax({
        url: base_url + "userprofile_page/unfollowingContacts",
        type: "POST",
        data: {"id": index},
        success: function (data) {
            if (data == 1) {
                $('#' + index).closest('.custom-user-box').fadeToggle();
            }
        }
    });
}
$uploadCrop1 = $('#upload-demo-one').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('#upload-one').on('change', function () {
    document.getElementById('upload-demo-one').style.display = 'block';
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop1.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});
$("#userimage").validate({
    rules: {
        profilepic: {
            required: true,
        },
    },
    messages: {
        profilepic: {
            required: "Photo Required",
        },
    },
    submitHandler: profile_pic
});
function profile_pic() {
    $uploadCrop1.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            url: base_url + "userprofile_page/user_image_insert1",
            type: "POST",
            data: {"image": resp},
            beforeSend: function () {
                $('#profi_loader').show();
            },
            complete: function () {
            },
            success: function (data) {
                $('#profi_loader').hide();
                $('#bidmodal-2').modal('hide');
                $(".profile-img").html(data);
                document.getElementById('upload-one').value = null;
                document.getElementById('upload-demo-one').value = '';
            }
        });
    });
}

function updateprofilepopup(id) {
    document.getElementById('upload-demo-one').style.display = 'none';
    document.getElementById('profi_loader').style.display = 'none';
    document.getElementById('upload-one').value = null;
    $('#bidmodal-2').modal('show');
}
function myFunction() {

    document.getElementById("upload-demo").style.visibility = "hidden";
    document.getElementById("upload-demo-i").style.visibility = "hidden";
    document.getElementById('message1').style.display = "block";
}
function showDiv() {

    document.getElementById('row1').style.display = "block";
    document.getElementById('row2').style.display = "none";
    $(".cr-image").attr("src", "");
    $("#upload").val('');
}
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1250,
        height: 350,
        type: 'square'
    },
    boundary: {
        width: 1250,
        height: 350
    }
});
$('.upload-result').on('click', function (ev) {

    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {

        $.ajax({
            url: base_url + "userprofile_page/ajaxpro",
            type: "POST",
            data: {"image": resp},
            success: function (data) {
                if (data) {
                    $("#row2").html(data);
                    document.getElementById('row2').style.display = "block";
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('message1').style.display = "none";
                    document.getElementById("upload-demo").style.visibility = "visible";
                    document.getElementById("upload-demo-i").style.visibility = "visible";
                }
            }
        });
    });
});
$('.cancel-result').on('click', function (ev) {

    document.getElementById('row2').style.display = "block";
    document.getElementById('row1').style.display = "none";
    document.getElementById('message1').style.display = "none";
    $(".cr-image").attr("src", "");
});
$('#upload').on('change', function () {

    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});
$('#upload').on('change', function () {

    var fd = new FormData();
    fd.append("image", $("#upload")[0].files[0]);
    files = this.files;
    size = files[0].size;
    if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        picpopup();
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        return false;
    }
    if (size > 26214400)
    {
        alert("Allowed file size exceeded. (Max. 25 MB)")
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        return false;
    }
});