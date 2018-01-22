<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="favicon_16.ico"/>
<link rel="bookmark" href="favicon_16.ico"/>
<!-- site css -->
<link rel="stylesheet" href="../dist/css/site.min.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../dist/js/site.min.js"></script>
<script type="text/javascript" src="../../../js/validator.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="../font/css/font-awesome.min.css">
<link rel="stylesheet" href="../../../css/css_geral.css">

<link rel="shortcut icon" href="../../../img/FAVICOM.png" />
<link rel="apple-touch-icon" href="../../../img/FAVICOM.png" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
    input, textArea{
        text-transform: uppercase;
    }
    #selecionado{
        background-color: #bbb;
    }
/*    #treinamento{
        border-top: 0px solid #ddd;
    }
    #ncproduto{
        background-color: #48CFED;
    }
    #ncprocesso{
       background-color: #48CFAD;
    }
    #producao{
        background-color: #00FF7F;
    }
    #documento{
        background-color: #F6BB42;
    }*/
</style>
<script type="text/javascript">
    jQuery(function ($) {
        $(document).on('keypress', 'input.somente-numero', function (e) {
            var square = document.getElementById("sonumero");
            var key = (window.event) ? event.keyCode : e.which;
            if ((key > 47 && key < 58)) {
//                        sonumero.style.backgroundColor = "#ffffff";
                return true;

            } else {
//                        sonumero.style.backgroundColor = "#ff0000";
                return (key == 8 || key == 0) ? true : false;

            }
        });
    });
</script>