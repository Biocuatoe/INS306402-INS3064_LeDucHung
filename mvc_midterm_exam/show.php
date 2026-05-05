<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1><?= htmlspecialchars($patient['full_name']) ?></h1>
        <p class="td-code" style="font-family:monospace;font-size:1rem;color:#1a7d6e;"><?= htmlspecialchars($patient['patient_code']) ?></p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="index.php?controller=appointment&action=create&patient_id=<?= $patient['id'] ?>" class="btn btn-teal">+ Book Appointment</a>
        <a href="index.php?controller=patient&action=index" class="btn btn-outline">← Back</a>
    </div>
</div>

<!-- Patient Info Card -->
<div class="form-card" style="margin-bottom:28px;">
    <div class="form-grid">
        <div><label>Date of Birth</label><p style="margin-top:4px;"><?= $patient['date_of_birth'] ? date('d/m/Y', strtotime($patient['date_of_birth'])) : '—' ?></p></div>
        <div><label>Gender</label><p style="margin-top:4px;"><?php $g = strtolower($patient['gender']); ?><span class="badge badge-<?= $g ?>"><?= htmlspecialchars($patient['gender']) ?></span></p></div>
        <div><label>Phone</label><p style="margin-top:4px;"><?= htmlspecialchars($patient['phone'] ?: '—') ?></p></div>
        <div><label>Address</label><p style="margin-top:4px;"><?= htmlspecialchars($patient['address'] ?: '—') ?></p></div>
    </div>
</div>

<!-- Appointments Table -->
<h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-bottom:16px;">Appointment History</h2>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Doctor</th>
                <th>Department</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($appointments) > 0): ?>
                <?php foreach ($appointments as $a): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($a['appointment_date'])) ?></td>
                    <td><?= htmlspecialchars($a['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($a['department']) ?></td>
                    <td><?= htmlspecialchars($a['reason'] ?: '—') ?></td>
                    <td>
                        <?php $s = strtolower($a['status']); ?>
                        <span class="badge badge-<?= $s ?>"><?= htmlspecialchars($a['status']) ?></span>
                    </td>
                    <td class="td-actions">
                        <a href="index.php?controller=appointment&action=edit&id=<?= $a['id'] ?>" class="btn btn-sm btn-ink">Edit</a>
                        <a href="index.php?controller=appointment&action=delete&id=<?= $a['id'] ?>" class="btn btn-sm btn-red"
                           onclick="return confirm('Delete this appointment?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <tr><td colspan="6">
                <div class="empty-state">
                    <h3>No appointments yet</h3>
                    <p>Book the first appointment for this patient.</p>
                </div>
            </td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
