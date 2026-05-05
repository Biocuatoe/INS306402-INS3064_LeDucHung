<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1>Schedule Appointment</h1>
        <p>Book a new appointment for a patient.</p>
    </div>
    <a href="index.php?controller=appointment&action=index" class="btn btn-outline">← Back to List</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<div class="form-card">
    <form method="POST" action="index.php?controller=appointment&action=store">
        <div class="form-grid">
            <div class="form-group">
                <label>Patient *</label>
                <select name="patient_id" required>
                    <option value="">— Select Patient —</option>
                    <?php foreach ($patients as $p): ?>
                        <option value="<?= $p['id'] ?>"
                            <?= ((int)($data['patient_id'] ?? $selectedPatientId ?? 0) === (int)$p['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['patient_code'] . ' — ' . $p['full_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Doctor Name *</label>
                <input type="text" name="doctor_name" value="<?= htmlspecialchars($data['doctor_name'] ?? '') ?>" required placeholder="e.g. Dr. Nguyen Van A">
            </div>
            <div class="form-group">
                <label>Appointment Date & Time *</label>
                <input type="datetime-local" name="appointment_date" value="<?= htmlspecialchars($data['appointment_date'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Department *</label>
                <input type="text" name="department" value="<?= htmlspecialchars($data['department'] ?? '') ?>" required placeholder="e.g. Cardiology">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <?php $st = $data['status'] ?? 'Scheduled'; ?>
                    <option value="Scheduled"  <?= $st === 'Scheduled'  ? 'selected' : '' ?>>Scheduled</option>
                    <option value="Completed"  <?= $st === 'Completed'  ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled"  <?= $st === 'Cancelled'  ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Reason / Notes</label>
                <textarea name="reason"><?= htmlspecialchars($data['reason'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-teal">Save Appointment</button>
            <a href="index.php?controller=appointment&action=index" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
