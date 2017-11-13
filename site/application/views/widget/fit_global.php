<?php if($sessionCount):?>
<script type="text/javascript">
var chart;
$(document).ready(function() {

Highcharts.theme = {
   colors: ["#514F78", "#42A07B", "#9B5E4A", "#72727F", "#1F949A", "#82914E", "#86777F", "#42A07B"],
   chart: {
      className: 'skies',
      borderWidth: 0,
      plotShadow: true,

      plotBackgroundColor: {
         linearGradient: [0, 0, 250, 500],
         stops: [
            [0, 'rgba(255, 255, 255, 1)'],
            [1, 'rgba(255, 255, 255, 0)']
         ]
      },
      plotBorderWidth: 1
   },
   title: {
      style: { 
         color: '#3E576F',
         font: '16px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
      }
   },
   subtitle: {
      style: { 
         color: '#6D869F',
         font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 0,
      lineColor: '#C0D0E0',
      tickColor: '#C0D0E0',
      labels: {
         style: {
            color: '#666',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#666',
            font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }            
      }
   },
   yAxis: {
      alternateGridColor: 'rgba(255, 255, 255, .5)',
      lineColor: '#C0D0E0',
      tickColor: '#C0D0E0',
      tickWidth: 1,
      labels: {
         style: {
            color: '#666',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#666',
            font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }            
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: '#3E576F'
      },
      itemHoverStyle: {
         color: 'black'
      },
      itemHiddenStyle: {
         color: 'silver'
      }
   },
   labels: {
      style: {
         color: '#3E576F'
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
    
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'highchart',
         zoomType: 'x'
      },
      title: {
         text: 'Your Progress'
      },
      subtitle: {
         text: ''
      },
      xAxis: { 
                type: 'datetime',
                maxZoom: 864000000
            },
      yAxis: [{
         labels: {
            formatter: function() {
               return this.value +'';
            },
            style: {
               color: '#89A54E'
            }
         },
         title: {
            text: 'Daily watt / hours',
            style: {
               color: '#89A54E'
            }
         },
            min:0
      }, { // Secondary yAxis
         title: {
            text: 'Comulative watt / hours',
            style: {
               color: '#4572A7'
            }
         },
         min:0,
         labels: {
            formatter: function() {
               return this.value +' ';
            },
            style: {
               color: '#4572A7'
            }
         },
         opposite: true
      }],
      tooltip: {
         formatter: function() {
         if(this.y==0)
             return false;
            return ''+
               Highcharts.dateFormat('%A %B %e %Y', this.x) +': '+ this.y +
               (this.series.name == 'Daily' ? ' W/h' : ' W/h');
         }
      },
      legend: {
         layout: 'vertical',
         align: 'left',
         x: 120,
         verticalAlign: 'top',
         y: 100,
         floating: true,
         backgroundColor: Highcharts.theme.legendBackgroundColor || '#FFFFFF'
      },
      series: [{
         name: 'Daily',
         color: '#8ebd6e',
         type: 'column',
         
         data: <?php echo $watts;?>
      }, {
         name: 'Comulative',
         color: '#4572A7',
         type: 'spline',
         yAxis: 1,
         data: <?php echo $wattsComulative;?>
      }]
   });  
});
function change_period(period){
    if(period>0)
    {
        var date = new Date();
        chart.xAxis[0].options.endOnTick = false;
        chart.xAxis[0].setExtremes(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()-period), 
        Date.UTC(date.getFullYear(), date.getMonth(), date.getDate())
        );
        chart.redraw();                            
    }
    else
    {
        chart.xAxis[0].setExtremes();
        chart.redraw();             
    }
}


</script>
<div  style="float:right; margin-bottom: 5px">
<select id="monitor_period">
    <option value="0" selected>All days</option>
    <option value="10">Last 10 days</option>
    <option value="30" >Last 30 days</option>
    <option value="90">Last 90 days</option>
</select>
</div>
<br/><br/><br/>
<div id="highchart" class="highcharts-container" style="height:310px; min-width: 130px; overflow:hidden">
</div>
<div id="highchart-placeholder" style="height:310px; min-width: 130px; overflow:hidden;display:none; text-align: center;">
    <br/><br/><br/>
    <img src="/images/graph.png"/><br/>
    Loading...
</div>
<script type="text/javascript">
    $('#monitor_period').bind('change', function(){
        var campaign_id = $('#monitor_campaign').val();
        var period = $(this).val();
        change_period(period);
    })
</script>
<?php else: ?>
<h3>You will see chart here when start training.</h3>
<?php endif;?>