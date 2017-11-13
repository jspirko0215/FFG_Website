<style>
    #world td
    {
        width: 9px;
        
    }
    #world tr
    {
        height: 9px;       
    }
    #world 
    {
       
        border: none;
        background: url(/images/promo/1231.png) no-repeat;

    }
    .transparent{
        background-color: white;
        opacity: 0.5;
    }
    .gym
    {
        cursor: pointer;
        background: url(/images/promo/mapdot.png) no-repeat;;
        opacity: 1;
        background-color:none;
    }
    .hide
    {
        display: none;
    }
    .pflink
    {
        display: block;
        overflow: hidden;
        width: 8px;
        height: 8px;
        font-size: 0px;
    }
</style>
<h3 class="aligncenter">FitForGreen Live <br/><span style="font-size:13px">(click on the active gyms to see live stats)</spam></h3>
<table class="aligncenter" id="world" border="0">
    <?php for($i = 0; $i < 50; $i++): ?>
        <tr>
            <?php for($j = 0; $j < 100; $j++): ?>
             <?php if(array_key_exists($i . 'x' . $j, $p)): ?>
                <td class="gym" >
                    <?php echo $p[''.$i . 'x' . $j.''] ?>
                </td>
            <?php else:?>
                <td>
                </td>
            <?php endif;?>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
<br/>
<div class="feature-block">
<img src="/images/promo/stickers/1_35.png" class="alignleft"/>
<span>
<h3>Fit for Green over the World</h3>
<p>Fit for Green will encourage members to join forces with friends and family in order to make working out and creating energy fun.  For some friends it may be all about the competition and for others it may be more about cooperation around some renewable energy creation goal that they have set as a unit.  In either case the friends become a new driver to help members get healthier and at the same time contribute to a united renewable energy cause / effort. </p>
</span>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //$("#world td").addClass('transparent');
       
        $("#world td").hover(
        function() { $(this).addClass('transparent'); },
        function() { $(this).removeClass('transparent'); }
    );
    });
    
</script>
<br/><br/><br/>
<div class="fb-like-box" data-href="http://www.facebook.com/pages/Fit-for-Green/196705463732605" data-width="900" data-show-faces="true" data-border-color="green" data-stream="false" data-header="true"></div>