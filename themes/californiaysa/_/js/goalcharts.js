$(function () {
    var service_chart;
    var temple_chart;
    var missionary_chart;
    var reach_rescue_chart;
    $(document).ready(function() {
		$('.module-nav a').hover(function(){
			var thisOverlay = $(this).closest('.module-nav').siblings('.module-content').find('.module-content-overlay');
			thisOverlay.addClass('active '+$(this).attr('class')).css('line-height',thisOverlay.height()+'px');
		}, function(){
			$(this).closest('.module-nav').siblings('.module-content').find('.module-content-overlay').removeClass('active '+$(this).attr('class'));
		}).click(function(e){
			e.preventDefault();
			$(this).closest('.module-nav').siblings('.module-content').find('.module-content-overlay').removeClass('active '+$(this).attr('class'));
			$(this).closest('.module-nav').siblings('.module-content').find('li.'+$(this).attr('href')).addClass('active').siblings().removeClass('active');
		});
		var temple_indexing = [];
		var temple_ordinances = [];
		var missionary_invitations = [];
		var missionary_profiles = [];
		var reach_rescue_visits = [];
		if($('.module-goals').length > 0) {
			$('.chart-temple .names-indexed input').each(function(){
				temple_indexing.push(parseInt($(this).val()));
			});
			$('.chart-temple .ordinances input').each(function(){
				temple_ordinances.push(parseInt($(this).val()));
			});
			$('.chart-missionary .profiles input').each(function(){
				missionary_profiles.push(parseInt($(this).val()));
			});
			$('.chart-missionary .invitations input').each(function(){
				missionary_invitations.push(parseInt($(this).val()));
			});
			$('.chart-reach-rescue .visits input').each(function(){
				reach_rescue_visits.push(parseInt($(this).val()));
			});
			Highcharts.setOptions({
				chart: {
					style: {
						fontFamily:'Helvetica,Arial,sans-serif'
					}
				}
			});
			temple_chart = new Highcharts.Chart({
				chart: {
					renderTo: 'chart-temple',
					type: 'area',
					borderRadius:0,
					backgroundColor:null
				},
				colors: [
					'#ca006c',
					'#00a160'
				],
				title: {
					text:null,
					style:{
						color:'#ca006c',
						fontSize:'12px'
					}
				},
				legend: {
					/*enabled: false*/
					itemStyle: {
						fontSize: '11px'
					},
					borderColor:'#ddd',
					verticalAlign:'top',
					symbolWidth:12
				},
				xAxis: {
					categories: ['Apr 22', 'Apr 29', 'May 6', 'May 13', 'May 20', 'May 27', 'Jun 3', 'Jun 10', 'Jun 17', 'Jun 24', 'Jul 1', 'Jul 8', 'Jul 15', 'Jul 22', 'Jul 29', 'Aug 5', 'Aug 12', 'Aug 19'],
					labels: {
						style: {
							fontSize:'8px'
						},
						step: 3 
					},
					startOnTick: true,
					tickLength: 3,
					tickmarkPlacement:'on'
				},
				yAxis: {
					title: {
						text: null
					},
					labels: {
						formatter: function() {
							return this.value / 1000 +'k';
						},
						style: {
							fontSize:'10px'
						}
					},
					gridLineColor: '#eee',
					max:500000
				},
				plotOptions: {
					area: {
						marker: {
							enabled: true,
							symbol: 'circle',
							radius: 3,
							states: {
								hover: {
									enabled: true
								}
							}
						},
						fillOpacity:0.2
					}
				},
				series: [{
					name:'Indexed Names',
					data: temple_indexing
				}, {
					name: 'Temple Ordinances',
					data: temple_ordinances
				}]
			});
			missionary_chart = new Highcharts.Chart({
				chart: {
					renderTo: 'chart-missionary',
					type: 'area',
					borderRadius:0,
					backgroundColor:null
				},
				colors: [
					'#ca006c',
					'#00a160'
				],
				title: {
					text:null,
					style:{
						color:'#ca006c',
						fontSize:'12px'
					}
				},
				legend: {
					/*enabled: false*/
					itemStyle: {
						fontSize: '11px'
					},
					borderColor:'#ddd',
					verticalAlign:'top',
					symbolWidth:12
				},
				xAxis: {
					categories: ['Apr 22', 'Apr 29', 'May 6', 'May 13', 'May 20', 'May 27', 'Jun 3', 'Jun 10', 'Jun 17', 'Jun 24', 'Jul 1', 'Jul 8', 'Jul 15', 'Jul 22', 'Jul 29', 'Aug 5', 'Aug 12', 'Aug 19'],
					labels: {
						style: {
							fontSize:'8px'
						},
						step: 3 
					},
					startOnTick: true,
					tickLength: 3,
					tickmarkPlacement:'on'
				},
				yAxis: {
					title: {
						text: null
					},
					labels: {
						formatter: function() {
							return this.value / 1000 +'k';
						},
						style: {
							fontSize:'10px'
						}
					},
					gridLineColor: '#eee',
					max:20000
				},
				plotOptions: {
					area: {
						marker: {
							enabled: true,
							symbol: 'circle',
							radius: 3,
							states: {
								hover: {
									enabled: true
								}
							}
						},
						fillOpacity:0.2
					}
				},
				series: [{
					name:'Invitations',
					data: missionary_invitations
				}, {
					name: 'Mormon.org Profiles',
					data: missionary_profiles
				}]
			});
			reach_rescue_chart = new Highcharts.Chart({
				chart: {
					renderTo: 'chart-reach-rescue',
					type: 'area',
					borderRadius:0,
					backgroundColor:null
				},
				colors: [
					'#ca006c',
					'#00a160'
				],
				title: {
					text:null,
					style:{
						color:'#ca006c',
						fontSize:'12px'
					}
				},
				legend: {
					/*enabled: false*/
					itemStyle: {
						fontSize: '11px'
					},
					borderColor:'#ddd',
					verticalAlign:'top',
					symbolWidth:12
				},
				xAxis: {
					categories: ['Apr 22', 'Apr 29', 'May 6', 'May 13', 'May 20', 'May 27', 'Jun 3', 'Jun 10', 'Jun 17', 'Jun 24', 'Jul 1', 'Jul 8', 'Jul 15', 'Jul 22', 'Jul 29', 'Aug 5', 'Aug 12', 'Aug 19'],
					labels: {
						style: {
							fontSize:'8px'
						},
						step: 3 
					},
					startOnTick: true,
					tickLength: 3,
					tickmarkPlacement:'on'
				},
				yAxis: {
					title: {
						text: null
					},
					labels: {
						formatter: function() {
							return this.value / 1000 +'k';
						},
						style: {
							fontSize:'10px'
						}
					},
					gridLineColor: '#eee',
					max:13000
				},
				/*tooltip: {
					formatter: function() {
						return '<strong>' + (parseInt(new Date(this.x).getMonth()) + 1) + '-' + new Date(this.x).getDate() + '</strong>:' + this.series.name +' completed <strong>'+
							Highcharts.numberFormat(this.y, 0) +'</strong>';
					}
				},*/
				plotOptions: {
					area: {
						marker: {
							enabled: true,
							symbol: 'circle',
							radius: 3,
							states: {
								hover: {
									enabled: true
								}
							}
						},
						fillOpacity:0.2
					}
				},
				series: [{
					name:'Personal Visits',
					data:reach_rescue_visits
				}]
			});
		}
    });
    
});