<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1>Edit Appointment</h1>
        <p>Updating appointment for <strong><?= htmlspecialchars($record['patient_name'] ?? '') ?></strong></p>
    </div>
    <a href="index.php?controller=appointment&action=index" class="btn btn-outline">← Back to List</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<div class="form-card">
    <form method="POST" action="index.php?controller=appointment&action=update">
        <input type="hidden" name="id" value="<?= (int)$record['id'] ?>">
        <div class="form-grid">
            <div class="form-group">
                <label>Patient *</label>
                <select name="patient_id" required>
                    <option value="">— Select Patient —</option>
                    <?php foreach ($patients as $p): ?>
                        <option value="<?= $p['id'] ?>"
                            <?= ((int)($data['patient_id'] ?? $record['patient_id']) === (int)$p['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['patient_code'] . ' — ' . $p['full_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Doctor Name *</label>
                <input type="text" name="doctor_name" value="<?= htmlspecialchars($data['doctor_name'] ?? $record['doctor_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Appointment Date & Time *</label>
                <?php
                    $dtVal = $data['appointment_date'] ?? $record['appointment_date'] ?? '';
                    // Convert MySQL datetime to datetime-local format
                    $dtVal = str_replace(' ', 'T', substr($dtVal, 0, 16));
                ?>
                <input type="datetime-local" name="appointment_date" value="<?= htmlspecialchars($dtVal) ?>" required>
            </div>
            <div class="form-group">
                <label>Department *</label>
                <input type="text" name="department" value="<?= htmlspecialchars($data['department'] ?? $record['department']) ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <?php $st = $data['status'] ?? $record['status'] ?? 'Scheduled'; ?>
                    <option value="Scheduled"  <?= $st === 'Scheduled'  ? 'selected' : '' ?>>Scheduled</option>
                    <option value="Completed"  <?= $st === 'Completed'  ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled"  <?= $st === 'Cancelled'  ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Reason / Notes</label>
                <textarea name="reason"><?= htmlspecialchars($data['reason'] ?? $record['reason'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-teal">Update Appointment</button>
            <a href="index.php?controller=appointment&action=index" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
