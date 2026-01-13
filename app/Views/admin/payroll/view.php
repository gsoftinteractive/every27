<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Payroll</div>
    <a href="<?= base_url('admin/payroll') ?>" class="nav-link active">Payroll Runs</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('admin/payroll') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Payroll
</a>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payroll Details</h3>
            <span class="badge badge-<?= $payroll['status'] === 'processed' ? 'success' : ($payroll['status'] === 'pending' ? 'warning' : 'danger') ?>">
                <?= ucfirst($payroll['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Reference</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= esc($payroll['reference']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Month</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= esc($payroll['payroll_month']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Employees</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= $payroll['total_employees'] ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Total Gross</label>
                    <p style="margin: 4px 0; font-weight: 500;">&#8358;<?= number_format($payroll['total_gross_salary'] ?? 0, 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Total Net</label>
                    <p style="margin: 4px 0; font-weight: 600; color: var(--primary-color);">&#8358;<?= number_format($payroll['total_net_salary'] ?? 0, 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Created</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= date('M j, Y H:i', strtotime($payroll['created_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company</h3>
        </div>
        <div class="card-body">
            <p style="font-weight: 600; margin-bottom: 4px;"><?= esc($company['company_name']) ?></p>
            <p style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($company['email']) ?></p>
            <a href="<?= base_url('admin/companies/' . $company['id']) ?>" class="btn btn-sm btn-outline" style="margin-top: 12px;">View Company</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payroll Items</h3>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p style="text-align: center; color: var(--gray-500); padding: 40px;">No payroll items found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Gross Salary</th>
                        <th>Deductions</th>
                        <th>Net Salary</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['first_name'] . ' ' . $item['last_name']) ?></td>
                        <td>&#8358;<?= number_format($item['gross_salary'], 2) ?></td>
                        <td>&#8358;<?= number_format($item['total_deductions'] ?? 0, 2) ?></td>
                        <td style="font-weight: 600;">&#8358;<?= number_format($item['net_salary'], 2) ?></td>
                        <td><span class="badge badge-<?= $item['status'] === 'paid' ? 'success' : 'warning' ?>"><?= ucfirst($item['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
