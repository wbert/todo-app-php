<?php
include '../database/database.php';
include '../helpers/authenticated.php';

try {


  $id = $_GET['id'];

  $stmt = $conn->prepare("SELECT * FROM todo WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $todo = $result->fetch_assoc();
  } else {
    die("Todo not found");
  }
  $stmt->close();
} catch (\Exception $e) {
  echo "Error: " . $e;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Update Todo </title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold">Edit Todo</p>
      </div>
      <div class="row">
        <form class="form" action="../handlers/update_todo_handler.php" method="POST" required>
          <input name="id" value="<?= $todo['id'] ?>" hidden />
          <div class="my-3">
            <label>Title</label>
            <input class="form-control" type="text" name="title" value="<?= $todo['title'] ?>" />
          </div>
          <div class="my-3">
            <label>Description</label>
            <textarea class="form-control" type="text" name="description" required><?= $todo['description'] ?></textarea>
          </div>
          <div class="my-3">
            <label>Status</label>
            <select class="form-control" id="status" name="status" required>
              <option value="0" <?= $todo['status'] == 0 ? 'selected' : '' ?>>Ongoing</option>
              <option value="1" <?= $todo['status'] == 1 ? 'selected' : '' ?>>Done</option>
            </select>
          </div>

          <div class="my-3">
            <button type="submit" class="btn btn-outline-dark">Save Todo&nbsp;<i class="fa-solid fa-floppy-disk"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
