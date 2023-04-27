<?php
/**
 * ThemeCentury functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemeCentury
 * @subpackage ThemeCentury
 */
/**
 *
 * @since HamroClass 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('hamroclass_file_directory') ){

    function hamroclass_file_directory( $file_path ){

    	$parent_file_path = trailingslashit( get_stylesheet_directory() ) . $file_path;
        $child_file_path = trailingslashit( get_template_directory() ) . $file_path;
        if( file_exists( wp_normalize_path( $parent_file_path ) ) ){
            return wp_normalize_path( $parent_file_path );
        }else{
            return wp_normalize_path( $child_file_path );
        }

    }

}

/**
 * Initialized hamroclass themes
 */
require_once hamroclass_file_directory( 'inc/init.php' );

//adicionando campos no formulário de cadastro
function wooc_extra_register_fields() {?>
   <p class="form-row form-row-first">
       <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
   </p>
   <p class="form-row form-row-last">
       <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
   </p>
   <div class="clear"></div>
   <?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


 //adicioando validação dos campos adicionais
 /**
* register fields Validating.
*/
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
  if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
     $validation_errors->add( 'billing_first_name_error', __( 'Nome é um campo obrigatório.', 'woocommerce' ) );
 }
 if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
     $validation_errors->add( 'billing_last_name_error', __( 'Sobrenome é um campo obrigatório.', 'woocommerce' ) );
 }
 return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );


//Salvando no banco de dados os campos adiionais
/**
* Below code save extra fields.
*/
function wooc_save_extra_register_fields( $customer_id ) {

  if ( isset( $_POST['billing_first_name'] ) ) {
             //First name field which is by default
     update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
             // First name field which is used in WooCommerce
     update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
 }
 if ( isset( $_POST['billing_last_name'] ) ) {
             // Last name field which is by default
     update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
             // Last name field which is used in WooCommerce
     update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
 }

}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields');



 /**
 * @snippet       Change "Place Order" Button text @ WooCommerce Checkout
 * @sourcecode    https://rudrastyh.com/?p=8327#woocommerce_order_button_text
 * @author        Misha Rudrastyh
 */
 add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
 
 function misha_custom_button_text( $button_text ) {
   return 'Finalizar pagamento'; // new text is here 
}


/* ----------inicio nova aba my-account -------------  */

// Add Woocommerce My Account tab for Support
// 1. Register new customer-support endpoint (URL) for My Account page
add_action( 'init', 'add_support_endpoint' );
function add_support_endpoint() {
    add_rewrite_endpoint( 'customer-support', EP_ROOT | EP_PAGES );
}

// 2. Add new query var
add_filter( 'query_vars', 'support_query_vars', 0 );  
function support_query_vars( $vars ) {
    $vars[] = 'customer-support';
    return $vars;
}

// 3. Insert the new endpoint into the My Account menu
add_filter( 'woocommerce_account_menu_items', 'add_new_support_tab' );
function add_new_support_tab( $items ) {
    $items['customer-support'] = 'Support';
    return $items;
}

// 4. Add content to the added tab
add_action( 'woocommerce_account_customer-support_endpoint', 'support_tab_content' ); // Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

function support_tab_content() {
   echo '<h4><strong>Support</strong></h4>
   <p>Fermentum tristique non imperdiet vulputate ridiculus platea arcu suspendisse donec</p>';
   echo do_shortcode( '[fluentform id="1"]' ); // Here goes your shortcode if needed
}

// 5. Go to Settings >> Permalinks and re-save permalinks. Otherwise you will end up with 404 Page not found error

// 1. Register new purchased-courses endpoint (URL) for My Account page
add_action( 'init', 'add_lms_endpoint' );
function add_lms_endpoint() {
    add_rewrite_endpoint( 'purchased-courses', EP_ROOT | EP_PAGES );
}

// 2. Add new query var
add_filter( 'query_vars', 'courses_query_vars', 0 );  
function courses_query_vars( $vars ) {
    $vars[] = 'purchased-courses';
    return $vars;
}

// 3. Insert the new endpoint into the My Account menu
add_filter( 'woocommerce_account_menu_items', 'add_new_courses_tab', 40 );
function add_new_courses_tab( $items ) {
    $items['purchased-courses'] = 'Your courses';
    return $items;
}

// 4. Add content to the added tab
add_action( 'woocommerce_account_purchased-courses_endpoint', 'course_tab_content' ); // Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

