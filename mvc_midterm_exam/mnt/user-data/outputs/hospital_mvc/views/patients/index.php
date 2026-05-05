<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1>Patients</h1>
        <p><?= count($patients) ?> registered patients</p>
    </div>
    <a href="index.php?controller=patient&action=create" class="btn btn-teal">+ Add Patient</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($patients) > 0): ?>
                <?php foreach ($patients as $p): ?>
                <tr>
                    <td class="td-code"><?= htmlspecialchars($p['patient_code']) ?></td>
                    <td><strong><?= htmlspecialchars($p['full_name']) ?></strong></td>
                    <td><?= $p['date_of_birth'] ? date('d/m/Y', strtotime($p['date_of_birth'])) : '—' ?></td>
                    <td>
                        <?php $g = strtolower($p['gender']); ?>
                        <span class="badge badge-<?= $g ?>"><?= htmlspecialchars($p['gender']) ?></span>
                    </td>
                    <td><?= htmlspecialchars($p['phone']) ?></td>
                    <td class="td-actions">
                        <a href="index.php?controller=patient&action=show&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline">View</a>
                        <a href="index.php?controller=patient&action=edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-ink">Edit</a>
                        <a href="index.php?controller=patient&action=delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-red"
                           onclick="return confirm('Delete this patient and all their appointments?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <tr><td colspan="6">
                <div class="empty-state">
                    <h3>No patients found</h3>
                    <p>Add your first patient to get started.</p>
                </div>
            </td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
