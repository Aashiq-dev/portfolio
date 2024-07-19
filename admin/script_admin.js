let menuItem = document.querySelector('.menu-item');

menuItem.onclick = () => {
    menuItem.classList.toggle('active');
    console.log("success");
};

function confirmDeleteSkill(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this skill!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "skill_delete.php?id=" + id;
            } else {
                swal("Your skill is safe!");
            }
        });
}
function confirmDeleteService(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this service!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "service_delete.php?id=" + id;
            } else {
                swal("Your service is safe!");
            }
        });
}
function confirmDeleteCertificate(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this certificate!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "certificate_delete.php?id=" + id;
            } else {
                swal("Your certificate is safe!");
            }
        });
}
function confirmDeleteEducation(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this degree!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "education_delete.php?id=" + id;
            } else {
                swal("Your degree is safe!");
            }
        });
}
function confirmDeleteProject(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this project!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "project_delete.php?id=" + id;
            } else {
                swal("Your project is safe!");
            }
        });
}