<?php

/*
  Plugin Name: TimThumb Helper
  Plugin URI: http://code.google.com/p/wp-timthumb/
  Description: Helper for attachments and TimThumb PHP Image Resizer. <a href="http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/" target="_blank">Complete TimThumb Parameters Guide</a>
  Version: 1.1.9
  Author: Javier Prieto
  Author URI: http://code.google.com/p/wp-timthumb/
  License: GPL2+
 */

// Prevent loading this file directly
defined('ABSPATH') || exit;

if (file_exists(dirname(__FILE__) . '/wp-timthumb-config.php'))
	require_once('wp-timthumb-config.php');

defined('WPTT_HTACCESS') || define('WPTT_HTACCESS', false); // Enable .htaccess

class WP_Timthumb {

	/**
	 * Parámetros que se deben omitir al generar la url
	 * @var array
	 */
	private $custom_params = array(
			'attachment_id' => null,
			'content' => null,
			'default' => null,
			'featured' => null,
			'limit' => null,
			'mime_type' => null,
			'object' => null,
			'post' => null,
			'post__not_in' => null,
			'post_id' => null,
			'post_content' => null,
			'shortcode' => null,
			'size' => null,
			'slug' => null);

	/**
	 * Almacenamiento temporal de las galerias
	 * @var array
	 */
	private $galleries = array();

	/**
	 * Almacenamiento temporal de las galerias
	 * @var array
	 */
	private $galleries_temp = array();

	/**
	 * Almacenamiento temporal de los adjuntos
	 * @var array
	 */
	public $post_attachments = array();

	/**
	 *  Arreglo con los mime-type mas usados
	 * @var array
	 */
	private $mime_types = array(
			'image' => array('image/gif', 'image/jpeg', 'image/png'),
			'pdf' => array('application/pdf')
	);

	/**
	 * Directorio donde está la librería timthumb.php
	 * @var string
	 */
	private $lib_dir = '';

	/**
	 * URL para descargar la última versión de la librería TimThumb
	 * @var string
	 */
	//private $lib_src = 'http://timthumb.googlecode.com/svn/trunk/timthumb.php';
	private $lib_src = '';
	private $lib_cnf = '';

	/**
	 * URL de la librería TimThumb a usar al construir la url del recorte
	 * @var type
	 */
	private $lib_url = '';

	public function __construct() {
		$this->lib_src = WP_PLUGIN_DIR . '/timthumb-helper/timthumb.php';
		$this->lib_cnf = WP_PLUGIN_DIR . '/timthumb-helper/timthumb-config.php';
		$this->lib_dir = WP_CONTENT_DIR . '/uploads/tt/';
		$this->lib_url = WP_CONTENT_URL . '/uploads/tt/timthumb.php';
		if (!file_exists($this->lib_dir . 'timthumb.php')) {
			$this->install_wp_timthumb();
		}
		defined('WPTT_DEFAULT_IMAGE') || define('WPTT_DEFAULT_IMAGE', false);
	}

	/**
	 * Instala/actualiza la librería TimThumb
	 */
	private function install_wp_timthumb() {
		if (!is_dir($this->lib_dir)) {
			mkdir($this->lib_dir, 0777, true);
		}
		# Intentamos copiar directamente desde la url
		$is_copied = copy($this->lib_src, $this->lib_dir . 'timthumb.php');
		$is_copied = copy($this->lib_cnf, $this->lib_dir . 'timthumb-config.php');
		# Si no logra copiar directamente intentamos crear el archivo
		if (!$is_copied) {
			$tt_code = file_get_contents($this->lib_src);
			$tt_core = fopen($this->lib_dir . 'timthumb.php', 'w');
			fwrite($tt_core, $tt_code);
			fclose($tt_core);
			$tt_code = file_get_contents($this->lib_cnf);
			$tt_core = fopen($this->lib_dir . 'timthumb-config.php', 'w');
			fwrite($tt_core, $tt_code);
			fclose($tt_core);
		}
	}

	private function create_htaccess() {

	}

	/**
	 * Devuelve un string tamaño predeterminado o un arreglo con las dimensiones
	 * @param array $params
	 * @return array/string
	 */
	private function get_size_param($params) {
		$size = null;
		if (empty($this->sizes)) {
			/* get all sizes avaliable */
			$this->sizes = get_intermediate_image_sizes();
			/* add full size */
			$this->sizes[] = 'full';
		}
		if (isset($params['size']) && in_array($params['size'], $this->sizes)) {
			$size = $params['size'];
		} else {
			if (isset($params['h']) && (int) $params['h'] > 0)
				$size[] = (int) $params['h'];

			if (isset($params['w']) && (int) $params['w'] > 0)
				$size[] = (int) $params['w'];

			if (count($size) != 2) {
				$size = 'large';
			}
		}
		return empty($size) ? 'large' : $size;
	}

