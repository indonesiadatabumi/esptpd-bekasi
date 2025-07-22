</div>
<div class="app-wrapper-footer">
	<div class="app-footer">
		<div class="app-footer__inner">

		</div>
	</div>
</div>
</div>
</div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
	$(document).ready(function() {
		$('.header__pane').hide();
		$(".app-container").toggleClass();
		$('.app-main').addClass('closed-sidebar-mobile closed-sidebar');
	});
	
	const ctx = document.getElementById('myChart');
	let myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'], // Label x-axis (bulan)
			datasets: [{
				label: '2023',
				data: [], // Data penjualan (y-axis)
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 1
			},
			{
				label: '2024',
				data: [], // Data penjualan (y-axis)
				backgroundColor: 'rgba(255, 99, 71, 0.2)',
				borderColor: 'rgba(255, 99, 71, 1)',
				borderWidth: 1
			}]
		},
		options: {
            maintainAspectRatio: false,  // Untuk mematikan rasio default Chart.js
            responsive: true,  // Responsif terhadap ukuran layar
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
	});

	function updateChart() {
        let selectedValue = document.getElementById('jenis_pajak').value;

        fetch(`http://sipdah.bekasikota.go.id/etax/getData.php?dataset=${selectedValue}`)
            .then(response => response.json())
            .then(data => {
                // myChart.data.labels = data.labels;
                myChart.data.datasets[0].data = data.values_last;
                myChart.data.datasets[1].data = data.values_current;
                myChart.update();
				// console.log(data);
            })
			.catch(error => {
        	console.error('Request failed', error);  // Menangani penolakan (rejection)
    });
    }
	// Panggil updateChart() saat halaman dimuat pertama kali
    updateChart();
</script>
</body>

</html>