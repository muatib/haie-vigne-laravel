document.addEventListener('DOMContentLoaded', function() {
    let courses = document.getElementsByName('courses[]');

    courses.forEach(function(course) {
        course.addEventListener('change', calculateTotal);
    });

    function calculateTotal() {
        let checkedCourses = document.querySelectorAll('input[name="courses[]"]:checked').length;

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

        document.getElementById('total').textContent = total + ' €';
        document.getElementById('total_input').value = total;
    }

    calculateTotal();
});
