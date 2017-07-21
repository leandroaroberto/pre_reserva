# Pre-reserva EAD

    Formulário de consulta de reserva de salas com integração com o Google Calendar.
    By Leandro A. Roberto

## Listagem dos métodos

### pre_reservaController
- gravar
  
  Recebe os valores POST enviados pelo formulário.
  
  **Parâmetros**
   - nome string(50) **requerido**
   - email string(100) **requerido** 
   - fone numérico(20)
   - professor string(50) **requerido**
   - evento string(50) **requerido** Combo
   - obs text textarea
   - data_reserva Date Carbon Calendar **requerido**
   - Horario  time **requerido**
- sendMail
    Envia e-mail para o $to definido na função com os dados do formulario.
    Utiliza a API Swift_Sendmail para envio de e-mails utilizando o php sendmail.
- calendar
    Cria um novo evento no calendário do google.
    Utiliza a API Spatie\GoogleCalendar.
    Diretório do arquivo de autenticação da conta google .json: storage/app/public/API-Google.json

- getEvento
    Retorna os valores do combo id traduzindo os caracteres especiais (ç, ~ e etc)