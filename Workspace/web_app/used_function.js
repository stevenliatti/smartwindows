// fonction de construction des données par jour
function array_data_day(label_array, data_array) {
	var data2 = {
            labels: label_array,
            datasets: [
                {
                	label: "Luminosité",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderWidth: 2,
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "black",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: data_array,
                    spanGaps: false,
                }
            ]
        };
        var ctx2 = document.getElementById("myChart2");
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: data2,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive:false
            }
        });
}