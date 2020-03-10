<?php
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
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'deyvid' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

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
define( 'AUTH_KEY',         'pXpuSDGW.8`4?]OQ)^-{&P1l%ND,VWb6(M)x],k+EUN66[PN5$s=U)KhkSpy+50A' );
define( 'SECURE_AUTH_KEY',  '~=3&/1xj*02hf~<L_l3Wn;!$tN.fiN?w~pjFN+tk#C1mbNahDFq~~>p6Xi~8I:(z' );
define( 'LOGGED_IN_KEY',    'x*^e*(@eZSH{orV`.]ZMf!*$LBC(T%+WU*e+7GP$5K:^|qO^*#50hnFjpx*n>e!7' );
define( 'NONCE_KEY',        'ZoP!}Pxk`WF_nPTe$QH3bI<vR4doRK98vaUIRF&-MBcAd%Jsq-@%Awdy?%s&Tb;H' );
define( 'AUTH_SALT',        '|R~SQsR.0CX9V >H5yZhB$H=3EOT *~N,uriNyXA~( eo~)j]?-VU>>;Cl]rN&}W' );
define( 'SECURE_AUTH_SALT', 'G[qPt6GGAQN~0)y<abxSA]2hrpMS(^w([wjO|?&<a:lS&l7;L9as8Eiwt<I.N7+a' );
define( 'LOGGED_IN_SALT',   '>@d=U#ES*e%&EA#}G@E%{lEUVq&|/sa6HI(FQL;(sA0OFB;LfzFfhuyjSVT5HQRB' );
define( 'NONCE_SALT',       '<@_7}`v8{B#pHwp]QYa$#;Z5u07d?=muV{$OnJ[M&W/1*g6l~%jZ?akn7r>S zsH' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'ph_';

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
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
