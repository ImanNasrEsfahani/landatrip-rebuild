//star
const starInputs = document.querySelectorAll('.mask.mask-star-2');
console.log("starInputs")
starInputs.forEach(input => {
    input.addEventListener('click', function () {
        console.log("click");
        // Unselect all stars
        starInputs.forEach(starInput => {
            starInput.checked = false;
        });

        // Select the clicked star and all preceding stars
        input.checked = true;
        console.log(input.checked);

        let selectedValue = input.value;
        // You can now use 'selectedValue' to send or store the user's rating.
        console.log(selectedValue);
    });
});
