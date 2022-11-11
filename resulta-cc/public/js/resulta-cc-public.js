(function( $ ) {
	'use strict';

	/**
	 * All of the code responsible for public-facing JavaScript source
	 * will be reside in this file.
	 * we can export funtionality
	 */
	 $(function() {
		/**
		 * The data table controle we are using to display team info in tablular form
		 */
		$('#nfl_team_info_table').DataTable({
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, 'All'],
			],
		});

		/**
		 * Chart Color Data randomly selected for graphs
		 * 
		 */
		 function getRandomColor() {
			var colorArray = [
				"#FF6633","#FFB399","#d4915c","#e6c492","#543624","#f5dfd0","#aaaaaa","#FFFF99","#00B3E6","#E6B333","#3366E6","#99C966","#809980","#98df8a","#E6FF80","#1AFF33","#999933","#FF3380","#ffbb78","#CCCC00","#66E64D","#4D80CC","#FF4D4D","#99E6E6","#6666FF","#1f77b4","#ff7f0e",

			];
			return colorArray[Math.floor(Math.random() * colorArray.length)];
		}


		/**
		 * First letter uppercase
		 * @return string  word with first letter uppercase
		 */
		 function capitalize(str){
			return str.charAt(0).toUpperCase()+str.slice(1);
		  }
		/**
		 * get User preferences for Chart rendering
		 *  */
		function get_chart_settings(){
			var nflData = $('#chart_values-data');
			var columnData = $('#chart_columns-data');
			var selectedField = $('#chart_field').val();
			var selectedType = $('#chart_type').val();
			if (!nflData.length)
				return;
			// attempt to parse the content of our data block
			try {
				nflData = JSON.parse(nflData.text());
			} catch (err) { // invalid json
				return;
			}
			var selected_field_record = [];
			$.each(nflData, function(index, value) {
				if (!selected_field_record[value[selectedField]]){
					selected_field_record[value[selectedField]] = [];
					selected_field_record[value[selectedField]][0] = value;
				}else{
					var array_length = selected_field_record[value[selectedField]].length;
					selected_field_record[value[selectedField]][array_length] = value;
				}
				
			});
			
			// check type of chart needs to draw
			if(selectedType == 'pie'){ 
				var pie_chart_values = getPieChartData(selected_field_record);
				if (pie_chart_values.length>0){
					renderPieChart(pie_chart_values);
				}
			}
			if(selectedType== 'bar'){
				var columnChartValues = getlineChartData(selected_field_record);
				if (columnChartValues.length>0){
					renderColumnChart(columnChartValues);
				}
			}
		}
		/**
		 * add click events to dropdowns on frontend for chart rendering
		 */
		$("#chart_field").on("change", get_chart_settings);
		$("#chart_type").on("change", get_chart_settings);
		get_chart_settings();
		/**
		 * getPieChartData
		 * @returns Data for column chart with conference Segregation
		 */
		function getPieChartData(data){
			var pieChartData = Object.entries(data); 
			if (!pieChartData.length)
				return;

			/**
			 * Prepare data for chart rendering
			 */
			var count_i =0;
			const pie_values = [];
			$.each(pieChartData, function(index, value) {
				pie_values[count_i] = {
					y: value[1].length,
					indexLabel: value[0].replace(/_/g, ' '),
					color: getRandomColor()
				};
				count_i++;
				
			});
			
			return pie_values;
		}
		
		/**
		 * 
		 * Render Pie Chart
		 */
		function renderPieChart(values) {
		  
			var chart = new CanvasJS.Chart("drawChart", {
			  backgroundColor: "white",
			  colorSet: "colorSet2",
		  
			  title: {
				text: capitalize($('#chart_field').val().replace(/_/g, ' '))+" Segregation Chart",
				fontFamily: "Verdana",
				fontSize: 25,
				fontWeight: "normal",
			  },
			  animationEnabled: true,
			  data: [{
				indexLabelFontSize: 15,
				indexLabelFontFamily: "Monospace",
				indexLabelFontColor: "darkgrey",
				indexLabelLineColor: "darkgrey",
				indexLabelPlacement: "outside",
				type: "pie",
				showInLegend: false,
				toolTipContent: "<strong>#percent%</strong>",
				dataPoints: values
			  }]
			});
			chart.render();
		}
		/**
		 * 
		 * Line Chart Drawing
		 */
		/**
		 * getlineChartData
		 * @returns Data for column chart with Division Segregation
		 */
		 function getlineChartData(data){
			// if our data block is not available, don't do anything
			var lineChartData = Object.entries(data);
			if (!lineChartData.length)
				return;

			/**
			 * Prepare data for chart rendering
			 */
			var count_j =0;
			const columnChartValues = [];
			$.each(lineChartData, function(index, value) {
				columnChartValues[count_j] = {
					y: value[1].length,
					label: value[0].replace(/_/g, ' '),
					color: getRandomColor()
				};
				count_j++;
				
			});
			return columnChartValues;
		 }
		
		/**
		 * 
		 * Render column Chart
		 */
		function renderColumnChart(values) {
		
			var chart = new CanvasJS.Chart("drawChart", {
			backgroundColor: "white",
			colorSet: "colorSet3",
			title: {
				text: capitalize($('#chart_field').val().replace(/_/g, ' '))+" Segregation Chart",
				fontFamily: "Verdana",
				fontSize: 25,
				fontWeight: "normal",
			},
			animationEnabled: true,
			legend: {
				verticalAlign: "bottom",
				horizontalAlign: "center"
			},
			theme: "theme2",
			data: [
		
				{
				indexLabelFontSize: 15,
				indexLabelFontFamily: "Monospace",
				indexLabelFontColor: "darkgrey",
				indexLabelLineColor: "darkgrey",
				indexLabelPlacement: "outside",
				type: "column",
				showInLegend: false,
				legendMarkerColor: "grey",
				dataPoints: values
				}
			]
			});
		
			chart.render();
		}
		
	 });
	 
})( jQuery );
