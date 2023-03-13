<?php
// Define a URL da API
$url = 'https://api.openai.com/v1/completions';

// Define o prompt inicial
$prompt = 'Olá, ChatGPT!';

// Define os parâmetros da chamada
$parametros = array(
  'prompt' => $prompt,
  'max_tokens' => 60,
  'temperature' => 0.7,
  'n' => 1,
  'stop' => '\n'
);

// Define as opções de configuração da chamada
$opcoes = array(
  'http' => array(
    'method' => 'POST',
    'header' => 'Content-type: application/json\r\n' .
                'Authorization: Bearer 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\r\n',
    'content' => json_encode($parametros)
  )
);

// Abre o arquivo para escrita
$arquivo = fopen('chatgpt_logs.txt', 'a');
if ($arquivo === false) {
  // Exibe uma mensagem de erro caso não seja possível abrir o arquivo para escrita
  echo 'Erro ao abrir arquivo para escrita.';
} else {
  // Faz a primeira chamada à API
  $resposta = @file_get_contents($url, false, stream_context_create($opcoes));
  var_dump($http_response_header);
  if ($resposta === false) {
    // Exibe uma mensagem de erro caso a chamada à API falhe
    echo 'Erro ao fazer chamada à API.';
  } else {
    // Grava o prompt e a resposta no arquivo
    $prompt = json_decode($resposta)->choices[0]->text;
    fwrite($arquivo, $prompt . PHP_EOL);
    fwrite($arquivo, 'ChatGPT: ' . $prompt . PHP_EOL);

    // Faz mais chamadas à API até que um dos stop tokens seja encontrado
    while (!preg_match('/bye|tchau|adeus/i', $prompt)) {
      $parametros['prompt'] = $prompt;
      $resposta = @file_get_contents($url, false, stream_context_create($opcoes));
      if ($resposta === false) {
        // Exibe uma mensagem de erro caso a chamada à API falhe
        echo 'Erro ao fazer chamada à API.';
        break;
      } else {
        // Grava o prompt e a resposta no arquivo
        $prompt = json_decode($resposta)->choices[0]->text;
        fwrite($arquivo, 'Você: ' . $parametros['prompt'] . PHP_EOL);
        fwrite($arquivo, 'ChatGPT: ' . $prompt . PHP_EOL);
      }
    }
  }
  fclose($arquivo);
}
