<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="page-header">
    <div>
        <h1>Appointments</h1>
        <p><?= count($appointments) ?> total appointments</p>
    </div>
    <a href="index.php?controller=appointment&action=create" class="btn btn-teal">+ Schedule Appointment</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date & Time</th>
                <th>Department</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($appointments) > 0): ?>
                <?php foreach ($appointments as $a): ?>
                <tr>
                    <td>
                        <a href="index.php?controller=patient&action=show&id=<?= $a['patient_id'] ?>"
                           style="color:var(--teal2);text-decoration:none;font-weight:600;">
                            <?= htmlspecialchars($a['patient_name']) ?>
                        </a>
                        <br><span style="font-size:0.78rem;color:var(--muted);"><?= htmlspecialchars($a['patient_code']) ?></span>
                    </td>
                    <td><?= htmlspecialchars($a['doctor_name']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($a['appointment_date'])) ?></td>
                    <td><?= htmlspecialchars($a['department']) ?></td>
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
                    <h3>No appointments found</h3>
                </div>
            </td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
