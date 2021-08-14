## Conceito
[<img src="/public/images/logo-fflch.png" width="80"/>](/public/images/logo-fflch.png)

Agendamento de TGI/TCC da FFLCH.

## Funcionalidades

- Agendar trabalhos acadêmicos e disponibilizá-los online.

## Procedimentos de deploy
 
- Adicionar a biblioteca PHP referente ao sgbd da base replicada

```bash
composer install
cp .env.example .env
```
- Editar o arquivo .env
    - Dados da conexão na base do sistema
    - Dados da conexão na base replicada
    - Nº USP dos funcionários da secretaria

- Configurações finais do framework e do sistema:

```bash
php artisan key:generate
php artisan migrate
php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force
```
No ambiente de desenvolvimento, pode-se usar dados fakers:

```bash
php artisan migrate:fresh --seed
```

Caso falte alguma dependência, siga as instruções do `composer`.

## Tutoriais

<p align="left">
<a href="https://www.youtube.com/watch?v=38DL2a8WjSE" target="blank"><img align="center" src="public/images/youtube.png" alt="Admin" height="30" width="40" />Visão do Admin</a>
</p>

<p align="left">
<a href="https://www.youtube.com/watch?v=u0KMsTV1F_o" target="blank"><img align="center" src="public/images/youtube.png" alt="Aluno" height="30" width="40" />Visão do(a) Aluno(a)</a>
</p>

<p align="left">
<a href="https://www.youtube.com/watch?v=-ezAXMwrknk" target="blank"><img align="center" src="public/images/youtube.png" alt="Professor" height="30" width="40" />Visão do(a) Professor(a)</a>
</p>

<p align="left">
<a href="https://www.youtube.com/watch?v=guVp_k34VC8" target="blank"><img align="center" src="public/images/youtube.png" alt="Biblioteca" height="30" width="40" />Visão da Biblioteca</a>
</p>


## Projetos utilizados

- [uspdev/laravel-usp-theme](https://github.com/uspdev/laravel-usp-theme)
- [uspdev/replicado](https://github.com/uspdev/replicado)
- [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite)
- [uspdev/laravel-usp-faker](https://github.com/uspdev/laravel-usp-faker)
- [uspdev/laravel-usp-validators](https://github.com/uspdev/laravel-usp-validators)

## Contribuição

1. Faça o _fork_ do projeto (<https://github.com/yourname/yourproject/fork>)
2. Crie uma _branch_ para sua modificação (`git checkout -b feature/fooBar`)
3. Faça o _commit_ (`git commit -am 'Add some fooBar'`)
4. _Push_ (`git push origin feature/fooBar`)
5. Crie um novo _Pull Request_

## Padrões de Projeto

Utilizamos a [PSR-2](https://www.php-fig.org/psr/psr-2/) para padrões de projeto. Ajuste seu editor favorito para a especificação.