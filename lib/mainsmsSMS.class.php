<?php

class mainsmsSMS extends waSMSAdapter {

    public function getControls() {
        return array(
            'project' => array(
                'value' => '',
                'title' => 'Project',
                'description' => 'Название проекта, полученное в личном кабинете http://mainsms.ru/office/api_account',
            ),
            'api_key' => array(
                'value' => '',
                'title' => 'API key',
                'description' => 'API-ключ получаемый при регистрации проекта в личном кабинете http://mainsms.ru/office/api_account',
            ),
        );
    }

    /**
     * @param string $to
     * @param string $text
     * @return mixed
     */
    public function send($to, $text, $from = null) {
        require_once(dirname(__FILE__) . '/classes/mainsms.class.php');
        $api = new MainSMS($this->getOption('project'), $this->getOption('api_key'), false, false);
        $result = $api->sendSMS($to, $text, $from);
        $result_log = $result ? 'Сообщение успешно отправлено' : 'Ошибка при отправке сообщения';
        $this->log($to, $text, $result_log);
        return $result;
    }

}
