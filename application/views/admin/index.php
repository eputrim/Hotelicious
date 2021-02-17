<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>
    <h5 class="text-center"><b>WEBSITE STATISTIC</b></h5>
    <hr />

    <script src="<?= base_url(); ?>/assets/vendor/chartjs/Chart.js"></script>

    <canvas id="myChart"></canvas>
    <?php
    //Inisialisasi nilai variabel awal
    $nama_bulan = "";
    $jumlah = null;
    foreach ($hasil as $item) {
        $mon = date('M', $item->month);;
        $jum = $item->total;
    }
    ?>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: ["<?= $mon; ?>"],
                datasets: [{
                    label: 'Jumlah User',
                    backgroundColor: ['rgb(115, 165, 229)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                    borderColor: ['rgb(255, 99, 132)'],
                    data: [<?php echo $jum; ?>]
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->