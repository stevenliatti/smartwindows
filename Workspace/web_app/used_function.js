// fonction de construction des charts
// @param
// 		ctx : le canvas qui va contenir le graphe
//		label_array : les labels des données (dans notre cas c'est la date et l'heure)
// 		data_label1 : le libéllé des donneés du premier contexte
// 		data_array1 : les données du premier contexte
// 		color_string1 : la couleur du premier courbe
// 		data_label2 : le libéllé des donneés du 2ème contexte
// 		data_array2 : les données du 2ème contexte
// 		color_string2 : la couleur du 2ème courbe
function display_day(ctx, label_array, data_label1, data_array1, color_string1, data_label2 = null, data_array2 = null, color_string2 = null) {
	var data_set = [
		            {
		            	label: data_label1,
		                fill: false,
		                lineTension: 0,
		                backgroundColor: "rgba("+color_string1+",0.4)",
		                borderColor: "rgba("+color_string1+",1)",
		                borderCapStyle: 'butt',
		                borderDash: [],
		                borderWidth: 2,
		                borderDashOffset: 0.0,
		                borderJoinStyle: 'miter',
		                pointBorderColor: "rgba("+color_string1+",1)",
		                pointBackgroundColor: "#fff",
		                pointBorderWidth: 5,
		                pointHoverRadius: 5,
		                pointHoverBackgroundColor: "rgba("+color_string1+",1)",
		                pointHoverBorderColor: "black",
		                pointHoverBorderWidth: 2,
		                pointRadius: 1,
		                pointHitRadius: 10,
		                data: data_array1,
		                spanGaps: false,
		            }
		        ];
    if (data_array2 != null){
    	data_set.push(
    					{
			    			label: data_label2,
			                fill: false,
			                lineTension: 0,
			                backgroundColor: "rgba("+color_string2+",0.4)",
			                borderColor: "rgba("+color_string2+",1)",
			                borderCapStyle: 'butt',
			                borderDash: [],
			                borderWidth: 2,
			                borderDashOffset: 0.0,
			                borderJoinStyle: 'miter',
			                pointBorderColor: "rgba("+color_string2+",1)",
			                pointBackgroundColor: "#fff",
			                pointBorderWidth: 5,
			                pointHoverRadius: 5,
			                pointHoverBackgroundColor: "rgba("+color_string2+",1)",
			                pointHoverBorderColor: "black",
			                pointHoverBorderWidth: 2,
			                pointRadius: 1,
			                pointHitRadius: 10,
			                data: data_array2,
			                spanGaps: false,
						}
					);
    	}
	var data = {
		        labels: label_array,
		        datasets: data_set
		    };
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive:false,
            }
        });
}


// fonction pour ajouter les champs de date et de temps si l'utilisateur
// sélectionne l'option "tranche horaire"
function change_content(value) {
	selected_chart = document.getElementById("selected_chart");
	date_element = document.getElementById("selected_date");
	min_max_date_element = document.getElementById("selected_min_max_date");
	switch(value){
		case "day_time":
			date_element.style.display='none';
			min_max_date_element.style.display='';
			break;
		default :
			date_element.style.display='';
			min_max_date_element.style.display='none';
	}
}