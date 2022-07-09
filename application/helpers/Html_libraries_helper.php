<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers Html_libraries_helper
 *
 * Herramientas HTML variadas
 * - Sweet Alert
 * @author    Bryan E. Pool Mercado <bryanedilberto.poolmercado@gmail.com
 *
 */

// ------------------------------------------------------------------------

if (!function_exists('SwConfirmar')) {
  /**
   * SwConfirmar
   *
   * Alerta SweetAlert para confirmar accion
   *
   * @param $function_name
   * @param $title
   * @param $text
   * @param $title_confirm
   * @param $text_confirm
   * @return string
   */
  function SwConfirmar($function_name, $title = 'Esta seguro que desea continuar?', $text = 'Esta accion no se puede repetir', $title_confirm = 'Completado', $text_confirm = 'Accion completada con exito')
  {
    return "
      Swal.fire({
        title: '{$title}',
        text: '{$text}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
      }).then((result) => {
        if (result.isConfirmed) {
          if($function_name != false) {
            Swal.fire(
              '{$title_confirm}',
              '{$text_confirm}',
              'success'
            );
          }
        }
      })
    ";
  }
}

if (!function_exists('SwAlerta')) {
  /**
   * SwAlerta
   *
   * Alerta SweetAlert 
   *
   * @param $icon
   * @param $title
   * @param $text
   * @return string
   */
  function SwAlerta($icon = 'success', $title = 'Completado', $text = 'Accion completada con exito')
  {
    return "
    Swal.fire(
      `{$title}`,
      `{$text}`,
      '{$icon}'
    );
    ";
  }
}

// ------------------------------------------------------------------------

/* End of file Html_libraries_helper.php */
/* Location: ./application/helpers/Html_libraries_helper.php */