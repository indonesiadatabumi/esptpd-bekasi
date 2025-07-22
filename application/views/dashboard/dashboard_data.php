<!-- Main content -->

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rekap Penerimaan Tiap Bulan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table id="tbl_kategori" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>Bulan</th>
                                    <th>PBJT Hotel</th>
                                    <th>PBJT Restoran</th>
                                    <th>PBJT Hiburan</th>
                                    <th>Pajak Reklame</th>
                                    <th>Pajak PJ</th>
                                    <th>PBJT Parkir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rekap_perbulan as $row) :
                                ?>
                                    <tr>
                                        <td><?= $row->month; ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_hotel, 0); ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_restoran, 0); ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_hiburan, 0); ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_reklame, 0); ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_pj, 0); ?></td>
                                        <td align="right">Rp. <?= number_format($row->pbjt_parkir, 0); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr align="right">
                                    <th>Total</th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_hotel, 0); ?></th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_restoran, 0); ?></th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_hiburan, 0); ?></th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_reklame, 0); ?></th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_pj, 0); ?></th>
                                    <th align="right">Rp. <?= number_format($rekap_total->pbjt_parkir, 0); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="text-center">Grafik Perbandingan Atas Penerimaan Pajak</h5>
                    <label for="jenis_pajak">Jenis Pajak </label>
                    <select class="form-select" name="jenis_pajak" id="jenis_pajak">Jenis Pajak
                        <option value="0" selected>Semua</option>
                        <option value="1">PBJT Hotel</option>
                        <option value="2">PBJT Restoran</option>
                        <option value="3">PBJT Hiburan</option>
                        <option value="4">PBJT Reklame</option>
                        <option value="6">PBJT PJ</option>
                        <option value="7">PBJT Parkir</option>
                    </select>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let ctx = document.getElementById('myChart').getContext('2d');

    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // nama bulan
            datasets: [
                {
                    label: '2025',
                    data: [],
                    // backgroundColor: 'rgba(75, 192, 192, 0.6)'
                },
                {
                    label: '2024',
                    data: [],
                    // backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fungsi ambil data pakai jQuery AJAX
    function loadChartData(jenisPajak) {
        $.ajax({
            url: '/dashboard/get_penerimaan_data', // ganti dengan URL endpoint kamu
            type: 'Post',
            data: { jenis_pajak: jenisPajak },
            dataType: 'json',
            success: function (data) {
                const result = data.penerimaan_pajak;

                // Siapkan array untuk label dan 2 dataset
                let labels = [];
                let data2025 = [];
                let data2024 = [];

                result.forEach(item => {
                    labels.push(item.bulan);
                    data2025.push(parseInt(item.penerimaan_2025));
                    data2024.push(parseInt(item.penerimaan_2024));
                });

                // Update chart
                myChart.data.labels = labels;
                myChart.data.datasets[0].data = data2025;
                myChart.data.datasets[1].data = data2024;
                myChart.update();
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    // Saat pertama kali load
    $(document).ready(function () {
        loadChartData($('#jenis_pajak').val());

        $('#jenis_pajak').on('change', function () {
            let selectedValue = $(this).val();
            loadChartData(selectedValue);
        });
    });
</script>
       