	function get_attachment_image($params) {
		$size = $this->get_size_param($params);
		$temp = wp_get_attachment_image_src($params['attachment_id'], $size);
		unset($params['attachment_id']);
		return $temp[0];
	}

	/**
	 * Return a post by slug
	 * @global type $wpdb
	 * @param array|string $slug
	 * @return object
	 */
	private function get_post_by_slug($slug) {
		if (is_array($slug) && count($slug) > 1) {
			$post_type = $slug[1];
			$slug = $slug[0];
		} else {
			$post_type = NULL;
		}

		if (is_null($post_type)) {
			global $wpdb;
			$post_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s", $slug));
			if (!is_null($post_id)) {
				$result = get_post($post_id);
			} else {
				$result = null;
			}
		} else {
			$result = get_page_by_path($slug, OBJECT, $post_type);
		}
		return $result;
	}

	/**
	 * Devuelve los attachments adjuntos a un post
	 * @param array $params
	 * @return array
	 */
	public function get_post_attachments($params = array()) {

		# if is set, search post attachments by post slug
		if (isset($params['slug'])) {
			$page_by_slug = $this->get_post_by_slug($params['slug']);
			if (isset($page_by_slug->ID)) {
				$params['post_id'] = $page_by_slug->ID;
			} else {
				return array();
			}
			unset($params['slug']);
		}

		$defaults = array(
				'post_id' => get_the_ID(),
				'object' => TRUE,
				'limit' => -1
		);
		$params = wp_parse_args($params, $defaults);

		# Parámetros base
		$args = array(
				'post_type' => 'attachment',
				'posts_per_page' => $params['limit'],
				'post_parent' => $params['post_id']
		);

		# Si se define la exclusión de adjuntos
		if (isset($params['post__not_in'])) {
			$args['post__not_in'] = (is_array($params['post__not_in'])) ? $params['post__not_in'] : array($params['post__not_in']);
		}

		# Si se define el tipo de adjunto
		if (isset($params['mime_type'])) {
			if (array_key_exists($params['mime_type'], $this->mime_types)) {
				$args['post_mime_type'] = $this->mime_types[$params['mime_type']];
			} else {
				$args['post_mime_type'] = $params['mime_type'];
			}
		}

		$this->post_attachments = get_posts($args);

		$result = array();
		if (!$params['object']) {
			foreach ($this->post_attachments as $item) {
				$result[] = $item->guid;
			}
		} else {
			$result = $this->post_attachments;
		}
		return $result;
	}

	/**
	 * Obtiene las imagenes de un post
	 * @param type $args
	 * @return object
	 */
	public function get_post_images($params = array()) {

		$defaults = array(
				'post_id' => get_the_ID(),
				'limit' => -1
		);
		$params = wp_parse_args($params, $defaults);

		$is_object = isset($params['object']) ? (bool) $params['object'] : TRUE;
		# Override param object
		$params['object'] = TRUE;
		# Override param mime_type
		$params['mime_type'] = 'image';

		$featured = FALSE;

		if (isset($params['featured'])) {
			$params['featured'] = (bool) $params['featured'];
			$featured = $this->get_featured_image($params);

			if (!empty($featured)) {
				$params['limit'] = ($params['featured'] && $params['limit'] > 0) ? $params['limit'] - 1 : $params['limit'];
				$params['post__not_in'] = $featured->ID;
			}
		}

		$images = array();
		if ($params['limit'] > 0 or $params['limit'] === -1) {
			$images = $this->get_post_attachments($params);
		}

		$attachments = array();
		if ($featured && $params['featured'] === TRUE) {
			$attachments[] = $featured;
		}
		$attachments = array_merge($attachments, $images);

		$thumbnails = array();
		foreach ($attachments as &$_item) {
			$params['attachment_id'] = $_item->ID;
			$params['src'] = (isset($params['size']) && $params['size'] == 'full') ? $_item->guid : $this->get_attachment_image($params);
			$thumbnails[] = $_item->thumbnail = $this->get_timthumb_src($params);
		}
		unset($_item);
		$this->post_attachments = $attachments;
		return ($is_object) ? $attachments : $thumbnails;
	}

