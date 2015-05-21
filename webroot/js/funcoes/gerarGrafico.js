function gerarGrafico(id, a, b, c, tipo)
{	
	if(tipo == undefined) {
		tipo = 'PieChart';
	}

	a = parseInt(a);
	b = parseInt(b);
	c = parseInt(c);
	var data = google.visualization.arrayToDataTable([
		['Task', 'Gráfico de respostas'],
		['Sim ('+a+')', a],
		['Não ('+b+')', b],
		['Não aplivável ('+c+')', c]
	]);

    var options = {
      title: '',
      is3D: true,
    };

	var chart = '';
	if(tipo == 'ColumnChart') {
    	chart = new google.visualization.ColumnChart(document.getElementById(id));
	}
	else if(tipo == 'LineChart') {
		chart = new google.visualization.LineChart(document.getElementById(id));
	}
	else if(tipo == 'PieChart') {
		chart = new google.visualization.PieChart(document.getElementById(id));
	}

    chart.draw(data, options);
}