function course_tab_content() {
   echo '<h4><strong>Meus cursos</strong></h4>
   <p>Acesse os cursos comprados.</p>';

   $current_user_id = get_current_user_id();

   $the_user = get_user_by( 'id', $current_user_id);

   $the_user = get_user_by( 'id', $current_user_id);


   include('../../../loja/wp-config.php');

   /*
   //Dados do banco de dados do WP
   echo "<br />" . DB_USER;
   echo "<br />" . DB_NAME;
   echo "<br />" . DB_HOST;
   echo "<br />" . DB_PASSWORD;
   */

   //Dados do banco de dados do Moodle
   $host = "192.168.0.15:3306";
   $dbuser = "financas_moodle";
   $dbpass = 'M4R!4DBfinancasBD@2021';
   $dbname = "financas_moodle";

   //Endereço do Moodle
   $url_moodle = 'https://directweb.eduead.com.br/edueadteste/';

   //Criando link de acesso aos cursos
   $url_course = $url_moodle . 'course/view.php?id='; 

   $link = mysqli_connect($host, $dbuser, $dbpass, $dbname);

   if (!$link) {
    die("A conexão como o banco de dados falhou " . mysqli_connect_error());
}

$query = "SELECT "
. "u.id AS user_id, "
. "concat(u.firstname, ' ' , u.lastname) AS name, "
. "u.username, "
. "u.email, "
. "c.id AS course_id, "
. "c.fullname AS course_name " 
. "FROM mdl_role_assignments rs "
. "INNER JOIN mdl_user u ON u.id=rs.userid "
. "INNER JOIN mdl_context e ON rs.contextid=e.id "
. "INNER JOIN mdl_course c ON c.id = e.instanceid "
. "WHERE e.contextlevel = 50 "
. "AND u.deleted <> 1 "
.  "AND u.username = '{$the_user->user_login}' "
. "AND u.email = '{$the_user->user_email}'";




//exibindo os cursos inscritos

$dados = mysqli_query($link, $query);

$total = mysqli_num_rows($dados);

if ($total > 0) { 
    echo "<table>"
    . "<tr>"
    .  "<td>Curso</td>"
    . "</tr>";  
    while($exibe = mysqli_fetch_array($dados)){
        echo "<tr>";       
        echo "<td><a href=".$url_course.$exibe['course_id'].'"'.' target="_blank">'.$exibe['course_name']."</a>"."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h4>Nenhum curso adquirido.</h4>";
}

mysqli_close($link);

}

/* ----------Fim nova aba my-account -------------  */


//Alterando mensagem de página de pagamento
add_filter( 'woocommerce_checkout_login_message', 'mycheckoutmessage_return_customer_message' ); 
function mycheckoutmessage_return_customer_message() {
    return '<span class="login-message">Para efetuar o pagãmento é necessário cadastrar-se, <a href="https://directweb.eduead.com.br/loja/my-account/">clique aqui para se cadastrar</a>, mas se já é cliente, </span>';
}

//Alterando mensagem de página de carrinho - carrinho vazio
add_filter( 'wc_empty_cart_message', 'mycartmessage_return_customer_message' );
function mycartmessage_return_customer_message() {
    return '<span class="login-message">Seu carrinho está vazio no momento.</span>';
}

/**
 * @snippet       Phone Mask @ WooCommerce Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_filter( 'woocommerce_checkout_fields', 'bbloomer_checkout_phone_us_format' );

function bbloomer_checkout_phone_us_format( $fields ) {
    $fields['billing']['billing_phone']['placeholder'] = '(12)345678901';
    $fields['billing']['billing_phone']['maxlength'] = 14;
    return $fields;
}

add_action( 'woocommerce_after_checkout_form', 'bbloomer_phone_mask_us' );

function bbloomer_phone_mask_us() {
 wc_enqueue_js( "
  $('#billing_phone')
  .keydown(function(e) {
   var key = e.which || e.charCode || e.keyCode || 0;
   var phone = $(this);         
   if (key !== 8 && key !== 9) {
    /*-----*/
    if (phone.val().length === 0) {
        phone.val(phone.val() + '('); // add dash before char #1
    }
    /*-----*/
    if (phone.val().length === 3) {
        phone.val(phone.val() + ') '); // add dash after char #3
    }            
}
return (key == 8 ||
key == 9 ||
key == 46 ||
(key >= 48 && key <= 57) ||
(key >= 96 && key <= 105));
});
" );
}

add_filter( 'woocommerce_billing_fields', 'my_wc_custom_billing_postcode' );

function my_wc_custom_billing_postcode( $fields ) {
    $fields['billing_postcode']['maxlength'] = 9;
    return $fields;
}

add_action( 'woocommerce_after_checkout_form', 'my_wc_custom_postcode_mask' );

function my_wc_custom_postcode_mask() {
    wc_enqueue_js( "
      $('#billing_postcode')
      .keydown(function(e) {
       var key = e.which || e.charCode || e.keyCode || 0;
       var postcode = $(this);         
       if (key !== 8 && key !== 9) {
           if (postcode.val().length === 5) {
            postcode.val(postcode.val() + '-'); 
        }
    }
    });
    " );
}