<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/src/styles.css">    
    <?php if($this->uri->segment(3)!='zamzam'){?>
    <style type="text/css">
        .zamzampage{width:1530px;padding:0px;margin-top:575px;}
        .martopbot5{margin: 5px auto}
        .mar5px{margin:5px auto }
        .mar15px{margin:15px auto }
        .normal{font-weight:normal}
        .size12{font-size: 12px}
        .size13{font-size: 13px}
        .size32{font-size: 32px}
        .size26{font-size: 26px;line-height: 36px}
        .size20{font-size: 20px}
        .bagheding{letter-spacing: 11px!important;}
        .height50{height: 50px!important}
        body {
            font-size: 7px;
            font-family: 'Work Sans', sans-serif;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }

        h2 {
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        h3 {
            font-size: 12px;
        }

        h5 {
            font-size: 9px;
        }

        .AAhdr {
            padding-top: 5px;
            background-color: #003366;
            text-align: center;
            color: white;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }

        .AAftr {
            background-color: #003366;
            text-align: center;
            padding-bottom: 0px;
            padding-top: 5px;
            color: white;
        }

        .AAZero {
            padding: 0px 5px;
            margin-bottom: 0px;
            margin-top: 0px;
            vertical-align: top;font-family:arial black !important
        }
.normal{font-family:arial black !important;font-size:11px}

        .flag {
            background-image: linear-gradient(#FF9933, #ffffff, #128807);
            height: 30px;
            text-align: center;
            font-weight: 700;
            border-radius: 5px 5px 30px 30px;
            letter-spacing: 1px;
            word-spacing: 5px;
            margin-top: -8px;
            font-family:arial black !important
        }
        .page {
    		 width: 21cm;
    		 min-height: 29.7cm;
    		 border-radius: 5px;
    		 background: white;
    		 box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    	}
        .pad0{padding: 0}
        
        @page {
          size: A4;
          margin: 25px 0;
        }

        @media print {
          .page {
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
          }
        }
    </style>
    <?php }else{?>
        <style>
        .page {
             width: 21cm;
             min-height: 29.7cm;
             border-radius: 5px;
             background: white;
             box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        body {
            font-size: 18px;
            
        }
    
        .zamzambotle h1 {
            font-size: 88px;
        }
    
        .zamzambotle h2 {
            font-size: 65px;
            margin-bottom: 5px;
        }
    
        .zamzambotle h3 {
            font-size: 20.6px;
        }
    
        .zamzambotle h5 {
            font-size: 22px;
        }
    
        .zamzambotle .AAhdr {
            padding-top: 5px;
            background-color: #003366;
            text-align: center;
            color: white;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }
    
        .zamzambotle .AAftr {
            background-color: #003366;
            text-align: center;
            padding-bottom: 0px;
            padding-top: 5px;
            color: white;
        }
    
        .zamzambotle .AAZero {
            padding: 0px 5px;
            margin-bottom: 0px;
            margin-top: 0px;
            vertical-align: top;
        }
    
        .zamzambotle .flag {
            background-image: linear-gradient(#FF9933, #ffffff, #128807);
            height: 50px;
            text-align: center;
            font-weight: 700;
            border-radius: 5px 5px 30px 30px;
            letter-spacing: 1px;
            word-spacing: 5px;
            margin-top: 0px;
            font-size: 28px;
        }
        @page {
          size: A4;
        }

        @media print {
          .page {
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
          }
        }
    </style>
    <?php }?>
</head>

<body>
	<?php
    if($this->uri->segment(3)!='zamzam'){?>
        <div class="book">
    <?php }?>
	    <?php echo $data;?>
    <?php if($this->uri->segment(3)!='zamzam'){?>
	   </div>
    <?php }?>
    <!-- Main Div -->
</body>
<script type="text/javascript">
	window.print();
</script>
</html>

<!-- 
mumbaiw_aamna
pranav*407
 -->