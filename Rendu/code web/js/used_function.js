// fonction de construction des charts
// @param
// 		ctx : le canvas qui va contenir le graphe
//		title : le titre du graphe
//		label_array : les labels des données (dans notre cas c'est la date et l'heure)
// 		data_label1 : le libéllé des donneés du premier contexte
// 		data_array1 : les données du premier contexte
// 		color_string1 : la couleur du premier courbe
// 		data_label2 : le libéllé des donneés du 2ème contexte
// 		data_array2 : les données du 2ème contexte
// 		color_string2 : la couleur du 2ème courbe
function display_day(ctx, title, label_array, data_label1, data_array1, color_string1, data_label2 = null, data_array2 = null, color_string2 = null) {
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
            responsive:true,
            title: {
	            display: true,
	            text: title,
	            fullWidth : true,
	            fontSize : 30
	        },
        }
    });
}


// fonction de construction des charts
// @param
// 		ctx : le canvas qui va contenir le graphe
function display_month(ctx, title, labels, array_moy, array_min, array_max, y_scale_min, y_scale_max) {
	var data = {
    labels: labels,
    datasets: [
	        {
	            label: "Moyenne",
	            backgroundColor: 'rgba(0, 102, 255, 0.2)',
	            borderColor: 'rgba(0,102, 255,1)',
	            borderWidth: 1,
	            data: array_moy,
	        },
	        {
	            label: "Min",
	            backgroundColor: 'rgba(255, 0, 0, 0.2)',
	            borderColor: 'rgba(255,0,0,1)',
	            borderWidth: 1,
	            data: array_min,
	        },
	        {
	            label: "Max",
	            backgroundColor: 'rgba(0, 155, 0, 0.2)',
	            borderColor: 'rgba(0,155,0,1)',
	            borderWidth: 1,
	            data: array_max,
	        }
    	]
	};
	var myBarChart = new Chart(ctx, {
    	type: 'bar',
    	data: data,
    	options: {
    		hover : {
    			mode : "label"
    		},
            title: {
	            display: true,
	            text: title,
	            fullWidth : true,
	            fontSize : 30
	        },
	        scales: {
	            yAxes: [{
	                ticks: {
	                    min : y_scale_min,
	                    max : y_scale_max
	                }
	            }]
	        },
            responsive:true,
    	}
	});
}


// fonction pour ajouter les champs de date et de temps si l'utilisateur
// sélectionne l'option "tranche horaire"
function change_content(value) {
	selected_chart = document.getElementById("selected_chart");
	date_element = document.getElementById("selected_date");
	min_max_date_element = document.getElementById("selected_min_max_date");
	month_element = document.getElementById("selected_month");
	switch(value){
		case "day_time":
			date_element.style.display='none';
			min_max_date_element.style.display='';
			month_element.style.display = 'none';
			break;
		case "month":
			date_element.style.display='none';
			min_max_date_element.style.display='none';
			month_element.style.display = '';
			break;
		default :
			date_element.style.display='';
			min_max_date_element.style.display='none';
			month_element.style.display = 'none';
	}
}