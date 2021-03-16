<style>
.tab-content-table tr td, .tab-content-table tr th {
    padding-top: 3px;    
    padding-bottom: 3px;    
}
.wrap fieldset {
    padding: 10px;
    border: 1px solid #cacaca;
    margin-top: 10px;
}
.wrap fieldset legend {
    font-weight: bold;
}
</style>
<div class="wrap">
<form method="post">
<div id="icon-options-general" class="icon32"></div><h2>WPGrabber - Настройки</h2>
<fieldset>
<legend>Основные настройки</legend>
<table class="tab-content-table">
<tr>
    <td>Каталог временных файлов</td>
    <td><input type="text" name="options[testPath]" value="<?php echo get_option('wpg_' .'testPath'); ?>" size="60" /></td>
</tr>
<tr>
    <td>Каталог хранения картинок из постов</td>
    <td><input type="text" name="options[imgPath]" value="<?php echo get_option('wpg_' .'imgPath'); ?>" size="60" /></td>
</tr>
<tr>
    <td width="395">Время выполнение основного процесса импорта в секундах</td>
    <td><input type="text" name="options[phpTimeLimit]" value="<?php echo get_option('wpg_' . 'phpTimeLimit'); ?>" /> (0 - неограничено)</td>
</tr>
<tr>
    <td>Разбивать процесс импорта на части</td>
    <td><?php echo WPGHelper::yesNoRadioList('options[useTransactionModel]', get_option('wpg_' .'useTransactionModel')); ?></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Настройка сетевых запросов</legend>
<table class="tab-content-table">
<tr>
    <td width="395">Для запросов использовать метод</td>
    <td><?php echo WPGHelper::selectList('options[getContentMethod]', array('0'=>'CURL','1'=>'file_get_contents'), get_option('wpg_' .'getContentMethod'), 1); ?></td> 
</tr>
<tr>
    <td>Включить обработку редиректов <br>(CURL-опция: CURLOPT_FOLLOWLOCATION)</td>
    <td><?php echo WPGHelper::yesNoRadioList('options[curlRedirectOn]', get_option('wpg_' .'curlRedirectOn')); ?></td>
</tr>
<tr>
    <td>Максимальное время ожидания ответа от сервера (0 - неограчено)</td>
    <td><input type="text" name="options[requestTime]" value="<?php echo get_option('wpg_' .'requestTime'); ?>" /></td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Настройки сервисов перевода</legend>
  <table class="tab-content-table">
    <tr>
      <td width="395">API-ключ сервиса Яндекс.Перевод</td>
      <td><input size="100" type="text" name="options[yandexApiKey]" value="<?php echo WPGTools::esc(get_option('wpg_'.'yandexApiKey')); ?>" /></td>
    </tr>
    <?php /*
    <tr>
      <td width="395">API-ключ сервиса Bing Переводчик</td>
      <td><input size="100" type="text" name="options[bingApiKey]" value="<?php echo WPGTools::esc(get_option('wpg_'.'bingApiKey')); ?>" /></td>
    </tr>
    */ ?>
  </table>
</fieldset>

<?php if(wpgIsStandard()): ?>
  <fieldset>
    <legend>Настройки сервиса Synonyma.ru</legend>
    <table class="tab-content-table">
      <tr>
        <tr>
          <td width="395">Логин</td>
          <td>
            <input type="text" name="options[synonymaLogin]" value="<?php echo WPGTools::esc(get_option('wpg_'.'synonymaLogin')); ?>" />
          </td>
        </tr>
        <tr>
          <td>Ключ</td>
          <td>
            <input type="text" size="50" name="options[synonymaHash]" value="<?php echo WPGTools::esc(get_option('wpg_'.'synonymaHash')); ?>" />
          </td>
        </tr>
      </tr>
    </table>
  </fieldset>
<?php endif; ?>

<fieldset>
<legend>Настройка автообновлений лент</legend>
<table class="tab-content-table">
<tr>
    <td width="395">Включить автообновление лент</td>
    <td><?php echo WPGHelper::yesNoRadioList('options[cronOn]', get_option('wpg_' .'cronOn')); ?></td>
</tr>
<tr>
    <td>Метод обновления</td>
    <td><?php echo WPGHelper::selectList('options[methodUpdate]', array(0=>'WordPress CRON',1=>'CRON Server'), get_option('wpg_' .'methodUpdate'), 1); ?></td>
</tr>
<tr>
    <td>Метод обновления</td>
    <td><?php echo WPGHelper::selectList('options[methodUpdateSort]', array('0'=>'по порядку','1'=>'учитывая интервалы'), get_option('wpg_' .'methodUpdateSort'), 1); ?></td>
</tr>
<tr>
    <td>Интервал запуска CRON заданий (мин.)</td>
    <td><input type="text" name="options[cronInterval]" value="<?php echo get_option('wpg_' .'cronInterval'); ?>" /></td>
</tr>
<tr>
    <td>Кол-во лент обновляемых за один запуск CRON задания</td>
    <td><input type="text" name="options[countUpdateFeeds]" value="<?php echo get_option('wpg_' .'countUpdateFeeds'); ?>" /></td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Логирование ошибок плагина</legend>
<table class="tab-content-table">
<tr>
    <td width="395">Включить логирование ошибок</td>
    <td><?php echo WPGHelper::yesNoRadioList('options[logErrors]', get_option('wpg_' .'logErrors')); ?></td>
</tr>
<tr>
    <td width="395">Автоматически отправлять письма с ошибками на адрес службы технической поддержки: bug@wpgrabber.ru</td>
    <td><?php echo WPGHelper::yesNoRadioList('options[sendErrors]', get_option('wpg_' .'sendErrors')); ?></td>
</tr>
<tr>
  <td colspan="2">
    <a href="?page=wpgrabber-settings&wpgrabberGetErrorLogFile" target="_blank">посмотреть лог-файл ошибок</a>
  </td>
</tr>
</table>
</fieldset>
<?php if(wpgIsDebug()): ?>
  <p><a style="color: red;" onclick="return confirm('Уверены? Будут удалены все данные');" href="?page=wpgrabber-settings&wpgrabberDeactivateAndClear">Отключить плагин и удалить все данные</a></p>
<?php endif; ?>
<?php submit_button('Сохранить изменения','primary','saveButton'); ?>
</form>
</div>