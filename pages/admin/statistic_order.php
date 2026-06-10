<?php
require_once("../../controllers/customer/auth_helper.php");
require_once("../../models/clsOrder.php");
include("../../includes/connect.php");

checkStaffAccess();

$orderModel = new Order($conn);
$revenue = $orderModel->getTotalRevenue();
$orderCounts = $orderModel->getCountByStatus();

// dữ liệu
$pending = $orderCounts[0] ?? 0;
$processing = $orderCounts[2] ?? 0;
$success = $orderCounts[3] ?? 0;
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="statistics-container">
    <h1>📊 Báo cáo bán hàng</h1>

    <div class="stat-cards">
        <div class="card revenue">
            <h3>Doanh thu</h3>
            <p><?= number_format($revenue, 0, ',', '.') ?>₫</p>
        </div>

        <div class="card pending">
            <h3>Chờ xác nhận</h3>
            <p><?= $pending ?></p>
        </div>

        <div class="card processing">
            <h3>Đang giao</h3>
            <p><?= $processing ?></p>
        </div>

        <div class="card success">
            <h3>Hoàn thành</h3>
            <p><?= $success ?></p>
        </div>
    </div>

    <div class="chart-box">
        <canvas id="orderChart"></canvas>
    </div>
</div>

<style>
    body {
        background: #f4f6f9;
    }

    .statistics-container {
        padding: 30px;
    }

    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        padding: 25px;
        border-radius: 15px;
        color: white;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .revenue {
        background: linear-gradient(135deg, #28a745, #218838);
    }

    .pending {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #000;
    }

    .processing {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    .success {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
        margin-top: 10px;
    }

    .chart-box {
        margin-top: 40px;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    const ctx = document.getElementById('orderChart').getContext('2d');

    // gradient đẹp hơn
    const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, "#007bff");
    gradient1.addColorStop(1, "#00c6ff");

    const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, "#28a745");
    gradient2.addColorStop(1, "#a8e063");

    const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient3.addColorStop(0, "#ffc107");
    gradient3.addColorStop(1, "#ffdd57");

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Chờ xác nhận', 'Đang giao', 'Hoàn thành'],
            datasets: [{
                label: 'Số lượng đơn hàng',
                data: [<?= $pending ?>, <?= $processing ?>, <?= $success ?>],
                backgroundColor: [gradient3, gradient1, gradient2],
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>