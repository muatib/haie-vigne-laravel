/**
 * This script handles the course selection and pricing calculation for a registration form.
 * It also manages the behavior of checkboxes within question items.
 */
document.addEventListener("DOMContentLoaded", function () {
    // Select all course checkboxes and question items
    let courses = document.getElementsByName("courses[]");
    const questionItems = document.querySelectorAll(".lst-itm");

    // Add change event listener to each course checkbox
    courses.forEach(function (course) {
        course.addEventListener("change", calculateTotal);
    });

    /**
     * Calculates the total price based on the number of selected courses
     * and updates the display and hidden input field.
     */
    function calculateTotal() {
        // Count the number of checked course checkboxes
        let checkedCourses = document.querySelectorAll(
            'input[name="courses[]"]:checked'
        ).length;

        // Determine the total price based on the number of selected courses
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

        // Update the displayed total and the hidden input field
        document.getElementById("total").textContent = total + " €";
        document.getElementById("total_input").value = total;
    }

    // Calculate the initial total on page load
    calculateTotal();

    // Set up behavior for checkboxes within question items
    questionItems.forEach((item) => {
        const checkboxes = item.querySelectorAll('input[type="checkbox"]');

        // Add change event listener to each checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                // If the checkbox is checked, uncheck all other checkboxes in the same question item
                if (this.checked) {
                    checkboxes.forEach((cb) => {
                        if (cb !== this) {
                            cb.checked = false;
                        }
                    });
                }
            });
        });
    });
});