	/**
	 * Devuelve la URL con los parámetros para el recorte de la imagen con TimThumb
	 * @param array $params
	 * @return string
	 */
	function get_timthumb_src($params) {

		if (!isset($params['src']) && !empty($this->post_attachments) && !isset($params['attachment_id'])) {
			$params['attachment_id'] = $this->post_attachments->ID;
		}

		if (isset($params['attachment_id'])) {
			$params['src'] = $this->get_attachment_image($params);
		}

		# Debe estar definido al menos el parametro src
		if (isset($params['src'])) {
			# Eliminar parametros innecesarios
			$params = array_diff_key($params, $this->custom_params);
			if (count($params) > 1) {
				# Crear un string con todos los parámetros
				foreach ($params as $key => $value) {
					$_src[] = "{$key}={$value}";
				}
				$src = $this->lib_url . '?' . implode('&amp;', $_src);
				return $src;
			} else {
				return $params['src'];
			}
		} else {
			return $params['src'];
		}
	}

	/**
	 * Devuelve la imagen destacada del post
	 * @param array $params
	 * @return array/string
	 */
	public function get_featured_image($params = array()) {
		// if is set, search featured image by post slug
		if (isset($params['slug'])) {
			$page_by_path = $this->get_post_by_slug($params['slug']);
			if (isset($page_by_path->ID)) {
				$params['post_id'] = $page_by_path->ID;
			} else {
				return array();
			}
			unset($params['slug']);
		}

		// Set defaults
		$params['post_id'] = isset($params['post_id']) ? (int) $params['post_id'] : get_the_ID();
		$is_object = isset($params['object']) ? (bool) $params['object'] : TRUE;

		if (empty($params['post_id']))
			return array();

		// Search attachment_id
		$params['attachment_id'] = get_post_meta($params['post_id'], '_thumbnail_id', true);

		if (empty($params['attachment_id']))
			return array();

		$this->post_attachments[0] = get_post($params['attachment_id']);
		$this->post_attachments[0]->thumbnail = $this->get_timthumb_src($params);
		return ($is_object) ? $this->post_attachments[0] : $this->post_attachments[0]->thumbnail;
	}

	/**
	 * Return an array with galleries and WP_Post objects
	 * @global WP_Post $post
	 * @param array $params
	 * @return array
	 */
	public function get_post_galleries($params = array()) {

		$content = '';
		$this->galleries = array();
		$this->galleries_temp = array();

		if (isset($params['slug'])) {
			$page_by_slug = $this->get_post_by_slug($params['slug']);
			if (!is_null($page_by_slug)) {
				$params['post'] = $page_by_slug;
				$params['post_id'] = $page_by_slug->ID;
				$content = $page_by_slug->post_content;
			}
		} elseif (!empty($params['shortcode'])) {
			$content = $params['shortcode'];
		} elseif (!empty($params['content'])) {
			$content = $params['content'];
		} elseif (!empty($params['post']) && is_object($params['post'])) {
			$content = $params['post']->post_content;
		} elseif (!empty($params['post_id'])) {
			$params['post'] = get_post((int) $params['post_id']);
			$content = $params['post']->post_content;
		} else {
			global $post;
			$params['post'] = $post;
			$content = $params['post']->post_content;
		}

		if (empty($content))
			return array();

		// Almacena el shortcode sin procesar en $this->galleries_temp;
		$this->get_galleries_shotcodes($content);

		if (count($this->galleries_temp) > 0) {
			foreach ($this->galleries_temp as $gallery) {
				$_ids = explode(',', $gallery['ids']);
				$_gallery = array();

				foreach ($_ids as $attachment_id) {
					$params['object'] = TRUE;
					$params['attachment_id'] = (int) $attachment_id;
					$item_gallery = get_post($attachment_id);

					if (empty($item_gallery))
						continue;

					$item_gallery->thumbnail = $this->get_timthumb_src($params);
					$_gallery[] = $item_gallery;
				}

				if (isset($gallery['orderby']) && $gallery['orderby'] == 'rand') {
					shuffle($_gallery);
				}
				$this->galleries[] = $_gallery;
			}
		}
		return $this->galleries;
	}

	/**
	 * Get galleries shortcodes from content
	 * @param string $content
	 * @return array
	 * @since 1.1.0
	 */
	private function get_galleries_shotcodes($content) {
		$pattern = get_shortcode_regex();
		return preg_replace_callback("/$pattern/s", array($this, 'store_gallery'), $content);
	}

	/**
	 * Store galleries in an array
	 * @param array $m
	 * @since 1.1.0
	 * @return string
	 */
	private function store_gallery($m) {
		if ($m[2] == "gallery") {
			$tag = $m[2];
			$attr = shortcode_parse_atts($m[3]);
			$this->galleries_temp[] = $attr;
		}
	}

