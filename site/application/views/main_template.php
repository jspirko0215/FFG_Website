<?php $action = $this->uri->segment(2); ?>
<?php if($this->uri->segment(1)=='profile') $action = 'profile'; ?>

<!doctype html>
<html lang="en-us" style="height:100%">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo ((isset($title)) ? $title : 'FitforGreen'); ?></title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/custom.css">
        <link rel="stylesheet" href="/css/light/theme.css" id="themestyle">
        <!-- <link rel="stylesheet" href="css/dark/theme.css" class="theme"> -->

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="/css/ie.css">
        <![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

        <script type="text/javascript" src="/js/jquery.layout-latest.js"></script>
        <script type="text/javascript" src="/js/highcharts/highcharts.js"></script>


        <script src="/js/functions.js"></script>
        <script src="/js/plugins.js"></script>
        <script src="/js/datatables.js"></script>

        <script src="/js/json2.js"></script>
        <script src="/js/flot.js"></script>
        <script src="/js/wl_Alert.js"></script>
        <script src="/js/wl_Autocomplete.js"></script>
        <script src="/js/wl_Time.js"></script>
        <script src="/js/wl_Valid.js"></script>
        <script src="/js/wl_Date.js"></script>
        
        
        <script src="/js/wl_Dialog.js"></script>
        <script src="/js/wl_Number.js"></script>
        <script src="/js/wl_Slider.js"></script>
        <script src="/js/wl_Calendar.js"></script>
        <script src="/js/wl_Form.js"></script>
        
        
       <?php if(!in_array($action, array('login','registration','forgot','change_password','profile')) ){ ?> 
          <script src="/js/wl_Store.js"></script>
       <?php } ?>
        <script src="/js/wl_Password.js"></script>
        <script src="/js/wl_Widget.js"></script>
        <script src="/js/config.js"></script>
        <script src="/js/script.js"></script>
        
        <?php if($action == 'dashboard'): ?>
            <script src="/js/dashboard.js"></script>
        <?php endif; ?>                    

        <?php if ($action === 'login'):?>
            <script src="/js/login.js"></script>
        <?php endif; ?>
        
        <?php if ($action === 'myprofile'):?>
            <script src="/js/myprofile.js"></script>
        <?php endif; ?>

        <?php if ($action === 'registration'){?>
            <script src="/js/register.js"></script>
        <?php } ?>
          <?php if ($action === 'forgot'){?>
            <script src="/js/forgot.js"></script>
        <?php } ?>
        <?php if ($action === 'change_password'){?>
            <script src="/js/change_password.js"></script>
        <?php } ?>
            
    
    </head>
    <body <?php echo( ($action == 'login' || $action == 'registration' || $action == 'forgot' || $action =='change_password') ? 'id="login"' : ''); ?> style="height:100%">


    <?php if ($action != 'login' && $action != 'registration' && $action != 'forgot' && $action != 'change_password'): ?>
            <div id="pageoptions">
                <ul>
                    <li><a href="/members/logout">Logout</a></li>
                    <li><a href="/members/myprofile">My Profile</a></li>
                </ul>
            </div>
        <header>
            <div id="logo">
                <a href="/">Logo</a>
            </div>    

            <div id="header">
                <ul id="headernav"  style="width:99%">
                    <li>
                        <ul>
                            <li><a href="/members/dashboard">Dashboard</a></li>
                            <li><a  href="/members/stats">Detailed Statistics</a></li>
                            
                            <?php if($action=='dashboard'):?>
                            <li style="float:right">
                                <a id="widget_panel"  class="widget_panel_close"  href="#">Widgets</a>
                                <span>new</span>
                            </li>
                            <?php endif;?>
                        </ul>
                    </li>
                </ul>

        </div>
        </header>

     <?php endif; ?>
        
        <div id="content">
            <?php echo $output; ?>
        </div>    
    <div id="fb-root"></div>   
    <footer>
        Content copyright 2010-2011. Fit for Green. All rights reserved
    </footer>
</body>
</html>    
