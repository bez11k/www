<?php
  global $wpdb;
  $sql = file_get_contents(WPGRABBER_PLUGIN_INSTALL_DIR.'install.sql');
  if (empty($sql)) {
    die('Сбой при установке плагина. Не найден файл SQL.');
  }
  $sql = str_replace('{wp_table_prefix}', $wpdb->prefix, $sql);
  $sql = explode(';', trim($sql, ';'));
  if (count($sql)) {
    foreach ($sql as $_sql) {
      if (!$wpdb->query($_sql)) {
        die('Сбой при установке плагина. Ошибка SQL.');
      }
    }
  }

  $current_wpg_core_version = get_option('wpg_core_version');
  $current_wpg_version = get_option('wpg_version');

  if ($current_wpg_core_version === false and $current_wpg_version !== false) {
    $current_wpg_core_version = $current_wpg_version;
    add_option('wpg_core_version', $current_wpg_core_version, ' ', 'no');
  }

  if ($current_wpg_core_version === false) {
    // Новая установка
    $sql = file_get_contents(WPGRABBER_PLUGIN_INSTALL_DIR.'test-feeds.sql');
    if (empty($sql)) {
      die('Сбой при установке плагина. Не найден файл SQL тестовых лент.');
    }
    $sql = str_replace('{wp_table_prefix}', $wpdb->prefix, $sql);
    $sql = explode(';', trim($sql, ';'));
    if (count($sql)) {
      foreach ($sql as $_sql) {
        if (!$wpdb->query($_sql)) {
          die('Сбой при установке плагина. Ошибка SQL тестовых лент.');
        }
      }
    }
    add_option('wpg_version', WPGRABBER_VERSION, ' ', 'no');
    add_option('wpg_core_version', WPGRABBER_CORE_VERSION, ' ', 'no');

    add_option('wpg_testPath', '/wp-content/wpgrabber_tmp/', ' ', 'no');
    add_option('wpg_imgPath', '/wp-content/uploads/', ' ', 'no');
    add_option('wpg_phpTimeLimit', '', ' ', 'no');

    add_option('wpg_useTransactionModel', 1, ' ', 'no');
    add_option('wpg_logErrors', 1, ' ', 'no');
    add_option('wpg_sendErrors', 1, ' ', 'no');
  } else {
    // Плагин был ранее установлен, обновляем
    if (version_compare($current_wpg_core_version, '1.1.8', '<')) {
      $rows = $wpdb->get_results('SELECT id, params FROM `'.$wpdb->prefix.'wpgrabber`');
      if (count($rows)) {
        foreach ($rows as $row) {
          $params = '';
          $params = base64_encode($row->params);
          $result = $wpdb->update($wpdb->prefix.'wpgrabber',
            array(
              'params' => $params,
            ),
            array('id' => $row->id)
          );
          if ($result === false) {
            die('Сбой при установке плагина. Ошибка обновления параметров версий ниже 1.1.8.');
          }
        }
      }
    }
    if (version_compare($current_wpg_core_version, '2.0.0', '<')) {
      update_option('wpg_useTransactionModel', 1);
      update_option('wpg_logErrors', 1, ' ', 'no');
      update_option('wpg_sendErrors', 1, ' ', 'no');
    }
    if (version_compare($current_wpg_core_version, '3.0.2', '<')) {
      if (WPGWordPressDB::isField($wpdb->prefix.'wpgrabber', 'catid')) {
        $rows = $wpdb->get_results('SELECT id, catid, params
          FROM `'.$wpdb->prefix.'wpgrabber`
          WHERE catid > 0');
        if (count($rows)) {
          foreach ($rows as $row) {
            if (trim($row->params) == '') continue;
            $params = base64_decode($row->params);
            if ($params !== false) {
              $params = ($params !== '') ? @unserialize($params) : array();
              if ($params !== false) {
                $params['catid'] = array($row->catid);
                $params = base64_encode(serialize($params));
                $result = $wpdb->update($wpdb->prefix.'wpgrabber',
                  array(
                    'params' => $params,
                  ),
                  array('id' => $row->id)
                );
                if ($result !== false) {
                  continue;
                }
              }
            }
            //die('Сбой при установке плагина. Ошибка обновления параметров версий ниже 3.0.2.');
          }
        }
        $sql = 'ALTER TABLE `'.$wpdb->prefix.'wpgrabber` DROP `catid`;';
        if (!$wpdb->query($sql)) {
          die('Сбой при установке плагина. Ошибка обновления структуры БД версий ниже 3.0.2.');
        }
      }
    }
    if (version_compare($current_wpg_core_version, WPGRABBER_CORE_VERSION, '<')) {
      if (!$wpdb->query('TRUNCATE TABLE `'.$wpdb->prefix.'wpgrabber_errors`')) {
        die('Сбой при установке плагина. Сбой БД при очистке логов.');
      }
    }
    update_option('wpg_version', WPGRABBER_VERSION);
    update_option('wpg_core_version', WPGRABBER_CORE_VERSION);
  }