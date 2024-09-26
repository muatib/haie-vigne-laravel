function calculateTotal() {
    let courses = document.getElementsByName('courses[]');
    let checkedCourses = 0;

    for (var i = 0; i < courses.length; i++) {
        if (courses[i].checked) {
            checkedCourses++;
        }
    }

    let total;
    if (checkedCourses === 0) {
        total = 0;
    } else if (checkedCourses === 1) {
        total = 136;
    } else if (checkedCourses === 2) {
        total = 216;
    } else if (checkedCourses === 3) {
        total = 276;
    } else {
        total = 326;
    }
    document.getElementById('total').textContent = total;
    document.getElementById('total_input').value = total;
    document.getElementById('total').textContent = total;
}

window.onload = calculateTotal;
document.getElementsByName('courses[]').forEach(function(course) {
    course.addEventListener('change', calculateTotal);
});
