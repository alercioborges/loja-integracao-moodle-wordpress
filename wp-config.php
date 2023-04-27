<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'directweb-loja' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'user_eduead_v2' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'MY$QLlojaedueadBD@2021' );

/** Nome do host do MySQL */
define( 'DB_HOST', '192.168.0.15:3306' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */

define( 'AUTH_KEY',         'w7h+~bWK^0,5o]H;UcDXXxbs)ml2O pWiY(Id2SlI^,=,+2H8vZ9kcTFw=#. W >' );
define( 'SECURE_AUTH_KEY',  'VMMh}cZ-+V0/i=~q#BW)W/t.a1h5^hXxuHw%`O!u1;xf+F6C)RR*yE!de9AF`JTm' );
define( 'LOGGED_IN_KEY',    'Rf>Nz|<#zhxj:mJY!G~}!}f</%gtILV/K9$7NhxhFDIHf(=UJK~ZJO3F!=NTmZy)' );
define( 'NONCE_KEY',        'v6;q@I4tL2s 0T77yt{y-`B`#S{H#Blw#IQ%ouE.C[/wNOy9sQ`PS%q?8a>o / G' );
define( 'AUTH_SALT',        '8{A2kbC^{{A%gz/zzZ=$L~EJW/8e/i)YNolA%n4SNC,p#df,kxS4%.aiJHCSL9!c' );
define( 'SECURE_AUTH_SALT', '!1!.o|2v$(@4|hCsx5E)||o0Y4ArDR{mC=mvDvj#x*+*gMi!0Tg2(88TX#l2N],U' );
define( 'LOGGED_IN_SALT',   '>rtA~BqH6WVZr/sx&kwBq*]kDs|]h)P9|?5$UmuC8LyV:6p;C$s^T)?<,C%rBk^<' );
define( 'NONCE_SALT',       '8^qP_k4Cv?]OtT&r|nm^#w>a*6Ty%w0l{fRaf&_}[Qd|R6@q7Rh:Hi^(v`jm&,0i' );
 

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
