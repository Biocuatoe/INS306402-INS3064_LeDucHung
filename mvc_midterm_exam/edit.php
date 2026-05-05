<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1>Edit Patient</h1>
        <p>Editing: <strong><?= htmlspecialchars($record['full_name']) ?></strong></p>
    </div>
    <a href="index.php?controller=patient&action=index" class="btn btn-outline">← Back to List</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<div class="form-card">
    <form method="POST" action="index.php?controller=patient&action=update">
        <input type="hidden" name="id" value="<?= (int)$record['id'] ?>">
        <div class="form-grid">
            <div class="form-group">
                <label>Patient Code *</label>
                <input type="text" name="patient_code" value="<?= htmlspecialchars($data['patient_code'] ?? $record['patient_code']) ?>" required>
            </div>
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($data['full_name'] ?? $record['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" value="<?= htmlspecialchars($data['date_of_birth'] ?? $record['date_of_birth'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                    <?php $g = $data['gender'] ?? $record['gender'] ?? 'Other'; ?>
                    <option value="Male"   <?= $g === 'Male'   ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $g === 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other"  <?= $g === 'Other'  ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($data['phone'] ?? $record['phone']) ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($data['address'] ?? $record['address']) ?>">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-teal">Update Patient</button>
            <a href="index.php?controller=patient&action=index" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
