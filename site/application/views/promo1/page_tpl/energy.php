<script type="text/javascript" src="/js/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/js/highcharts/themes/grid.js"></script>
<script type="text/javascript">
var chart;
var chart1;
$(document).ready(function() {

   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'chart',
         defaultSeriesType: 'spline'
      },
      title: {
         text: ''
      },
       xAxis: {
                type: 'datetime',
                maxZoom: 864000000
            },
      yAxis: {
         title: {
            text: 'Perfomance'
         },
         labels: {
            formatter: function() {
               return this.value +'W/h'
            }
         },
         min:0
      },
      tooltip: {
         formatter: function() {
         if(this.y==0)
             return false;
            return ''+
               Highcharts.dateFormat('%A %B %e %Y', this.x) +': '+ this.y +
               (this.series.name == 'Daily' ? ' W/h' : ' W/h');
         }
      },
      plotOptions: {
         spline: {
            marker: {
               radius: 4,
               lineColor: '#666666',
               lineWidth: 1
            }
         }
      },
      series: [{
         name: 'Comulative',
         color: '#4572A7',
         type: 'spline',
        data: <?php echo $wattsComulative;?>

      }]
   });


   chart1 = new Highcharts.Chart({
      chart: {
         renderTo: 'chart1'
      },
      title: {
         text: ''
      },
      xAxis: {
                type: 'datetime',
                maxZoom: 864000000
            },
      yAxis: {
         title: {
            text: 'W/h'
         },
         labels: {
            formatter: function() {
               return this.value +'W/h'
            }
         }
      },
      tooltip: {
         formatter: function() {
            var s;
            if (this.point.name) { // the pie chart
               s = ''+
                  this.point.name +': '+ this.y +' kW/h';
            } else {
               s = ''+
                   this.y +' kW/h';
            }
            return s;
         }
      },
      series: [{
         type: 'column',
         name: 'UCI Rec Center',
         data: <?php echo $watts;?>
      }, {
         type: 'spline',
         name: 'FFG Average',
         data: <?php echo $watts;?>
      }/*, {
         type: 'pie',
         name: 'Total consumption',
         data: [{
            name: 'US Gym',
            y: 13,
            color: highchartsOptions.colors[0] // Jane's color
         }, {
            name: 'CA Sports',
            y: 23,
            color: highchartsOptions.colors[1] // John's color
         }, {
            name: 'BearGym',
            y: 19,
            color: highchartsOptions.colors[2] // Joe's color
         }],
         center: [100, 80],
         size: 100,
         showInLegend: false,
         dataLabels: {
            enabled: false
         }
      }*/]
   });
      
});

</script>
<div class="feature-block" style="text-align: center">
<h3>Compare my consumption data to all of Fit for Green</h3>
<a  href="/promo/green_button&iframe=true&width=700&height=400" class="pflink" rel="prettyPhoto"><img src="/images/green-button.png"/></a>
</div>
<div class="feature-block">
<img src="/images/promo/stickers/1_24.png" class="alignright"/>
<span>
<h3>Thinking of Ecology Can Be Fun</h3>
<p>Fit for Green will enable the generation of substantial renewable energy. For years skeptics have criticized the idea of humans generating any amount of meaningful renewable energy and, at the individual contributor level, they are correct. An athlete working out for an hour could only create about 350 watt-hours of power, about 1/3 of a kilowatt-hour, which costs about 11 cents in the US. An average human is much less, about 100 watt-hours per hour. Fit for Green changes the game from the individual to the 40 million plus gym members in the US, the more than 800 million active Facebook Users, and the 900,000 + pieces of self propelled gym machines in the United States today. </p>
</span>
</div>
<br/>
<h3 class="aligncenter">Daily Progress</h3>
<div id="chart">
</div>
<br/>
<div class="feature-block">
<img src="/images/promo/stickers/1_16.png" class="alignleft"/>
<span>
<h3>Something New in the World of Green Energy</h3>
<p>Fit for Green will increase healthily planet awareness.  As people exercise and generate power it will not only be about them creating enough energy to light a bulb or charge an iPod but it will also be about realizing what energy is and how difficult it is to create it.  Just imagine, after a grueling 1 hour cardio workout you look on the screen and see 150 watt-hours generated.  Next you relate that work you did to something real, “I can light a 75 watt bulb for two hours”.  Finally, take the work you did and realize that each time you leave that 75 watt bulb burning needlessly the same burden is put on your planet mostly by burning coal.</p>
</span>
</div>
<br/>
<h3 class="aligncenter">Top Gyms</h3>
<div id="chart1">
</div>
