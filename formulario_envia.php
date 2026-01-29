<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include('menu_publico.php'); ?>
    <main class="container">
        <div>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">  <!-- abre dimensionamento -->
                <div class="form-container tabela-branca" style="padding: 30px; border-radius: 8px;">
                    <h2 class=" formulario text-center titulo"><strong>Sugestões, dúvidas ou agendamento de um treino gratuito: </strong></h2>
                    <h4 class="formulario text-center titulo">PREENCHA O FORMULÁRIO </h4>
                    <br>
                    <form 
                        action="formulario_contato.php"
                        name="form_contato"
                        id="form_contato"
                        method="post"
                        class="form-horizontal"
                        
                    >
                        <!-- input group NOME -->
                            <div class="form-group ">
                                <label class="col-sm-3 control-label">Nome Completo:</label>
                                <div class="col-sm-8">
                                <input 
                                    type="text"
                                    name="nome_formulario"
                                    id="nome_formulario"
                                    placeholder="Digite seu nome completo."
                                    required
                                    class="form-control"
                                    
                                >
                                </div>
                            </div> <!-- fecha form-group -->

                        <!-- form group Data de Nascimento -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Data de Nascimento:</label>
                                <div class="col-sm-8">
                                <input 
                                    type="date"
                                    name="date_formulario"
                                    id="date_formulario"
                                    required
                                    class="form-control"
                                >
                                </div>
                            </div> <!-- fecha form-group -->
                    <!--  
                            <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CPF:</label>
                                <div class="col-sm-6">
                                <input 
                                    type="text"
                                    name="cpf"
                                    placeholder="000.000.000-00"
                                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}",
                                    class="form-control"
                                    required
                                >
                                </div>
                            </div>  fecha form-group CPF -->

                        <!-- input group Telefone -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Telefone / WhatsApp:</label>
                                <div class="col-sm-8">
                                <input 
                                    type="tel"
                                    name="telefone_formulario"
                                    id="telefone_formulario"
                                    placeholder="Digite seu telefone."
                                    required
                                    class="form-control"
                                >
                                </div>
                            </div> <!-- fecha form-group -->
                        

                        <!-- construa o input group email use glyphicon-envelope -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-mail:</label>
                                <div class="col-sm-6">
                                <input
                                    type="email"
                                    name="email_formulario"
                                    id="email_formulario"
                                    placeholder="Digite seu e-mail."
                                    required
                                    class="form-control"
                                > 
                                </div>
                            </div> <!--fecha input group email-->

                        <!-- Tipo de contato -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Assunto:</label>
                            <div class="col-sm-8">
                            <select 
                            name="assunto_contato"
                            id="assunto_contato"
                            class="form-control"
                            required
                            >
                                <option value="" style="font-weight: bold;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Selecione</option>
                                <option value="sugestao">Sugestão</option>
                                <option value="treino">Agendar treino </option>
                                <option value="patrocinio">Parceria</option>
                                <option value="duvida">Dúvidas Gerais</option>
                            </select>
                            </div>
                        </div>

                        <!-- Informações do treino -->                        
                        <div  id="info-treino" style="display:none;">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    <div class="alert formulariobusca text-center">
                                        <strong>Treinos gratuitos:</strong><br>
                                        Quarta-feira às 18h<br>
                                        Sábado às 16h
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Data de treino -->
                        <div class="form-group" id="campo-dia" style="display:none;">
                            <label class="col-sm-3 control-label">Dia do treino:</label>
                                <div class="col-sm-8">
                                    <select name="dia-treino" id="dia-treino" class="form-control">
                                        <option value="" style="font-weight: bold;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Selecione o dia</option>
                                        <option value="quarta">Quarta-feira</option>
                                        <option value="sabado">Sábado</option>
                                    </select>
                                </div>
                        </div>

                        <!-- horario do treino -->
                        <div class="form-group" id="campo-horario" style="display:none;">
                            <label class="col-sm-3 control-label">Horário</label>
                                <div class="col-sm-8">
                                    <select name="horario_treino" id="horario_treino" class="form-control">
                                        <option value="" style="font-weight: bold;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Selecione o horário</option>
                                        <option value="18:00">18h</option>
                                        <option value="16:00">16h</option>
                                    </select>
                                </div>
                        </div>

                        <!-- construa o textarea comentários -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mensagem:</label>
                                <div class="col-sm-8">
                                <textarea name="comentarios_contato" 
                                    id="comentarios_contato"
                                    placeholder="Comentários, solicitações, dúvidas e/ou sugestões."
                                    aria-describedby="basic-addon3"
                                    required
                                    class="form-control"
                                    cols="30"
                                    rows="5"></textarea> <!-- fecha text-area -->
                                    </div>
                            </div> <!--fecha textarea comentaroios-->
                        <!-- construa o botão enviar use glyphicon-send -->

                        <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btntotal btn-block btn-lg" aria-label="Enviar">
                                Enviar
                                <span class="glyphicon glyphicon-send"></span>
                            </button>
                            </div>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <BR>
<footer>
    <?php include('rodape.php'); ?>
</footer>

<script>
document.getElementById('assunto_contato').addEventListener('change', function () {

    var mostrar = (this.value === 'treino');

    document.getElementById('info-treino').style.display   = mostrar ? 'block' : 'none';
    document.getElementById('campo-dia').style.display    = mostrar ? 'block' : 'none';
    document.getElementById('campo-horario').style.display = mostrar ? 'block' : 'none';

});

document.getElementById('dia_treino').addEventListener('change', function () {

    var horario = document.getElementById('horario_treino');

    horario.innerHTML = '<option value="">Selecione o horário</option>';

    if (this.value === 'quarta') {
        horario.innerHTML += '<option value="18:00">18h</option>';
    }

    if (this.value === 'sabado') {
        horario.innerHTML += '<option value="16:00">16h</option>';
    }

});
</script>
<script>
document.querySelector('form').addEventListener('submit', function(e) {

    var assunto = document.getElementById('assunto').value;

    if (assunto === 'treino') {

        var dia = document.getElementById('dia_treino').value;
        var horario = document.getElementById('horario_treino').value;

        if (dia === '' || horario === '') {
            alert('Por favor, selecione o dia e o horário do treino.');
            e.preventDefault();
        }
    }
});
</script>
</body>
</html>