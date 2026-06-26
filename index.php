<?php
require 'config/database.php';

$keyword = $_GET['keyword'] ?? '';

// Sửa 'students' thành 'student' để khớp với database của bạn
if ($keyword !== '') {
    $sql = "SELECT * FROM student
            WHERE name LIKE :keyword
               OR email LIKE :keyword
               OR major LIKE :keyword
            ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
} else {
    $sql = "SELECT * FROM student ORDER BY id DESC";
    $stmt = $pdo->query($sql);
}

$students = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="page-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">Student Management</h1>
            <p class="text-muted mb-0">
                Manage student information with PHP, PDO and MySQL.
            </p>
        </div>

        <a href="create.php" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-10">
            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Search by name, email or major"
                value="<?= htmlspecialchars($keyword) ?>"
            >
        </div>

        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary" type="submit">
                Search
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Major</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($students) > 0): ?>

                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student['id'] ?></td>
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['phone']) ?></td>
                            <td><?= htmlspecialchars($student['major']) ?></td>

                            <td class="text-end">
                                <a
                                    class="btn btn-sm btn-info text-white btn-action"
                                    href="show.php?id=<?= $student['id'] ?>">
                                    View
                                </a>

                                <a
                                    class="btn btn-sm btn-warning btn-action"
                                    href="edit.php?id=<?= $student['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    action="delete.php"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this student?')">

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $student['id'] ?>">

                                    <button
                                        class="btn btn-sm btn-danger btn-action"
                                        type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No students found.
                        </td>
                    </tr>

                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'includes/footer.php'; ?>