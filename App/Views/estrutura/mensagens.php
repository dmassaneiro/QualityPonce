<?php if ($msg == '1') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Erro! </strong> Preencha os Campos Obrigatorios.
    </div>
<?php } ?>
<?php if ($msg == '2') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> O Sistema não pode realizar a Exclusão!<br>
        Existe Informações que depende desse dado.
    </div>
<?php } if ($msg == '3') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> O Fornecedor é Invalido ou não existe!<br>
        Verifique se o mesmo está Cadastrado no sistema.
    </div>
<?php } if ($msg == '4') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> O Materia-prima é Invalida ou não existe!<br>
        Verifique se o mesmo está Cadastrado no sistema.
    </div>
<?php } if ($msg == '5') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> Dados Inválidos!<br>
        Verifique se o preenchimento está correto.
    </div>
<?php }if ($msg == '6') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> Arquivo Inválido!<br>
        Verifique se o preenchimento está correto.
    </div>
<?php } if ($msg == '7') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> Não Foi Possivel Gravar o Arquivo!<br>
        Verifique se o preenchimento está correto.
    </div>
<?php } if ($msg == '8') { ?>
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ATÊNÇÃO! </strong> Alguns Funcionários não podem estar neste treinamento <br>
        Verifique se todos os funcionários estão cadastrados no sistema.
    </div>
<?php } if ($msg == '9') { ?>
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> A Data do Terminio não dever ser Inferior que a Data Inicio <br>
        Verifique o preenchimento correto dos Campos.
    </div>
<?php } if ($msg == '10') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ATÊNÇÃO! </strong> Produto não Cadastrado <br>
        Verifique o mesmo Existe no Sistema.
    </div>
<?php } if ($msg == '11') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ATÊNÇÃO! </strong> Produto não Não Possui os Item da Ficha Técnica <br>
        - Cadastre no Sistema.
    </div>
<?php } if ($msg == '12') { ?>
    <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>OPS! </strong> Parece que voçê não tem Acesso a este menu <br>
        - Verifique com o administrador.
    </div>
<?php } if ($msg == '13') { ?>
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>OPS! </strong> Parece que o Usuário ja Existe! <br>
        - Verifique com o administrador.
    </div>
<?php } if ($msg == '14') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> Não Foi Possivel Gravar !<br>
        Matéria prima não pertence a esse Fornecedor.
    </div>
<?php }  if ($msg == '15') { ?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>ERRO! </strong> CNPJ já Cadastrado no sistema !<br>
        Verifique corretamente o CNPJ do Fornecedor.
    </div>
<?php } 
