<style>
h1 {
    text-align: center;
}
table {
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, sans-serif;
    font-size: 14px;
    margin: 4rem auto;
}

th, td {
    text-align: center;
    padding: 7px;
    font-family: "Helvetica Neue",Helvetica,Arial;
    background-color: #F8F8F8;
    color: #000;
    font-weight: bold;
    border: 1px solid #DDD;
}
th {
    color: gray;
    font-size: 24px;
}
tr {
    border: 2px solid black;
}
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    line-height: 2rem;
    max-width: 500px;
    margin: 4rem auto;
    padding: 20px;
    border: 3px solid gray;
    border-radius: 5px;
    background-color: #F8F8F8; 
}
.container h1 {
    font-family: "Helvetica Neue",Helvetica,Arial;
}
h3 {
    text-align: center;
    color:#4CAF50;
    font-family: "Helvetica Neue",Helvetica,Arial;
}
label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  font-family: "Helvetica Neue",Helvetica,Arial;
  text-align: center;
}
input[type=text] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  display: block;
  margin: 0 auto;
}
</style>


<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<div class="container">
    <h1>BOOK LIBRARY</h1>
        <form method="post" action="library.php">
            <label for="book_title">Book Title</label>
            <input type="text" id="book_title" name="book_title" required><br>

            <label for="author">Author</label>
            <input type="text" id="author" name="author" required><br>

            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <br>
            <br>
            <input type="submit" value="Save">
        </form>
    </div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST["book_title"];
    $author = $_POST["author"];
    $customer_name = $_POST["customer_name"];

    $sql = "INSERT INTO books (book_title, author, customer_name) VALUES ('$book_title', '$author', '$customer_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>Book saved successfully!</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<?php
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Customer Name</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["book_title"] . "</td>
                <td>" . $row["author"] . "</td>
                <td>" . $row["customer_name"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No books found.";
}
?>



