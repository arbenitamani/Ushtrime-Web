<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "afati2"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "connected successfully";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $date = $_POST['dateInput'];
    $author = $_POST['authorInput'];
    $title = $_POST['titleInput'];
    $description = $_POST['descriptionInput'];

    // Validate form data
    if (empty($date) || empty($author) || empty($title) || empty($description)) {
        echo "Please fill in all fields";
    } else {
        // Validate date format (dd.mm.yyyy)
        $dateRegex = '/^\d{2}\.\d{2}\.\d{4}$/';
        if (!preg_match($dateRegex, $date)) {
            echo "Invalid date format. Please use dd.mm.yyyy";
        } else {
            // Validate author field (text only)
            $authorRegex = '/^[a-zA-Z\s]+$/';
            if (!preg_match($authorRegex, $author)) {
                echo "Invalid author name. Please use letters only";
            } else {
                // Insert data into the "lajmet" table using prepared statement
                $sql = "INSERT INTO lajmet (date, author, title, description) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $date, $author, $title, $description);

                if ($stmt->execute()) {
                    echo "Record inserted successfully!";
                    // Redirect to prevent form resubmission on refresh
                    header("Location: {$_SERVER['REQUEST_URI']}");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
            }
        }
    }
}

$sql = "SELECT title FROM lajmet";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<html>
<head>
    <title>Afati1</title>
    <style>
        <style>


.header{
   display: flex;
}

.main-container{
   display: flex;
  

}
 .theslider {
   display: flex;
   align-items: center;
   width: 50%;
   border: 2px solid black;
   margin-left: 5%;
   height: 50%;
}

.slider-container {
   position: relative;
   width: 100%;
   max-width: 400px;
   margin: auto;
   overflow: hidden;
   border: 2px solid black;
}

.slider {
   display: flex;
   transition: transform 0.5s ease-in-out;
}

.slide {
   min-width: 100%;
}

.arrow {
   cursor: pointer;
   background-color: transparent;
   border: none;
   outline: none;
}




.navbar {
border: 2px black solid;
display: flex;
justify-content: center;
align-items: center;
padding: 10px;
margin-bottom: 1%;

}

.nav-list {
list-style: none;
display: flex;
justify-content: center;
margin: 0;
padding: 0;

}

.nav-list li {
margin-right: 20px;

}

.nav-list a {
text-decoration: none;
color: rgb(0, 0, 0);

}

 .header {
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 10px;
  
}

.logo {
   margin-right: 10px;
}


.search-container {
   display: flex;
   align-items: center;
   padding: 5px 20px;
  
  
}
.the-form{
   padding-top: 100px;
   border-radius: 15px;
   border: 2px solid gray;
  height: 70vh;
  width: 32vw;
  margin-left: 8%;
  padding-left: 15px;
  
}
.the-form input{
   margin-bottom: 20px;
   margin-left: 10px;
   margin-right: 10px;
   padding: 6px;

}  
.the-form textarea{
   margin-bottom: 10px;
   margin-left: 10px;
   margin-right: 10px;
}
.datep{
   width: 60px;
}
.authorp{
   width: 200px;
}
.titlep{
   width: 285px;
}
.descriptionp{
   width: 285px;
   height: 150px;
}
.savep{
   margin-left: 40%;
   margin-top: 5%;
   width: 22%;
   height: 6%;
   background-color: white;
   border: 1px gray solid;
  
}

.flex-container {
        display: flex;
        justify-content: space-around; /* Adjust as needed */
        align-items: center; /* Adjust as needed */
        margin-top: 20px; /* Adjust as needed */
    }

.container {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 5px;
        text-align: center;
 }
</style>
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

            // Validate date format (dd.mm.yyyy)
            var dateRegex = /^\d{2}\.\d{2}\.\d{4}$/;
            if (!dateRegex.test(dateInput.value)) {
                alert('Invalid date format. Please use dd.mm.yyyy');
                return false;
            }

            // Validate author field (text only)
            var authorRegex = /^[a-zA-Z\s]+$/;
            if (!authorRegex.test(authorInput.value)) {
                alert('Invalid author name. Please use text only');
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
</head>

<body>


    <div class="header">
        <div class="logo">
            <img src="logo.png" width="60px" height="40px" />
        </div>
    
        <div class="search-container">
            <input type="text" placeholder="Search">
        </div>
    </div>
    <div class="navbar">
        <ul class="nav-list">
            <li><a>Home</a></li>
            <li><a>Video</a></li>
            <li><a>Sport</a></li>
            <li><a>Travel</a></li>
        </ul>
    </div>
    <div class="main-container">
        <div class="theslider">
            <button class="arrow left" onclick="prevSlide()"><img src="left.png" alt="Left" width="50px" height="50px"></button>
            <div class="slider-container">
                <div class="slider">
                    <div class="slide"><img src="first.jpg" alt="Image 1" height="250px" width="400px"></div>
                    <div class="slide"><img src="second.jpg" alt="Image 2" height="250px" width="400px"></div>
                </div>
            </div>
            <button class="arrow right" onclick="nextSlide()"><img src="right.png" alt="Right" width="50px" height="50px"></button>
        </div>
 
    
 

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="the-form">
            <input type="text" placeholder="Date..." class="datep" name="dateInput" id="dateInput">
            <input type="text" placeholder="Author..." class="authorp" name="authorInput" id="authorInput"><br>
            <input type="text" placeholder="Title..." class="Titlep" name="titleInput" id="titleInput"><br>
            <textarea name="descriptionInput" cols="30" rows="5" placeholder="Description..." class="descriptionp" id="descriptionInput"></textarea>
            <button type="submit" class="savep" id="saveButton">Save</button>
        </div>
    </form>
    </div>

    <div class="flex-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container">' . $row['title'] . '</div>';
        }
    } else {
        echo '<div class="container">No records found</div>';
    }
    ?>
</div>




<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        currentIndex = (index + totalSlides) % totalSlides;
        const translateValue = -currentIndex * 100 + '%';
        document.querySelector('.slider').style.transform = 'translateX(' + translateValue + ')';
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }
</script>


</body>
</html>

