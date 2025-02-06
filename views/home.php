<?php
include '../database/database.php';
include '../helpers/authenticated.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Todo App </title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <script src="../statics/js/bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold">Todo App</p>
      </div>
      <div class="row">
        <a href="add_todo.php" class="btn btn-outline-dark btn-sm">Add Todo&nbsp;<i class="fa-solid fa-plus"></i></a>
      </div>
      <?php
      $res = $conn->query("SELECT * FROM todo");
      ?>
      <?php if ($res->num_rows > 0): ?>
        <?php while ($row = $res->fetch_assoc()): ?>
          <div class="row border rounded p-3 my-3">
            <div>
              <div class="row">
                <div class="col">
                  <h5 class="fw-bold"><?= $row['title']; ?></h5>
                </div>
                <div class="col " style="text-align: right!important;">
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <a href="update_todo.php?id=<?= $row['id']; ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                      </li>
                      <li>
                        <a href="../handlers/delete_todo_handler.php?id=<?= $row['id']; ?>" class="btn"><i class="fa-solid fa-trash"></i>&nbsp;Delete</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <p class="text-secondary"><?= $row['description']; ?></p>
              <p class="fw-bold">
                <span <?= $row['status'] == 0 ? "class='badge rounded-pill bg-warning'" : "class='badge rounded-pill bg-success'"; ?>>
                  <?= $row['status'] == 0 ? "Ongoing" : "Done"; ?>
                </span>
              </p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="row border rounded p-3 my-3 text-center">
          <div class="col mt-3">
            <p class="text-muted">🎉 No current tasks! Time to relax or add new tasks.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <a href="../handlers/logout_handler.php" class="btn btn-danger btn-sm position-fixed bottom-0 start-0 mb-3 ms-3"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>

</body>

</html>
