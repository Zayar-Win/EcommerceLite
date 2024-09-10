<template>
    <!-- Chart -->
    <div class="relative">
        <canvas :id="id" height="350px"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
    props: {
        id: {
            type: String,
            required: true,
        },
        datasets: {
            type: Array,
            required: true,
        },
    },
    mounted: function () {
        this.$nextTick(function () {
            var config = {
                type: 'doughnut',
                data: {
                    labels: ['All Cases', 'Resolved Cases', 'Pending Cases'],
                    datasets:this.datasets,
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true, // Hide legend
                            position: 'right',
                            align: 'center',

                            labels: {
                                boxWidth: 12, // Set legend item box width
                                padding: 15, // Set padding between legend items
                            },
                        },
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true,
                    },
                    scales: {
                        xAxes: [
                            {
                                ticks: {
                                    fontColor: 'rgba(255,255,255,.7)',
                                },
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month',
                                    fontColor: 'white',
                                },
                                gridLines: {
                                    display: false,
                                    borderDash: [2],
                                    borderDashOffset: [2],
                                    color: 'rgba(33, 37, 41, 0.3)',
                                    zeroLineColor: 'rgba(0, 0, 0, 0)',
                                    zeroLineBorderDash: [2],
                                    zeroLineBorderDashOffset: [2],
                                },
                            },
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    fontColor: 'rgba(255,255,255,.7)',
                                },
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Value',
                                    fontColor: 'white',
                                },
                                gridLines: {
                                    borderDash: [3],
                                    borderDashOffset: [3],
                                    drawBorder: false,
                                    color: 'rgba(255, 255, 255, 0.15)',
                                    zeroLineColor: 'rgba(33, 37, 41, 0)',
                                    zeroLineBorderDash: [2],
                                    zeroLineBorderDashOffset: [2],
                                },
                            },
                        ],
                    },
                },
            };
            var ctx = document.getElementById(this.id).getContext('2d');
            window.myLine = new Chart(ctx, config);
        });
    },
};
</script>