	private function save_htaccess() {
		$htaccess = "'# BEGIN WP-TimThumb \n";
		$hatccess .= "<IfModule mod_rewrite.c> \n \n";
		$hatccess .= "RewriteEngine On \n";
		$hatccess .= "RewriteCond %{REQUEST_URI} (?i)(jpg|jpeg|png|gif)$ \n";
		$hatccess .= "RewriteCond %{QUERY_STRING} h=([1-9]) \n";
		$hatccess .= "RewriteCond %{QUERY_STRING} w=([1-9]) \n";
		$hatccess .= "RewriteRule (.*) - [QSA,E=IS_TIMTHUMB:true] \n";
		$hatccess .= "RewriteCond %{ENV:IS_TIMTHUMB} true \n";
		$hatccess .= "RewriteRule (.*) ./wp-content/uploads/tt/timthumb.php?src=%{REQUEST_URI}&%{QUERY_STRING} \n";
		$hatccess .= "<'/IfModule>	 \n";
		$htaccess .= "# END WP-TimThumb' \n";
	}

}

global $tt;
$tt = !is_object($tt) ? null : $tt;

/**
 * Devuelve los adjuntos de un post
 * @global WP_Timthumb $tt
 * @param array $params
 * @return array
 */
function get_post_attachments($params = array()) {
	global $tt;
	$params = wp_parse_args($params);
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	return $tt->get_post_attachments($params);
}

/**
 * Devuelve las im&aacute;genes del post
 * si el par&aacute;metro <i>object</i> es falso devolvera un arreglo con los string con la url de la imagen,
 * de lo contrario devuelve un arreglo de objetos
 * @global WP_Timthumb $tt
 * @param array $params
 * @return array
 */
function get_post_images($params = array()) {
	global $tt;
	$params = wp_parse_args($params);
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	return $tt->get_post_images($params);
}

/**
 * Devuelve la imagen destacada del post
 * @global WP_Timthumb $tt
 * @param array $params
 * @return object|string
 */
function get_featured_image($params = array()) {
	global $tt;
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	return $tt->get_featured_image($params);
}

/**
 * Displays the url of the post featured image
 * @param array $params
 */
function the_featured_image($params = array()) {
	$params = wp_parse_args($params);
	# override object param
	$params['object'] = FALSE;
	$fi = get_featured_image($params);
	echo empty($fi) ? WPTT_DEFAULT_IMAGE : $fi;
}

/**
 * Devuelve la primera imagen del post, por defecto trae la imagen destacada,
 * si la imagen destacada no existe devuelve la primera imagen adjunta
 * @global WP_Timthumb $tt
 * @param array $params
 * @return string|array
 */
function get_first_image($params = array()) {
	global $tt;
	# defaults
	$defaults = array(
			'object' => true,
			'featured' => true
	);
	# override limit param
	$params['limit'] = 1;
	$params = wp_parse_args($params, $defaults);

	global $tt;
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	$first_image = $tt->get_post_images($params);
	return isset($first_image[0]) ? $first_image[0] : array();
}

/**
 * Displays the url of the post first image (the featured image by default)
 * @param array $params
 */
function the_first_image($params = array()) {
	$params = wp_parse_args($params);
	# override object param
	$params['object'] = FALSE;
	$fi = get_first_image($params);
	echo empty($fi) ? WPTT_DEFAULT_IMAGE : $fi;
}

/**
 * Devuelve el string de la url del recorte del TimThumb
 * @global WP_Timthumb $tt
 * @param array $params
 * @return string
 */
function get_timthumb_src($params = array()) {
	global $tt;
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	return $tt->get_timthumb_src($params);
}

/**
 * Muestra la url de primera imagen del post (la imagen destacada por defecto)
 * @param array $params
 */
function the_timthumb_src($params = array()) {
	echo get_timthumb_src($params);
}

/**
 * Return an array of galleries from content
 * @global WP_Timthumb $tt
 * @param array $params
 * @return array
 * @since 1.1.0
 */
function tt_get_post_galleries($params = array()) {
	global $tt;
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	if (!is_object($tt))
		$tt = new WP_Timthumb();
	return $tt->get_post_galleries($params);
}

if (!function_exists('get_post_galleries')) {

	/**
	 * Alias for get_post_galleries()
	 * @deprecated since version 1.1.7
	 */
	function get_post_galleries($params = array()) {
		return tt_get_post_galleries($params);
	}

}