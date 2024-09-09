<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Readinstore</title>
    <link rel="icon" href="images/logo_icon.png"  type = "image/x-icon">
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable="no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  <style>
    #exzoom {
        width: 400px;
        height: 400px;
    }
    .row-product{
        height: 100px;
        background-color: #ddf;
    }
    @media screen and (max-width: 991px) {
   #exzoom{
       margin-top:30px;
       padding-top:10px;
       width:320%;
        height: 320%;
        min-width: 500px;
        
      } 
      .navbar-header{ 
    
        width:100%;
        margin:0px;
        margin-left:10px;
      
       
      }
      .navbar-brand{ 

        margin:0px;
      
       
      }
      #navbar-form navbar-left{ 
       list-style: none;
        margin-right: 0px;
        padding: 0px;
        width:100%;
       
      }
      #searchform{ 
       list-style: none;
        margin-right: 0px;
        padding: 0px;
        background-color:#FF;
        width:110%;
       
      }
       #spanned{ 
       list-style: none;
        margin: 0px;
        padding: 0px;
        width:40%
        background-color:#000;
         max-width:300px;
        min-width:5px;
      }
       #spanned2{ 
        margin: 0;
        padding: 0;
        width:5px;
        background-color:#000;
         max-width:10px;
        min-width:2px;
        
      }
       
       #navbar-search-input{ 
        display: inline-block;
        width: 40%;
        max-width:360px;
        min-width:5px;
        margin:0px;
        padding:0px;
        
      }
      
      #dropdown{ 
        display: inline-block;
        width: 100%;
         max-width:200px;
        min-width:5px;
        margin:0px;
        padding:0px;
        
      }
      
      #fa fa-search{ 
        display: inline-block;
        width: 100%;
         max-width:10px;
        min-width:1px;
        margin:0px;
        padding:0px;
        
      }
      
      #navbar-search-input:focus{ 
      display: inline-block;
        width: 45%;
      }
      navbar-custom-menu{ 
        display: inline-block;
        width: 100%;
         max-width:10px;
        min-width:1px;
        margin:0px;
        padding:0px;
        float:left;
        
      }
       #cart ul{ 
        display: inline-block;
        width: 100%;
        margin:0px;
        padding:0px;
        float:left;
        
      }
       #product-photo {
         width: 100% ;
        height: auto;
        max-height:500px;
       

        }
         #product-photo-content{
        height: auto;
        max-height:500px;

        }
        #photo-content{
       height: auto;
        max-height:460px;
     
        }
        #photo-content img{
        height: auto;
        max-height:420px;

        }
        #specs{
        width: 100% ;
        height: auto;
        float:left;
        padding:5px;
        margin-left:5px;
        }
     
      }
   
</style>
  	<!-- Custom CSS -->
    <style type="text/css">
     /* Small devices (tablets, 768px and up) */
   

    /* Medium devices (desktops, 992px and up) */
    @media (min-width: 992px){ 
      #navbar-search-input{ 
        width:auto; 
      }
      #navbar-search-input:focus{ 
        width: auto; 
      } 
       #fa fa-search{ 
        display: inline-block;
        width: auto;
         max-width:5px;
        min-width:1px;
        margin:0px;
        padding:0px;
        
      }
        #product-photo {
        height: auto;
        max-height:500px;
       

        }
         #product-photo-content{
        height: auto;
        max-height:400px;

        }
        #photo-content{
       height: auto;
        max-height:400px;
     
        }
        #photo-content img{
        height: auto;
        max-height:300px;

        }
    }
#navbar-search-input{ 
        width:auto; 
      }
      #navbar-search-input:focus{ 
        width: auto; 
      } 
       #fa fa-search{ 
        display: inline-block;
        width: auto;
         max-width:5px;
        min-width:1px;
        margin:0px;
        padding:0px;
        
      }
    .word-wrap{
      overflow-wrap: break-word;
    }
    .prod-body{
      height:300px;
    }

    .box:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .register-box{
      margin-top:20px;
    }

    #trending{
      list-style: none;
      padding:10px 5px 10px 15px;
    }
    #trending li {
      padding-left: 1.3em;
    }
    #trending li:before {
      content: "\f046";
      font-family: FontAwesome;
      display: inline-block;
      margin-left: -1.3em; 
      width: 1.3em;
    }

    /*Magnify*/
    .magnify > .magnify-lens {
      width: 100px;
      height: 100px;
    }
     #specs{
        width: 350px;
        height: auto;
        float:Left;
        margin-left:5px;

        }
     #product-button{
        width: 350px;
        height: auto;
        

        }
    
    </style>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Magnify -->
    <link rel="stylesheet" href="magnify/magnify.min.css">
		
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Paypal Express -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <!-- Google Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script> 
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!--<script src="js/jquery-1.9.1.min.js"></script>-->
    
    <script   src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script  src="magnify_slider/jquery.exzoom.js"></script>
    <link   href="magnify_slider/jquery.exzoom.css" rel="stylesheet" type="text/css"/>
</head>