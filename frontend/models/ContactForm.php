<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $cc;
    public $phone;
    public $subject;
    public $body;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email','phone', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],

        ];
    }

    /**
     * @inheritdoc
     */


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email, $cc)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setCc($cc)
            ->setFrom('mymovietravel@gmail.com')
            ->setSubject($this->subject)
            ->setHtmlBody($this->body)
            ->send();
    }
}