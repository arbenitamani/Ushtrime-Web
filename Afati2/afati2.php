

<html>
    <head><title>Afati2</title></head>

    <body>
       
            <img src="logo.png" width="100px" height="100px" />

            <input type=>
      


        <main></main>
    </body>
</html>





<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to validate the form
        function validateForm() {
            // Get form inputs
            var dateInput = document.getElementById('dateInput');
            var authorInput = document.getElementById('authorInput');
            var titleInput = document.getElementById('titleInput');
            var descriptionInput = document.getElementById('descriptionInput');

            // Check if any field is empty
            if (dateInput.value === '' || authorInput.value === '' || titleInput.value === '' || descriptionInput.value === '') {
                alert('Please fill in all fields');
                return false;
            }


          

            // Form is valid
            return true;
        }

        // Attach event listener to the Save button
        document.getElementById('saveButton').addEventListener('click', function () {
            // Validate the form before submitting
            if (validateForm()) {
                // Submit the form or perform other actions
                alert('Form submitted successfully!');
            }
        });
    });
</script>