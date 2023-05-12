function atualizaDados() {
    // envia uma solicitação AJAX para o servidor para buscar os dados mais recentes
    $.ajax({
      url: 'atualiza_dados.php',
      success: function(dados) {
        // atualiza a página com os dados mais recentes
        $('#dados').html(dados);
      },
      complete: function() {
        // agenda a próxima atualização em 5 segundos
        setTimeout(atualizaDados, 5000);
      }
    });
  }
  
  // inicia a atualização de dados quando a página é carregada
  $(document).ready(function() {
    atualizaDados();
  });